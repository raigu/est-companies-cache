<?php

namespace Raigu\EstCompaniesCache;

final class CompaniesSource implements \IteratorAggregate
{
    public function getIterator()
    {
        $iterator = new CallbackMapCsvIterator(
            (new FirstFileInZipArchiveAsStream(
                (new AriregisterZipFile)->fileName())
            )(),
            fn(array $row) => new Company($row),
        );

        return $iterator;
    }

    public function __construct()
    {
    }
}