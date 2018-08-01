<?php

namespace App\Http\Middleware;

use Closure;

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

            $url = sprintf(
                '%s/oauth/authorize?client_id=%s&redirect_uri=%s&response_type=code',
                config('ucenter.root'),
                config('ucenter.client_id'),
                config('ucenter.redirect_uri')
            );

            return redirect($url);
        }

        return $next($request);
    }
}
