<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;
use App\Resources\UserResource;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            $credentials = $request->validate([
                'email'=> ['required', 'email'],
                'password' => 'required',
                'remember' => 'boolean'
            ]);
            $remember = $credentials['remember'] ?? false;
            unset($credentials['remember']);
            if (!Auth::attempt($credentials, $remember)) {
                return response([
                    'message' => 'Email or password is incorrect'
                ], 422);
            }

            /** @var \App\Models\User $user */
            $user = Auth::user();
//            if (!$user->is_admin) {
//                Auth::logout();
//                return response([
//                    'message' => 'You don\'t have permission to authenticate as admin'
//                ], 403);
//            }
            if (!$user->email_verified_at) {
                Auth::logout();
                return response([
                    'message' => 'Your email address is not verified'
                ], 403);
            }
            $token = $user->createToken('main')->plainTextToken;
            return response([
                'user' => new UserResource($user),
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], $e->getCode());
        }

    }

    public function logout()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response('', 204);
    }
}
