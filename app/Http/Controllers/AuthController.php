<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request, LoginAction $loginAction)
    {
        $passwordRequest = $loginAction->run($request->all());
        $tokenContent = $passwordRequest['content'];
        $tokenResponse = $passwordRequest['response'];

        if (!empty($tokenContent['access_token'])) {
            return $tokenResponse;
        }

        return response()->json([
            'message' => 'Unauthenticated'
        ], 404);
    }

    public function register(UserRegisterRequest $request, RegisterAction $registerAction)
    {
        $user = $registerAction->run($request->all());

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Registration failed'], 409);
        }

        return response()->json(['success' => true, 'message' => 'Registration succeeded']);
    }

    public function logout()
    {
        $token = Auth::user()->token();
        $token->revoke();
        return response()->json(['success' => true, 'message' => 'You have been successfully logged out!']);
    }
}
