<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmailTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('*email*') || $request->is('*daftar*') || $request->is('*contact*')) {
            ini_set('max_execution_time', 120);
            set_time_limit(120);
        }

        return $next($request);
    }
}