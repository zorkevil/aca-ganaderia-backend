<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si no está logueado (por las dudas)
        if (!$request->user()) {
            abort(401);
        }

        // Si no es admin
        if (!$request->user()->is_admin) {
            abort(403);
        }

        return $next($request);
    }
}
