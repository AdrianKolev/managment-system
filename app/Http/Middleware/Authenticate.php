<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Get JWT From requst and add it to every request header 
     *
     * @param [type] $request
     * @param Closure $next
     * @param [type] ...$guards
     * @return void
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if ($jwt = $request->cookie('jwt')) {
            $request->headers->set('Authorization', 'Bearer ' . $jwt);
        }


        $this->authenticate($request, $guards);

        return $next($request);
    }
}
