<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckEmployee
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
        if (Auth::check() && $request->user()->isEmployee()) {
            return $next($request);
        }
        return redirect('home');
    }
}
