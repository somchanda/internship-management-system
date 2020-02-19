<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Trainer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user() && (Auth::user()->type == 'Trainer' || Auth::user()->type == 'Admin')) {
            return $next($request);
        }else if(Auth::user() && Auth::user()->type == 'Trainee'){
            return back();
        }

        return redirect()->route('login');
    }
}
