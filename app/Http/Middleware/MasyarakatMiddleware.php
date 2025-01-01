<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MasyarakatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
        // if (Auth::check() && Auth::user()->role === 'masyarakat') {
        //     return $next($request);
        // }

        // if ($request->path() === '/') {
        //     abort(403, 'Access denied.');
        // }

        // return redirect('/')->with('error', 'You do not have masyarakat access.');
        // if (Auth::check() && Auth::user()->role === 'masyarakat') {
        //     return $next($request);
        // } else {
        //     abort(403, 'Access denied.');
        // }
        // if (!Auth::check()) {
        //     return redirect('/')->with('error', 'You need to be logged in to access this page.');
        // }

        // // Jika user memiliki role masyarakat, lanjutkan request
        // if (Auth::user()->role === 'masyarakat') {
        //     return $next($request);
        // }

        // // Jika bukan role masyarakat, tampilkan 403
        // abort(403, 'Access denied.');
    }
}
