<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthController extends Controller
{
    use ResponseTrait;

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$request->email) {
            return $this->errorResponse('Email is required', [], 400);
        }

        if (!$request->password) {
            return $this->errorResponse('Password is required', [], 400);
        }

        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->errorResponse('Unauthorized', [], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return $this->successResponse('Successfully Requested', [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expiry_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }

    public function me()
    {
        $user = auth()->user();
        return $this->successResponse('Successfully Requested', $user);
    }

    public function logout()
    {
        try {
            $token = JWTAuth::getToken();

            if (!$token) {
                return $this->errorResponse('Token not provided', [], 400);
            }

            JWTAuth::invalidate($token);

            return $this->successResponse('Successfully logged out', []);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->errorResponse('Token is invalid', [], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return $this->errorResponse('Token is missing or expired', [], 400);
        }
    }
}
