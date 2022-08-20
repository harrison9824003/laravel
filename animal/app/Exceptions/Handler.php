<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;
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
    }

    public function render( $request, Throwable $exception) {
        //dd($exception);

        if( $request->expectsJson() ) {
            
            // 1.資料庫沒有資料
            if( $exception instanceof ModelNotFoundException ) {
                // return response()->json(
                //     [
                //         'error' => '找不到資源'
                //     ],
                //     Response::HTTP_NOT_FOUND
                // );

                return $this->errorResponse(
                    '找不到資源',
                    Response::HTTP_NOT_FOUND
                );
            }     
            
            // 2.網址輸入錯誤
            if ( $exception instanceof NotFoundHttpException ) {
                return $this->errorResponse(
                    '無法找到此網址',
                    Response::HTTP_NOT_FOUND
                );
            }

            // 3.網址不允許該請求動詞
            if ( $exception instanceof MethodNotAllowedException ) {
                return $this->errorResponse(
                    $exception->getMessage(),
                    Response::HTTP_METHOD_NOT_ALLOWED
                );
            }
        }

        return parent::render( $request, $exception);
    }
}
