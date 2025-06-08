<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // app/Http/Middleware/AdminMiddleware.php
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika pengguna sudah login DAN memiliki status admin
        if (Auth::check() && Auth::user()->is_admin) { 
            return $next($request);
    }

    return redirect('/dashboard')->withErrors('Anda tidak memiliki akses sebagai Admin.');
}
}