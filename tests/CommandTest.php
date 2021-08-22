<?php

namespace Raigu\EstCompaniesCache;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Raigu\EstCompaniesCache\Command
 */
class CommandTest extends TestCase
{
    /**
     * @test
     */
    public function must_return_zero_on_success()
    {
        $dummy = function ($entity) {};
        $sut = new Command();

        $ret = $sut(new \EmptyIterator, new \EmptyIterator, $dummy, $dummy);

        $this->assertEquals(0, $ret, 'On success the script returns 0');
    }

    /**
     * @test
     */
    public function must_synchronize()
    {
        $source = new \ArrayIterator([
            $new = new Entity(1, "A"),
        ]);
        $target = new \ArrayIterator([
            $deprecated = new Entity(2, "B"),
        ]);

        $added = [];
        $add = function ($entity) use (&$added) {
            $added[] = $entity;
        };

        $removed = [];
        $remove = function ($entity) use (&$removed) {
            $removed[] = $entity;
        };

        $sut = new Command();
        $sut($source, $target, $add, $remove);

        $this->assertEquals([$new], $added);
        $this->assertEquals([$deprecated], $removed);
    }

    /**
     * @test
     */
    public function all_additions_must_be_logged()
    {
        $dummy = function ($entity) {};
        $sut = new Command($spy = new SpyLogger);
        $sut(
            new \ArrayIterator([
                $entity = new Entity(1, "ABCD"),
            ]),
            new \EmptyIterator,
            $dummy,
            $dummy
        );

        $this->assertTrue($spy->contains('+ ' . strval($entity)), 'Must contain what was added.');
        $this->assertTrue($spy->contains('Added: 1'), 'Must contain total additions.');
    }

    /**
     * @test
     */
    public function all_removals_must_be_logged()
    {
        $dummy = function ($entity) {};
        $sut = new Command($spy = new SpyLogger);
        $sut(
            new \EmptyIterator,
            new \ArrayIterator([
                $entity = new Entity(1, "ABCD"),
            ]),
            $dummy,
            $dummy
        );

        $this->assertTrue($spy->contains('- ' . strval($entity)), 'Must contain what was removed.');
        $this->assertTrue($spy->contains('Removed: 1'), 'Must contain total removals.');
    }
}
