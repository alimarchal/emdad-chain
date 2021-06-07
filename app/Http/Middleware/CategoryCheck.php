<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryCheck
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
            || Auth::user()->hasRole('SC Supervisor') || Auth::user()->hasRole('IT Admin'))
        {
            return $next($request);
        }
        else if (isset(Auth::user()->business_package) && is_null(Auth::user()->business_package->categories))
        {
            return redirect()->route('parentCategories');
        }

        return $next($request);
    }
}
