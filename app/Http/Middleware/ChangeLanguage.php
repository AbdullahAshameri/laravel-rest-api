<?php

namespace App\Http\Middleware;

use Closure;

class ChangeLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Default = ar
        $locale = 'ar';

        // إذا أرسلت lang parameter
        if (isset($request->lang) && in_array($request->lang, ['en', 'ar']))
            $locale = $request->lang;

        app()->setLocale($locale);

        return $next($request);
    }
}
