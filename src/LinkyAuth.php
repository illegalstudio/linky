<?php

namespace Illegal\Linky;

use Illegal\InsideAuth\InsideAuth;

final class LinkyAuth
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

    public static function isLoggedInMiddleware(): string
    {
        return InsideAuth::getIsLoggedInMiddlewareName(config('linky.auth.inside_auth_name'));
    }

    /**
     * Get the name of the middleware to allow guest users
     */
    public static function guestMiddleware(): string
    {
        return InsideAuth::getGuestMiddlewareName(config('linky.auth.inside_auth_name'));
    }

    /**
     * Get the name of the middleware to manage standard web requests
     */
    public static function webMiddleware(): string
    {
        return InsideAuth::getWebMiddlewareName(config('linky.auth.inside_auth_name'));
    }
}
