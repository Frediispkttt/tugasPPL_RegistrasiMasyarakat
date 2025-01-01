<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class StatusAndRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, $status, $role): Response
    // {
    //     // return $next($request);
    //     $user = $request->user();

    //     if (!$user || $user->status !== $status || $user->role !== $role) {
    //         return response()->json([
    //             'message' => 'Unauthorized access',
    //         ], 403);
    //     }

    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next, string $role)
    {
        // return $next($request);
        $user = $request->user();
        if (!$user) {
            return redirect('/login')->with('error', 'Please log in to access this page.');
        }
        if ($user->role !== $role) {
            abort(403, 'Unauthorized action: Incorrect role.');
        }
        if ($user->status !== 'approved') {
            abort(403, 'Unauthorized action: Approval pending.');
        }

        return $next($request);
    }

}
