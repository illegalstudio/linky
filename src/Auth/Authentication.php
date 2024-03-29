<?php

namespace Illegal\Linky\Auth;

use Illegal\InsideAuth\Authenticator;
use Illegal\InsideAuth\InsideAuth;

/**
 * This class is an easy access to the InsideAuth authenticator class and parameters
 */
class Authentication
{
    /**
     * The InsideAuth authenticator instance
     */
    private ?Authenticator $authenticator;

    /**
     * Retrieve the authenticator instance from the authName
     */
    public function __construct(
        private readonly string $authName,
        private readonly bool $authEnabled = true
    )
    {
        $this->authenticator = InsideAuth::getAuthenticator($this->authName);
    }

    /**
     * Returns the default guard name
     */
    public function guard(): string
    {
        return $this->authEnabled ? $this->authenticator->security_guard : 'web';
    }

    /**
     * Returns the default provider name
     */
    public function middleware(): string
    {
        return $this->authEnabled ? $this->authenticator->middleware_verified : 'auth';
    }

    /**
     * Return the default web middleware name
     */
    public function webMiddleware(): string
    {
        return $this->authenticator->middleware_web;
    }

}
