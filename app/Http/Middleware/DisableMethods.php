<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisableMethods
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$methods)
    {
        // Get the current route
        $route = $request->route();

        // Check if route is not null and get the action method
        if ($route && in_array($route->getActionMethod(), $methods)) {
            abort(404, 'Not Found');
        }

        return $next($request);
    }
}
