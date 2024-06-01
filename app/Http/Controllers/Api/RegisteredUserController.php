<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function registerAccount(Request $request) {
        try{
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            DB::beginTransaction();
            $data['password'] = bcrypt($data['password']);
            $data['email_verified_at'] = null;
            $data['is_admin'] = false;
            $user = User::create($data);
            $user->save();
            DB::commit();
            return response([
                "user" => new UserResource($user),
                "token" => $user->createToken('main')->plainTextToken
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response([
               'message' => $e->getMessage()
            ], 400);
        }
    }
}
