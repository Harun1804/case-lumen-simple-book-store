<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout']]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username'  => 'required|exists:users,username',
            'password'  => 'required'
        ]);

        try {
            $credentials = $request->only(['username', 'password']);

            if (!$token = auth()->attempt($credentials)) {
                return $this->errorResponse('Unauthorized', 401);
            }

            return $this->successResponse([
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => auth()->user(),
                'expire_in' => auth()->factory()->getTTL() * 60 . ' minutes'
            ], 'Login success');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function userLogin()
    {
        return $this->successResponse(auth()->user(), 'User retrieved successfully');
    }

    public function logout()
    {
        auth()->logout();

        return $this->successResponse([],'Logout success');
    }

    public function refresh()
    {
        return $this->successResponse([
            auth()->refresh(),
        ], 'Refresh token success');
    }
}
