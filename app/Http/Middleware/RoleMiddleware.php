<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  // Role yang diperlukan: 'admin' atau 'siswa'
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
{
    if (session('role') != $role) {
        abort(403);
    }

    return $next($request);
}

}