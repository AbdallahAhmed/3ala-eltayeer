<?php

namespace App\Http\Middleware;

use Closure;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $lang = $request->route()->parameter('lang');

        app()->setLocale('ar');

        $request->route()->forgetParameter('lang');
        app('url')->defaults(['lang' => $lang]);


        return $next($request);
    }
}