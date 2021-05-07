<?php

namespace App\Http\Controllers;

use App\Models\CommissionPercentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommissionPercentageController extends Controller
{
    public function index()
    {
        $commissionPercentages = CommissionPercentage::all();

        return view('commissionPercentage.index', compact('commissionPercentages'));
    }

    public function create()
    {
        return view('commissionPercentage.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'commission_type' => ['required'],
            'package_type' => ['required'],
            'ire_type' => ['required'],
            'amount_type' => ['required'],
            'amount' => ['required'],

        ])->validate();

dd('stop');
    }
}
