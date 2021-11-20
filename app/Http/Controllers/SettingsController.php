<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdatePasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends BaseController
{
    /**
     * Update User Password function
     * @param UserUpdatePasswordRequest $request
     * @param $id
     * @return Response
     */
    public function update(UserUpdatePasswordRequest $request): Response
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $this->authorize(__FUNCTION__, $user);

        $request_data = $request->only('password', 'new_password');

        if (!Hash::check($request->get('password'), $user->password)) {
            return $this->response([], [], Response::HTTP_FORBIDDEN, 'Your password is not correct');
        }

        $new_password = Hash::make($request->get('new_password'));

        $request_data['password'] = $new_password;

        $user->update($request_data);

        return $this->response(UserResource::make($user));
    }
}
