<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Raigu\EstCompaniesCache\Command;
use Raigu\EstCompaniesCache\Entity;

$updater = new \Raigu\EstCompaniesCache\TargetWrite();

$command = new Command(new \Raigu\EstCompaniesCache\ConsoleLogger);

$ret = $command(
    new ArrayIterator([
        new Entity(1, "A")
    ]),
    new EmptyIterator,
    fn($element) => $updater->add($element),
    fn($element) => $updater->remove($element)
);

exit($ret);