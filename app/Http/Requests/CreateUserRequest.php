<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return true;
    // }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'string|required|max:255',
            'last_name' => 'string|required|max:255',
            'address' => 'string|required|max:255',
            'phone_number' => 'string|required|min:3|max:50',
            'email' => 'string|required|email|max:255|unique:users,email',
            'password' => 'string|min:6|max:255|required',
        ];
    }
}
