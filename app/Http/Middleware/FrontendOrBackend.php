<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Session;
use App\Core\Check;
use Illuminate\Support\Facades\Route;

class FrontendOrBackend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
       if(Check::validSession()){
        $currentPath= $request->route()->getName();
        $currentAction = str_replace(".","/",$currentPath);

        if (strpos($currentAction, 'backend_app/') !== false) {
            return $next($request);
        }
        else{
            return redirect('backend_app/dashboard');
        }
    }
    return $next($request);
}
}
