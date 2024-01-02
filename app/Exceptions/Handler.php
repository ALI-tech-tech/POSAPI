<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\ApiResponse;
use Illuminate\Auth\AuthenticationException;

/**
 * Convert an authentication exception into an unauthenticated response.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Illuminate\Auth\AuthenticationException  $exception
 * @return \Illuminate\Http\Response
 */



class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if ($e instanceof ModelNotFoundException) {
                 $this->failed_response(data: [
                    'meesage'=> 'Not Found'
                 ]);
            }
            // else if ($e instanceof requestMethodNotAllowed) {
        //         $this->failed_response(data: [
        //            'meesage'=> 'Forbidden'
        //         ]);
        //    }
        });
    }
    protected function unauthenticated($request, AuthenticationException $exception)
{
    if ($request->expectsJson()) {
        return
        $this->failed_response(data: [
            'meesage'=> 'Unauthenticated'
         ]);
    }

    return redirect()->guest(route('login'));
}
  

}
