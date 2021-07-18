<?php

namespace App\Http\Controllers;

use App\Models\BusinessPackage;
use App\Models\Package;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        if (auth()->user()->registration_type == 'Buyer' )
        {
            $packages = Package::where('user_type', 1)->get();
            return view('packageBuyer.index', compact('packages'));
        }
        elseif(auth()->user()->registration_type == 'Supplier')
        {
            $packages = Package::where('user_type', 2)->get();
            return view('packageSupplier.index', compact('packages'));
        }
        else
        {
            return redirect()->back();
        }

    }

    public function pdf()
    {
        $businessPackage = BusinessPackage::with('package')->where('business_id', auth()->user()->business_id)->first();

        $pdf = PDF::loadView('package.PDF', compact('businessPackage'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('SubscriptionInvoice.pdf');
    }

}
