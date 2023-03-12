<?php

namespace Illegal\Linky\Facades\Repositories;

use Illegal\Linky\Repositories\ContentRepository as ContentRepositoryAccessor;
use Illuminate\Support\Facades\Facade;

class ContentRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ContentRepositoryAccessor::class;
    }
}
