<?php

namespace App\Services\Auth\Strategy;

use External\Foo\Auth\AuthWS;
use External\Foo\Exceptions\AuthenticationFailedException;


class FooLoginStrategy implements LoginStrategy
{
    public function __construct(readonly AuthWS $authWS)
    {
    }

    public function login(string $login, string $password): bool
    {
        try {
            $this->authWS->authenticate($login, $password);

            return true;
        } catch (AuthenticationFailedException $exception) {
            return false;
        }
    }
}
