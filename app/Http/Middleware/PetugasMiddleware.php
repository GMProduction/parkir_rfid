<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PetugasMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() == null || auth()->user()->roles !== 'petugas'){
            return redirect('/login');
        }
        return $next($request);
    }
}
