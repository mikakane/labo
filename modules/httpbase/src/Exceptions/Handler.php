<?php
namespace Chatbox\HttpBase\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $data = [
            "status" => "ERROR",
            "message" => $e->getMessage(),
            "line" => $e->getLine(),
            "file" => $e->getFile(),
            "message" => $e->getMessage(),
            "class" => get_class($e),
        ];

        if(env("DEBUG_WITH_TRACE",false)){
            $data["trace"] = $e->getTrace();
        }

        return JsonResponse::create($data,500);
    }

}
