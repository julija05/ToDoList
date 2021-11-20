<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function store(CreateUserRequest $request): Response
    {
        $this->authorize(__FUNCTION__, User::class);
        $request_data = $request->all();
        $password = $request_data['password'];
        $request_data['password'] = Hash::make($password);
        $user = User::create($request_data);

        return $this->response(UserResource::make($user));
    }

    public function update(UpdateUserRequest $request, $id)
    {

        $user = User::find($id);
        $this->authorize(__FUNCTION__, $user);
        $request_data = $request->except('password', 'status');
        $user->update($request_data);

        return $this->response(UserResource::make($user));
    }

    public function index(Request $request)
    {
        $this->authorize(__FUNCTION__, User::class);

        $users = User::paginate(self::PAGINATION_PER_PAGE);

        return $this->response(UserResource::collection($users));
    }

    public function show(User $user)
    {
        $this->authorize(__FUNCTION__, $user);
        return $this->response(UserResource::make($user));
    }

    public function destroy(User $user)
    {
        $this->authorize(__FUNCTION__, $user);
        $user->delete();

        return $this->response([], [], Response::HTTP_NO_CONTENT);
    }
}
