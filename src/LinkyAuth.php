<?php

namespace Illegal\Linky;

use Illegal\InsideAuth\InsideAuth;

final class Auth
{
    /**
     * Get the name of the guard used to authenticate users.
     */
    public static function guard(): string
    {
        return InsideAuth::getGuardName(config('linky.auth.inside_auth_name'));
    }

    /**
     * Get the name of the middleware used to authenticate users.
     */
    public static function middleware(): string
    {
        return InsideAuth::getMiddlewareName(config('linky.auth.inside_auth_name'));
    }
}
