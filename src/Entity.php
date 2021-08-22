<?php

namespace Raigu\EstCompaniesCache;

final class Entity implements \Stringable
{
    public function __toString(): string
    {
        return $this->id . $this->hash;
    }

    public function __construct(
        private string $id,
        private string $hash
    )
    {
    }
}