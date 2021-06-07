<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageCheck
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
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('Sales Specialist')
            || Auth::user()->hasRole('Legal Approval Officer 1') || Auth::user()->hasRole('Finance Officer 1')
            || Auth::user()->hasRole('SC Supervisor') || Auth::user()->hasRole('IT Admin') )
        {
            return $next($request);
        }
        else if (is_null(Auth::user()->business_package))
        {
            return redirect()->route('packages.index');
        }

        return $next($request);
    }
}
