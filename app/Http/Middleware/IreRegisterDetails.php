<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IreRegisterDetails
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
        if (Auth::guard('ire')->user()->nid_num == null || Auth::guard('ire')->user()->nid_image == null || Auth::guard('ire')->user()->bank == null) {
            return redirect()->route('ireRegisterDetails');
        }

        return $next($request);
    }
}
