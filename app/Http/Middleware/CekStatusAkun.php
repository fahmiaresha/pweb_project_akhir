<?php

namespace App\Http\Middleware;

use Closure;

class CekStatusAkun
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
        if (in_array($request->user()->status_akun,$levels)){
            return $next($request);
        }
        return redirect('/404');
        // return $next($request);
    }
}
