<?php

namespace Illegal\Linky\Auth\Passwords;

use Illuminate\Auth\Passwords\PasswordBrokerManager as IlluminatePasswordBrokerManager;

class PasswordBrokerManager extends IlluminatePasswordBrokerManager
{
    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->broker('linky_users')->{$method}(...$parameters);
    }
}
