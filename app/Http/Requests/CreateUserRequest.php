<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

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
            'username' => 'string|required|max:255|unique:users',
            'email' => 'string|required|email|max:255|unique:users,email',
            'password' => 'string|min:6|max:255|required|confirmed',
        ];
    }
    /**
     * Return validation errors
     *
     * @return array
     */
    protected function failedValidation($validator): Response
    {
        throw new HttpResponseException(response()->json(
            [
                'meta' => [
                    'status' => 400,
                    'message' => 'Invalid input',
                ],
                "data" => $this->validator->errors()->all(),
            ],
            Response::HTTP_BAD_REQUEST

        ));
    }
}
