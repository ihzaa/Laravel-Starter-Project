<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ValidationHelper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        ValidationHelper::validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::whereUsername($request->username)->orWhere('email', $request->username)->first();
        if ($user == null) {
            return response()->json([
                'message' => "User tidak ditemukan!"
            ], 400);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' =>  'Username atau password salah!'
            ], 400);
        }

        //Create token
        try {
            $token = $this->getAccessToken($user);
            // refresh token active for 4 weeks (1 month)
            $refresh_token = auth()->guard('api')->setTTL(20160 * 2)->login($user);
            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                    'access_token' => $token
                ], 400);
            }
            $user->refresh_token = $refresh_token;
            $user->save();
            return response()->json([
                'message' => 'login success',
                'access_token' => $token,
                'refresh_token' => $user->refresh_token
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
                'error' => $e
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $user = auth()->guard('api')->user();
        $user->refresh_token = NULL;
        $user->save();
        auth()->guard('api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function check()
    {
        return auth()->guard('api')->user();
    }

    public function refresh(Request $request)
    {
        ValidationHelper::validate($request, [
            'refresh_token' => ['required']
        ]);

        $refresh_token = $request->refresh_token;

        $user = User::where('refresh_token', $refresh_token)->first();
        if (!$user) {
            return response()->json(['message' => 'Refresh Token not found'], 400);
        }

        try {
            $request->headers->set('Authorization', 'Bearer ' . $refresh_token);
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['message' => 'Refresh Token is Invalid'], 400);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['message' => 'Refresh Token is Expired'], 400);
            } else {
                return response()->json(['message' => 'Refresh Token not found'], 400);
            }
        }
        $token = $this->getAccessToken($user);

        return response()->json([
            'message' => 'Refresh token success!',
            'access_token' => $token,
        ]);
    }

    private function getAccessToken($user)
    {
        return auth()->guard('api')->setTTL(15)->login($user);
    }
}
