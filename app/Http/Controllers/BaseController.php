<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class BaseController extends Controller
{
    public const PAGINATION_PER_PAGE = 5;
    /**
     * Function responsible for generating JSON response
     * @param array $data
     * @param array $meta
     * @param int $status
     * @param string $message
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function response($data = [], array $meta = [], int $status = 200, string $message = 'Success'): Response
    {
        $response = [
            'meta' => [
                'status' => $status,
                'message' => $message,
            ],
        ];

        if (!empty($meta)) {
            $response['meta'] = array_merge($response['meta'], $meta);
        }

        if ($data instanceof AnonymousResourceCollection) {
            $response['meta']['pagination'] = Arr::except($data->resource->toArray(), 'data');
        }
        $response['data'] = $data;

        return response($response, $status);
    }
}
