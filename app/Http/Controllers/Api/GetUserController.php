<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Resources\UserResource;

class GetUserController extends Controller
{
    public function getUser() {
        $datas = User::get();
        $userArr = [];
        foreach ($datas as $data) {
            $dataResource = new UserResource($data);
            $userArr[] = $dataResource->jsonSerialize();
        }
        return response(["userList" => $userArr]);
    }
}
