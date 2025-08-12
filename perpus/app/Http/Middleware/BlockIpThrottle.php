<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class BlockIpThrottle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected $maxAttempts = 5;      // max request
    protected $decaySeconds = 60;     // dalam 60 detik

    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $key = 'blockip:' . $ip;

        $attempts = Cache::get($key, 0);

        if ($attempts >= $this->maxAttempts) {
            return response('Terlalu banyak permintaan, coba lagi nanti.', Response::HTTP_TOO_MANY_REQUESTS);
        }

        Cache::put($key, $attempts + 1, $this->decaySeconds);
        
        return $next($request);
    }
}
