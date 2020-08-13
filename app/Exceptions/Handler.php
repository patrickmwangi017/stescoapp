<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Auth;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        \Illuminate\Support\Arrs::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        
        // $guard = array_get($exception->guards(), 0);
        $guard = Arrs::get($exception->guards(), 0);
        
        switch ($guard) {
        case 'accountants':
         return redirect()->guest(route('accountants.login'));
         break;
        case 'shipmentmanager':
         return redirect()->guest(route('shipmentmanager.login'));
        break;
        case 'ordermanager':
         return redirect()->guest(route('ordermanager.login'));
        break;
        case 'stockmanager':
         return redirect()->guest(route('stockmanager.login'));
        break;
        case 'drivers':
         return redirect()->guest(route('drivers.login'));
        break;
        case 'suppliers':
         return redirect()->guest(route('suppliers.login'));
        break;
        case 'web':
            return redirect()->guest(route('signin'));
           break;

        default:
        return redirect()->guest(route('user.signin'));
        }
        
return redirect()->guest(route('login'));
    }

}
