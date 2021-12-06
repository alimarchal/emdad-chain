<?php

namespace App\Http\Middleware;

use App\Models\PackageManualPayment;
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
            || Auth::user()->hasRole('SC Supervisor')|| Auth::user()->hasRole('SC Specialist') || Auth::user()->hasRole('IT Admin') )
        {
            return $next($request);
        }
        else if (is_null(Auth::user()->business_package))
        {

            if (Auth::user()->mobile_verify == 0)
            {
                session()->flash('error', __('portal.Please verify your mobile number inorder to proceed'));
                return redirect()->route('dashboard');
            }

            /* In case a user has paid through manual payment for buying package */
            $checkPackageManualPayment = PackageManualPayment::where(['user_id' => auth()->id(), 'upgrade' => 0])->where('status', '!=', 1)->first();
            if (isset($checkPackageManualPayment))
            {
                return redirect()->route('paymentResponseView', encrypt($checkPackageManualPayment->id));
            }

            session()->flash('error', __('portal.You do not have any package selected yet, please select a package to proceed to the registration.'));
            return redirect()->route('packages.index');
        }

        return $next($request);
    }
}
