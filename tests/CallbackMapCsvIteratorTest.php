<?php

namespace Raigu\EstCompaniesCache;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Raigu\EstCompaniesCache\CallbackMapCsvIterator
 */
class CallbackMapCsvIteratorTest extends TestCase
{
    /**
     * @test
     */
    public function maps_elements_using_callback()
    {
        $f = fopen('php://memory', 'wr');
        fwrite($f, 'a,b,c');
        rewind($f);

        $sut = new CallbackMapCsvIterator(
            $f,
            fn($row) => array_reverse($row)
        );

        $actual = iterator_to_array($sut->getIterator());

        $this->assertEquals([['c', 'b', 'a']], $actual);
    }
}
