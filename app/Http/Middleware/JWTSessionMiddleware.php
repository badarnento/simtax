<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTSessionMiddleware
{
    public function handle(Request $request, Closure $next)
{
    try {

        // dd($request->cookie('token'), $request->headers->all());
        // Ambil token dari session atau cookie
        // $token = session('token') ?? $request->cookie('token');
        // $token = $request->bearerToken() ?? $request->cookie('jwt_token');
        $token = Cookie::get('jwt_token');
        $token = $request->cookie('jwt_token');

        print_r($token);

        die;

/*         print_r($token);die;

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMjAvYXBpL2xvZ2luIiwiaWF0IjoxNzQxNzcxMzA0LCJleHAiOjE3NDE3NzQ5MDQsIm5iZiI6MTc0MTc3MTMwNCwianRpIjoiY2xiMHJ3TFA2SmtjSzl4MiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0._IruwaWFWD3TK7Q_SjVMm_hbadNRpPu55S5Rf9P-E2U"; */

        if (!$token) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Set token dan autentikasi user
        JWTAuth::setToken($token);
        $user = JWTAuth::authenticate();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Token tidak valid.');
        }

        // Tambahkan user ke request agar bisa digunakan di controller
        $request->merge(['auth_user' => $user]);

    } catch (JWTException $e) {
        return redirect()->route('login')->with('error', 'Session expired.');
    }

    return $next($request);
}

}
