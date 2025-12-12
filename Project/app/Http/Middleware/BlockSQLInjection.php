<?php

namespace App\Http\Middleware;

use Closure;

class BlockSQLInjection
{
    public function handle($request, Closure $next)
    {
        // Ambil semua input request
        $inputs = $request->all();

        // Pola serangan SQL Injection
        $patterns = [
            '/(\bor\b|\band\b)\s+1=1/i',
            '/union\s+select/i',
            '/--/i',
            '/#/i',
            '/sleep\(/i',
            "/'/i",
        ];

        foreach ($inputs as $key => $value) {
            foreach ($patterns as $pattern) {
                if (is_string($value) && preg_match($pattern, $value)) {
                    // Serangan terdeteksi
                    return abort(403, "Serangan SQL Injection terdeteksi pada input: $key");
                }
            }
        }

        return $next($request);
    }
}
