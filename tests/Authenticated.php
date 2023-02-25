<?php

namespace Illegal\Linky\Tests;

use Illuminate\Contracts\Auth\Authenticatable;

class Authenticated implements Authenticatable
{
    public static function user(): self
    {
        return new self();
    }

    public $email= 'johnsmith@email.com';

    public function getAuthIdentifierName()
    {
        return 'illegal-linky Test';
    }

    public function getAuthIdentifier()
    {
        return 'illegal-linky-test';
    }

    public function getAuthPassword()
    {
        return 'secret';
    }

    public function getRememberToken()
    {
        return 'i-am-illegal-linky';
    }

    public function setRememberToken($value)
    {
        //
    }

    public function getRememberTokenName()
    {
        //
    }
}
