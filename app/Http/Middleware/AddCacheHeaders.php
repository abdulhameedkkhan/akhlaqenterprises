<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddCacheHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // NEVER cache when user has selected a language - prevents wrong language showing
        if ($request->method() === 'GET' && session()->has('locale')) {
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', 'Mon, 01 Jan 1990 00:00:00 GMT');
            return $response;
        }

        // Only cache for guests with no language selection
        if ($request->method() === 'GET' && !$request->user() && !session()->has('locale')) {
            $response->header('Cache-Control', 'public, max-age=3600, must-revalidate');
            $response->header('Expires', gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
        }

        return $response;
    }
}
