<?php

namespace App\Exceptions;

use App\Enum\HttpResponseStatusCodeEnum;
use App\Enum\ResponseEnum;
use App\Utils\HttpResponseUtils;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    use HttpResponseUtils;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport
        = [
            //
        ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash
        = [
            'password',
            'password_confirmation',
        ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (preg_match('/Integrity constraint violation/', $exception->getMessage())) {
            return response()->json(
                HttpResponseUtils::httpClientError(ResponseEnum::HAS_RELATION), HttpResponseStatusCodeEnum::BAD_REQUEST
            );
        }

        $code = (($exception->getCode())
            ?: (($exception->getStatusCode()) ?: ($exception->httpStatusCode)));

        return response()->json(
            HttpResponseUtils::httpClientError($exception->getMessage()), $code
        );
    }
}
