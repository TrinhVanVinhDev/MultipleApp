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
    }

    /*
     * Get user info
     */
    public function getUser($id) {

        $data = User::where('id', $id)->first();
        return response([
            "data" => new UserResource($data)
        ]);
    }
}
