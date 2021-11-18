<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends BaseController
{
    public function login(LoginRequest $request): Response
    {

        $request->authenticate();
        $user = $request->user();
        $meta['token'] = $user->createToken('Laravel Password grand client')->accessToken;

        return $this->response($user, $meta, Response::HTTP_OK, 'Successfully logged in!');
    }

    public function me(Request $request): Response
    {
        return $this->response($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return $this->response([], [], Response::HTTP_OK, 'Successfully logged out!');
    }
}
