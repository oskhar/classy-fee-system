<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Mendapatkan jenis login dari permintaan
            $jenisLogin = $request->input('jenis_login');

            if (!$jenisLogin) {
                return response()->json(['error' => 'Jenis login tidak diberikan'], 400);
            }

            if (!$user = auth($jenisLogin)->user()) {
                return response()->json(['error' => 'Token not provided'], 401);
            }

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $request->auth = $user;

            return $next($request);
        } catch (Exception $e) {
            // Tangani kesalahan autentikasi JWT
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
