<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Resources\UserResource;
use Illuminate\Http\Request;

class GetUserController extends Controller
{
    /*
     * Get list user
     */
    public function getListUsers() {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = User::query()
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);
        return UserResource::collection($query);
//        $datas = User::get();
//        $userArr = [];
//        foreach ($datas as $data) {
//            $dataResource = new UserResource($data);
//            $userArr[] = $dataResource->jsonSerialize();
//        }
//        return response([
//            "userList" => $userArr
//        ]);
    }

    /*
     * Get user info
     */
    public function getUser(Request $request) {

        $data = User::get();
        $id = $request;
        return response([
            "data" => new UserResource($data)
        ]);
    }
}
