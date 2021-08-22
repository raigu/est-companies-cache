<?php

namespace Raigu\EstCompaniesCache;

final class CallbackMapCsvIterator implements \IteratorAggregate
{
    /**
     * @var resource
     */
    private $handle;
    private string $separator;
    /**
     * @var callable
     */
    private $callback;

    public function getIterator()
    {
        while ($row = fgetcsv($this->handle, 1024, $this->separator)) {
            yield call_user_func_array($this->callback, [$row]);
        }
    }

    /**
     * @param resource $handle
     * @param callable $callback
     * @param string $separator
     */
    public function __construct($handle, callable $callback = null, string $separator = ',')
    {
        $this->handle = $handle ?? fn($row) => $row;
        $this->separator = $separator;
        $this->callback = $callback;
    }
}