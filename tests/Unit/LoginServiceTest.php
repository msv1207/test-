<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Auth\JWTService;
use App\Services\Auth\LoginService;
use App\Services\Auth\Exceptions\LoginException;

class LoginServiceTest extends TestCase
{
    // TODO complete tests
    /**
     * @dataProvider loginProvider
     */
    public function test_login($login, $password, $system)
    {
        /** @var JWTService $jwtService */
        $jwtService = app(JWTService::class);

        $token = $jwtService->generate($login, $system);

        /** @var LoginService $loginService */
        $loginService = app(LoginService::class);

        $result = $loginService->login($login, $password);

        $this->assertEquals($token, $result);
    }


    public function test_login_with_incorrect_pass()
    {
        $login = 'BAR_1';
        $password = 'invalid';

        /** @var LoginService $loginService */
        $loginService = app(LoginService::class);

        // Expect the LoginException to be thrown when login fails
        $this->expectException(LoginException::class);

        $loginService->login($login, $password);
    }

    public function test_login_with_incorrect_login()
    {
        $login = 'FFF_1';
        $password = 'foo-bar-baz';

        /** @var LoginService $loginService */
        $loginService = app(LoginService::class);

        // Expect the LoginException to be thrown when login fails
        $this->expectException(LoginException::class);

        $loginService->login($login, $password);
    }


    public static function loginProvider() {
       return  [
          ['BAR_1', 'foo-bar-baz', 'BAR'], ['FOO_1', 'foo-bar-baz', 'FOO'], ['BAZ_1', 'foo-bar-baz', 'BAZ']
        ];
    }
}
