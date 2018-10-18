<?php

namespace App\Http\Middleware;

use Closure;

class CheckType
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->roles()->first()->name) {
            redirect('home');
        }
        return $next($request);
    }
}
