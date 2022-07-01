<?php

namespace App\Http\Middleware;

use Closure;

class checkLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$levels)
    {   
        if (isset($request->user()->status)) {
            if (in_array($request->user()->status, $levels)) {
                return $next($request);
            }
        }
     
        return redirect('/');
    }
}
