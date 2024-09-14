<?php

namespace App\Services\Auth\Strategy;

interface LoginStrategy
{
    public function login(string $login, string $password): bool;
}
