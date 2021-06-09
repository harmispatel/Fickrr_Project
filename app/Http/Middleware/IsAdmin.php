<?php

namespace Fickrr\Http\Middleware;

use Closure;

class IsAdmin
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


       // echo "<pre>";print_r(auth()->user());exit;
        if(auth()->user()->isAdmin() || auth()->user()->isManfact()) {
            return $next($request);
        }
		return redirect('/');
    }
}
