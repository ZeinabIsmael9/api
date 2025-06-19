<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ThrottleRequests
{
    public function handle(Request $request, Closure $next)
    {

        $identifier = $request->bearerToken() ?? $request->ip();
        $key = 'rate_limit:' . $identifier;
        $requests = Cache::get($key, 0);

        if ($requests >= 10) {
            return response()->json([
                'message' => 'Too Many Requests'
            ], 429);
        }

        Cache::put($key, $requests + 1, now()->addMinutes(1));
        return $next($request);
    }
}
