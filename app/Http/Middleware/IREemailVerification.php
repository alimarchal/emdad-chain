<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IREemailVerification
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
        if (Auth::guard('ire')->user()->email_verified_at == null) {
            session()->flash('status', 'Verify your email to continue.');
            Auth::guard('ire')->logout();
            return redirect()->back();
        }

        return $next($request);
    }
}
