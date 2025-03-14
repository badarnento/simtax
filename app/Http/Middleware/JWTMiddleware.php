<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JWTMiddleware
{

    use ResponseTrait;
    
    public function handle($request, Closure $next)
    {

        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            try {
                $newToken = JWTAuth::refresh(JWTAuth::getToken());
                $user = JWTAuth::setToken($newToken)->toUser();
            } catch (JWTException $e) {
                return $this->errorResponse('Session expired, please relogin.', null, 401);
            }
        } catch (JWTException $e) {
            return $this->errorResponse('Session expired, please relogin.', null, 401);
        }

        return $next($request);
    }
}
