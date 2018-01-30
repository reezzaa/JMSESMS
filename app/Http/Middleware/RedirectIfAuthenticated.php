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
            case 'projectmanager':
                if (Auth::guard($guard)->check()) {
                     return redirect()->route('pm.home');
                    }
                break;
             case 'budgetdepartment':
                if (Auth::guard($guard)->check()) {
                     return redirect()->route('bd.home');
                    }
                break;
             case 'operations':
                if (Auth::guard($guard)->check()) {
                     return redirect()->route('o.home');
                    }
                break;
            
            default:
                if (Auth::guard($guard)->check()) {
                     return redirect('/');
                    }
                break;
        }
       

        return $next($request);
    }
}
