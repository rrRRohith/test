<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e, $request){
            if($request->is('api/*'))
                return $this->api($e, $request);
        });
    }

    /**
     * Handle API exceptions.
     * @return \Illuminate\Http\Response
     */
    protected function api($e, $request)
    {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage() ? $e->getMessage() : __('messages.error')
        ],
        method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 400);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        return $exception->redirectTo() ? redirect()->guest($exception->redirectTo()) : response()->json([
            'success' => false,
            'message' => $exception->getMessage()
        ], 401);
    }
}
