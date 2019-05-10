<?php

namespace App\Http\Middleware;

use Closure;

class AllowXFrameOrigin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'ALLOW FROM '.$_SERVER['HTTP_REFERER'] ?? '');

        return $response;
    }
}
