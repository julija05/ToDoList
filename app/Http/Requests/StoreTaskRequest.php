<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required|max:255',
            'description' => 'string|required',
            'toDoList_id' => 'integer|exists:to_do_lists,id',
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
