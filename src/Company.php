<?php

namespace Raigu\EstCompaniesCache;

/**
 * I represent row from Commercial Register CSV as an instance.
 * I can stringify myself, so I can be compared with other Companies.
 */
final class Company implements \Stringable
{
    public function __toString(): string
    {

    }

    public function __construct(private array $data)
    {
    }
}