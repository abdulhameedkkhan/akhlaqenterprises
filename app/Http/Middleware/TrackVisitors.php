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
            $visitor = Visitor::firstOrCreate([
                'ip_address' => $request->ip(),
                'visit_date' => now()->toDateString(),
            ], [
                'user_agent' => substr($request->userAgent(), 0, 500),
            ]);

            if ($visitor->wasRecentlyCreated && $visitor->country === null) {
                $country = $this->getCountryFromIp($request->ip());
                if ($country !== null) {
                    $visitor->update(['country' => $country]);
                }
            }
        }

        return $next($request);
    }

    private function getCountryFromIp(string $ip): ?string
    {
        if (in_array($ip, ['127.0.0.1', '::1'], true)) {
            return 'Local';
        }
        try {
            $url = 'http://ip-api.com/json/' . urlencode($ip) . '?fields=country';
            $ctx = stream_context_create(['http' => ['timeout' => 1.5]]);
            $raw = @file_get_contents($url, false, $ctx);
            if ($raw !== false) {
                $data = json_decode($raw, true);
                return isset($data['country']) ? (string) $data['country'] : null;
            }
        } catch (\Throwable $e) {
            // ignore
        }
        return null;
    }
}
