<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function store(CreateUserRequest $request): Response
    {

        $request_data = $request->all();
        $password = $request_data['password'];
        $request_data['password'] = Hash::make($password);
        $user = User::create($request_data);

        return $this->response(UserResource::make($user));
    }

    public function update()
    {
        // 
    }

    public function index(Request $request)
    {
        $users = User::paginate(self::PAGINATION_PER_PAGE);

        return $this->response(UserResource::collection($users));
    }

    public function show(User $user)
    {
        return $this->response(UserResource::make($user));
    }
}
