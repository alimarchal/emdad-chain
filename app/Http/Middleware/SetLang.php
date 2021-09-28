<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check())
        {
            if (auth()->user()->rtl == 1) {
                \App::setLocale('ar');
            }
            else { // This is optional as Laravel will automatically set the fallback language if there is none specified
                \App::setLocale(\Config::get('app.fallback_locale'));
            }
        }

        return $next($request);
    }
}
