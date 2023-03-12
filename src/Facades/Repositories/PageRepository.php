<?php

namespace Illegal\Linky\Facades\Repositories;

use Illegal\Linky\Repositories\PageRepository as PageRepositoryAccessor;
use Illuminate\Support\Facades\Facade;

class PageRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return PageRepositoryAccessor::class;
    }
}
