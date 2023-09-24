<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware akan digunakan berdasarkan jenis login yang diberikan dalam parameter "jenis_login"
        $this->middleware('auth:admin,siswa,guru', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['jenis_login', 'username', 'password']);
        $guard = $credentials['jenis_login'];

        if (! $token = auth($guard)->attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
        ])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        // Menggunakan guard yang sesuai berdasarkan jenis login
        $guard = Auth::getDefaultDriver();
        return response()->json(auth($guard)->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // Menggunakan guard yang sesuai berdasarkan jenis login
        $guard = Auth::getDefaultDriver();
        auth($guard)->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        // Menggunakan guard yang sesuai berdasarkan jenis login
        $guard = Auth::getDefaultDriver();
        return $this->respondWithToken(auth($guard)->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        // Menggunakan guard yang sesuai berdasarkan jenis login
        $guard = Auth::getDefaultDriver();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($guard)->factory()->getTTL() * 120
        ]);
    }
}
