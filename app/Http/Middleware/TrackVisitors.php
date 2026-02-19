<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Visitor;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Don't track admin panel or AJAX requests
        if (!$request->is('admin*') && !$request->ajax()) {
            Visitor::firstOrCreate([
                'ip_address' => $request->ip(),
                'visit_date' => now()->toDateString(),
            ], [
                'user_agent' => substr($request->userAgent(), 0, 500),
            ]);
        }

        return $next($request);
    }
}
