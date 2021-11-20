<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'address' => 'string|max:255',
            'phone_number' => 'string|min:3|max:50',
            'email' => 'string|email|max:255|unique:users,email',

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
