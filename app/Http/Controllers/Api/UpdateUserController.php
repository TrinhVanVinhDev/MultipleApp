<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UpdateUserController extends Controller
{
    public function update($id, Request $request) {
        try {
            $userInfo = $request->validate([
                'name' => ['string', 'max:255'],
                'email' => ['string', 'email', 'max:255', 'unique:users'],
            ]);
            DB::beginTransaction();
            $user = User::where('id', $id);
            $user->update($userInfo);
            DB::commit();
            return response([
                "message" => "Update success!"
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response([
                "message" => $e->getMessage()
            ], 400);
        }
    }
}
