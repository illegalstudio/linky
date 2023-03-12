<?php

namespace Illegal\Linky\Facades\Repositories;

use Illegal\Linky\Repositories\HitRepository as HitRepositoryAccessor;
use Illuminate\Support\Facades\Facade;

class HitRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return HitRepositoryAccessor::class;
    }
}
