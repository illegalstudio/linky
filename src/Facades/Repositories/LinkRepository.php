<?php

namespace Illegal\Linky\Facades\Repositories;

use Illegal\Linky\Repositories\LinkRepository as LinkRepositoryAccessor;
use Illuminate\Support\Facades\Facade;

class LinkRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LinkRepositoryAccessor::class;
    }
}
