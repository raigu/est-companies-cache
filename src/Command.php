<?php

namespace Raigu\EstCompaniesCache;


use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Raigu\OrderedListsSynchronization\Synchronization;

final class Command
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = !is_null($logger) ? $logger : new NullLogger;
    }

    public function __invoke(\Iterator $source, \Iterator $target, callable $add, callable $remove)
    {
        $added = 0;
        $removed = 0;
        $logger = $this->logger;
        $synchronization = new Synchronization();

        $synchronization(
            $source,
            $target,
            function ($element) use ($add, $logger, &$added): void {
                $logger->debug('+ ' . $element);
                $added += 1;
                call_user_func_array($add, [$element]);
            },
            function ($element) use ($remove, $logger, &$removed): void {
                $logger->debug('- ' . $element);
                $removed += 1;
                call_user_func_array($remove, [$element]);
            }
        );

        $logger->info('Added: ' . $added);
        $logger->info('Removed: ' . $removed);

        return 0;
    }
}