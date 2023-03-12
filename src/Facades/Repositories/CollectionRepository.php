<?php

namespace Illegal\Linky\Facades\Repositories;

use Illegal\Linky\Repositories\CollectionRepository as CollectionRepositoryAccessor;
use Illuminate\Support\Facades\Facade;

class CollectionRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CollectionRepositoryAccessor::class;
    }
}
