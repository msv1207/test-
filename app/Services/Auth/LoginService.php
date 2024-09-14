<?php

namespace App\Services\Auth;

use App\Enum\CompanyStrategyEnum;
use App\Services\Auth\Strategy\LoginStrategy;
use App\Services\Auth\Exceptions\LoginException;

class LoginService
{
    public function __construct(readonly JWTService $JWTService)
    {
    }

    public function login(string $login, string $password): string
    {
        foreach (CompanyStrategyEnum::array() as $key => $strategy) {

            /** @var LoginStrategy $strategy */
            $strategy = app($strategy);

            if ($strategy->login($login, $password)) {
                return $this->JWTService->generate($login, $key);
            }
        }

        throw new LoginException();
    }
}
