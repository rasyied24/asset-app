<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserLoggedInMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Ambil token dari cookie
            $token = $request->cookie('jwt_token');

            if (!$token) {
                return redirect('/users/login');
            }

            JWTAuth::setToken($token); // Pasang token secara manual
            $user = JWTAuth::authenticate();

            if (!$user) {
                return redirect('/users/login');
            }

            return $next($request);

        } catch (JWTException $e) {
            return redirect('/users/login');
        }


    }
}
