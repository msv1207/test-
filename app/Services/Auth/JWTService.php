<?php

namespace App\Services\Auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTService
{
    public const DEFAULT_ALG = 'HS256';

    public function generate(string $login, string $system): string
    {
        $payload = [
            'login' => $login,        // Store the user login
            'system' => $system,      // Store the system identifier
            'iat' => time(),          // Issued at (current timestamp)
            'exp' => time() + (60 * 60) // Expiration (1 hour from now)
        ];

        $secretKey = config('jwt.secret');

        return JWT::encode($payload, $secretKey, self::DEFAULT_ALG);
    }

    public function decode($token): object
    {
        $secretKey = config('jwt.secret');

        return JWT::decode($token, new Key($secretKey, self::DEFAULT_ALG));
    }

    public function refresh($token) {
        // TODO
    }
}
