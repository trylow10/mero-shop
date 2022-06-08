<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user() ?->name != 'Trilochan Aryal'){
            abort(HttpFoundationResponse::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
