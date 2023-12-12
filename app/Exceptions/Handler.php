<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class Handler extends ExceptionHandler
{

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
            //
        });

        // $this->renderable(function (Throwable $e, $request) {

        //     $response = $this->prepareResponse($request, $e);

        //     // Error handling SQLSTATE[23000]: Integrity constraint violation: 1451
        //     if ($response->isServerError()) {
        //         $exception = $response->exception;

        //         if ($this->isSqlIntegrityConstraintViolationError($exception)) {
        //             $sql = str_replace('delete', 'select *', $exception->getSql());
        //             $bindings = $exception->getBindings();
        //             $results = DB::select($sql, $bindings);
        //             dd($results);
        //         }
        //     }

        //     return $response;
        // });
    }

    private function isSqlIntegrityConstraintViolationError($exception)
    {
        if ($exception instanceof \PDOException) {
            $errorCode = $exception->getCode();
            return $errorCode === '23000';
        }

        return false;
    }
}
