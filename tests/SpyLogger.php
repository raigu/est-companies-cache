<?php

namespace Raigu\EstCompaniesCache;

use Psr\Log\AbstractLogger;

final class SpyLogger extends AbstractLogger
{
    private array $logs;

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $this->logs[] = [$level, $message, $context];
    }

    public function contains(string $value): bool
    {
        foreach ($this->logs as $log) {
            if (str_contains($log[1], $value)) {
                return true;
            }
        }

        return false;
    }

    public function __construct()
    {
        $this->logs = [];
    }
}