<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\Exceptions\LoginException;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginService $loginService): JsonResponse
    {
        try {
            $token = $loginService->login($request->login, $request->password);
        } catch (LoginException) {
            return response()->json(['status' => 'failure']);
        }

        return response()->json(['status' => 'success', 'token' => $token]);
    }
}
