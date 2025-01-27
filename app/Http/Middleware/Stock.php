<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Stock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in and has the role 'ref'
        if (auth()->check() && auth()->user()->role === 'stock') {
            // Allow the request to continue if the user is a ref
            return $next($request);
        }

        // Redirect to login or show an error if the user is not a ref
        return redirect()->route('login')->with('error', 'Access denied: Ref only.');
    }
}
