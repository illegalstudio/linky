<?php

namespace Illegal\Linky\Facades\Services;

use Illegal\Linky\Services\SlugGenerator as SlugGeneratorAccessor;
use Illuminate\Support\Facades\Facade;

class SlugGenerator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SlugGeneratorAccessor::class;
    }
}
