<?php

namespace App\Http\Middleware;

use App\Models\Antrian\WebServiceAntreanUser;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WS_BPJS_Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $username = $request->header('x-username');
        $token = $request->header('x-token');

        // Username tidak boleh kosong
        if (!$username) {
            return response()->json([
                "metaData" => [
                    "message" => 'Username tidak boleh kosong.',
                    "code" => 201
                ]
            ]);
        }

        // Token tidak boleh kosong
        if (!$token) {
            return response()->json([
                "metaData" => [
                    "message" => 'Token tidak boleh kosong.',
                    "code" => 201
                ]
            ]);
        }

        $user = WebServiceAntreanUser::where('username', $username)->first();

        // User tidak ditemukan
        if (!$user) {
            return response()->json([
                "metaData" => [
                    "message" => 'Username atau Token tidak ditemukan.',
                    "code" => 201
                ]
            ]);
        }

        if (!Hash::check($token, $user->token)) {
            return response()->json([
                "metaData" => [
                    "message" => 'Token tidak sesuai.',
                    "code" => 201
                ]
            ]);
        }

        // Token ekspire
        if ($user->expires_at < Carbon::now()) {
            return response()->json([
                "metaData" => [
                    "message" => 'Token Expired',
                    "code" => 201
                ]
            ]);
        }

        return $next($request);
    }
}
