<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->query('locale', config('app.locale'));
        
        if (in_array($locale, ['en', 'ar'])) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
