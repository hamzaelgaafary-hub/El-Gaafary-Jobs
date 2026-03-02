<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use MessageFormatter;
use Symfony\Component\HttpFoundation\Response;

class Checkrole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (Auth::check() && Auth::user()->type === $role) {
            //return MessageFormatter::formatMessage(locale: 'en', pattern: 'Unauthorized Access to This Page.', args: []) ?? abort(403, 'Unauthorized Access to This Page.');
        
            return $next($request);
        }
        abort(403, 'Unauthorized Access to This Page.');
    }
}
