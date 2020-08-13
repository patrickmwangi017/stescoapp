<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'accountants':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('accountantshome');
                }
            break;
            case 'shipmentmanager':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('shipmentmanagerhome');
                }
            break;
            case 'ordermanager':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('ordermanagerhome');
                }
            break;
            case 'stockmanager':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('stockmanagerhome');
                }
            break;
            case 'drivers':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('drivershome');
                }
            break;
            case 'suppliers':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('suppliershome');
                }
            break;

            default:
            if (Auth::guard($guard)->check()) {
                return redirect()->route('product.index');
            }
        break;
        }

        
        if ($guard == "accountants" && Auth::guard($guard)->check()) {
            return redirect('/accountant');
        }
        if ($guard == "drivers" && Auth::guard($guard)->check()) {
            return redirect('/driver');
        }
        if ($guard == "ordermanager" && Auth::guard($guard)->check()) {
            return redirect('/ordermanager');
        }
        if ($guard == "shipmentmanager" && Auth::guard($guard)->check()) {
            return redirect('/shipmentmanager');
        }
        if ($guard == "stockmanager" && Auth::guard($guard)->check()) {
            return redirect('/stockmanager');
        }
        if ($guard == "suppliers" && Auth::guard($guard)->check()) {
            return redirect('/suppliers');
        }
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }
        


        return $next($request);
    }
}