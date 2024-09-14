<?php

namespace App\Services\Auth\Strategy;

use External\Bar\Auth\LoginService;

class BarLoginStrategy implements LoginStrategy
{
    public function __construct(readonly LoginService $loginService)
    {
    }

    public function login(string $login, string $password): bool
    {
        return $this->loginService->login($login, $password);
    }
}
