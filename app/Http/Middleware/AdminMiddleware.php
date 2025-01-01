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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
        // if (Auth::check() && Auth::user()->role === 'admin') {
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
        // return Auth::user()->role;

    }
}
