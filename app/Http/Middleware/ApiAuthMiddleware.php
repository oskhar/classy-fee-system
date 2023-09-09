<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json([
                    'message' => 'Anda belum login !! Login terlebih dahulu untuk mengakses halaman ini'
                ])->setStatusCode(401);
            }

            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Anda belum login !! Login terlebih dahulu untuk mengakses halaman ini'
            ])->setStatusCode(401);
        }
    }
}
