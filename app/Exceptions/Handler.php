<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\ApiResponse;

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
}
