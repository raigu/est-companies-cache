<?php

namespace Raigu\EstCompaniesCache;

use Psr\Log\AbstractLogger;

final class ConsoleLogger extends AbstractLogger
{
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        echo "{$level}\t{$message}" . PHP_EOL;
    }
}