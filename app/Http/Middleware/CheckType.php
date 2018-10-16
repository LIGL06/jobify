<?php

namespace App\Http\Middleware;

use Closure;

class CheckType
{
    /**
     * @param $request
     * @param Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {
            redirect('home');
        }
        return $next($request);
    }
}
