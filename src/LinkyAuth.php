<?php

namespace Illegal\Linky;

use Illegal\Linky\Auth\Authentication;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin Authentication
 * @see Authentication
 */
class LinkyAuth extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return Authentication::class;
    }
}
