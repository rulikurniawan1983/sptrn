<?php
namespace App\Http\Middleware;

use Closure;

class SanitizeInput
{
    public function handle($request, Closure $next)
    {
        $input = $request->all();

        // Hapus karakter berbahaya
        array_walk_recursive($input, function (&$value) {
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        });

        $request->merge($input);

        return $next($request);
    }
}
