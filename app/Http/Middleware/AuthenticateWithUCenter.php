<?php

namespace App\Http\Middleware;

use Closure;
use Thinker\Facades\UCenter;

class AuthenticateWithUCenter
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
        if (!session()->has('ucenter')) {
            return UCenter::webAuth()->redirect();
        }

        return $next($request);
    }
}
