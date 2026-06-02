<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventBrowserCache
{
    /**
     * Prevent browsers from caching pages (stops back-button access after logout).
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        return $response->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate, max-age=0, post-check=0, pre-check=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
        ]);
    }
}
