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
        // adding a switch statement for the $guard value.
        switch($guard){
            // If $guard value is admin then checking if its authenticated then retrun to the /admin which is our dashboard route
            case 'admin' :
                if (Auth::guard($guard)->check()) {
                    return redirect('/admin');
                }
                break;
            // If the $guard value is user then we are returning to the making website homepage /.
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
        }
        return $next($request);
    }
}
