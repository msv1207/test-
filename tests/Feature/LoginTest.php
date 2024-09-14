<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\Auth\JWTService;

class LoginTest extends TestCase
{
    // TODO complete tests
    /**
     * @dataProvider loginProvider
     */
    public function test_login($login, $password, $system)
    {
        /** @var JWTService $jwtService */
        $jwtService = app(JWTService::class);

        $result = json_encode(['status' => 'success', 'token' => $jwtService->generate($login, $system)]);

        $response = $this->post(route('login'), ['login' => $login, 'password' => $password]);

        $response->assertStatus(200);

        $response->assertContent($result);
    }

    public function test_login_with_incorect_pass()
    {
        $login = 'BAR_1';
        $password = 'invalid';

        $response = $this->post(route('login'), ['login' => $login, 'password' => $password]);

        $response->assertStatus(200);
        $result = json_encode(['status' => 'failure']);

        $response->assertContent($result);
    }

    public function test_login_with_incorect_login()
    {
        $login = 'FFF_1';
        $password = 'foo-bar-baz';

        $response = $this->post(route('login'), ['login' => $login, 'password' => $password]);

        $response->assertStatus(200);
        $result = json_encode(['status' => 'failure']);

        $response->assertContent($result);
    }

    public static function loginProvider() {
       return  [
          ['BAR_1', 'foo-bar-baz', 'BAR'], ['FOO_1', 'foo-bar-baz', 'FOO'], ['BAZ_1', 'foo-bar-baz', 'BAZ']
        ];
    }
}
