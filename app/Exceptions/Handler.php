<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $response = app('App\Http\Controllers\BaseController')->response(['Message' => 'Your Authentication is invalid'], ['code' => Response::HTTP_UNAUTHORIZED, 'message' => "Your Authentication is invalid"], Response::HTTP_UNAUTHORIZED, "Authentication invalid");
            return $response;
        } else if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            $response = app('App\Http\Controllers\BaseController')->response(['Message' => 'Your are not authorized'], ['code' => Response::HTTP_UNAUTHORIZED, 'message' => "Your are not authorized"], Response::HTTP_UNAUTHORIZED, "Not Authorized");
            return $response;
        } else if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $response = app('App\Http\Controllers\BaseController')->response(['Message' => 'The model does not exist in our databse'], ['code' => Response::HTTP_NOT_FOUND, 'message' => "The model does not exist in our databse"], Response::HTTP_NOT_FOUND, "Model not found");
            return $response;
        } else if ($exception instanceof \Symfony\Component\HttpKernel\Exception\BadRequestHttpException) {
            $response = app('App\Http\Controllers\BaseController')->response(['Message' => 'Bad request, http exception'], ['code' => Response::HTTP_BAD_REQUEST, 'message' => "Bad request, http exception"], Response::HTTP_BAD_REQUEST, "Bad request");
            return $response;
        } else if ($exception instanceof \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException) {
            $response = app('App\Http\Controllers\BaseController')->response(['Message' => 'Unprocessable entity'], ['code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'message' => "Unprocessable entity"], Response::HTTP_UNPROCESSABLE_ENTITY, "Unprocessable entity");
            return $response;
        } else if (env("APP_ENV") != "local") {
            $response = app('App\Http\Controllers\BaseController')->response(['Message' => 'Unknown exception'], ['code' => Response::HTTP_INTERNAL_SERVER_ERROR, 'message' => "Unknown exception"], Response::HTTP_INTERNAL_SERVER_ERROR, "Unknown exception");
            return $response;
        }

        return parent::render($request, $exception);
    }
}
