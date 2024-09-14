<?php

namespace App\Services\Auth\Strategy;

use External\Baz\Auth\Authenticator;
use External\Baz\Auth\Responses\Success;
use App\Services\Auth\Strategy\LoginStrategy;

class BazLoginStrategy implements LoginStrategy
{
    public function __construct(readonly Authenticator $authenticator)
    {
    }

    public function login(string $login, string $password): bool
    {
        return $this->authenticator->auth($login, $password) instanceof Success;
    }
}
