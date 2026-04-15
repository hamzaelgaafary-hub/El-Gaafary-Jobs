<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Checkrole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();

        // If user is not authenticated, let auth middleware handle it
        if (! $user) {
            return $next($request);
        }

        // Check if user can access this panel based on their type
        if ($user->type === $role) {
            return $next($request);
        }

        abort(403, 'Unauthorized Access to This site.');
    }
}
