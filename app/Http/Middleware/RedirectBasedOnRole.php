<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        
        if ($user && $user->hasRole('user')) {
            // Define the specific routes that the user can access
            $allowedRoutes = ['store', 'show','update','edit','destroy','index']; // Add more routes as needed
            // dd($user->role, $request->route()->getName(), $allowedRoutes);
            $route = $request->route()->getName();
            $segments = explode('.', $route);
            $firstSegment = $segments[0];
            if($firstSegment == "shift"){
                array_pop($allowedRoutes);
            }
            // dd($allowedRoutes);
            $secondSeg = $segments[1];

            if (in_array($secondSeg, $allowedRoutes)) {
                // dd($user->role);
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}
