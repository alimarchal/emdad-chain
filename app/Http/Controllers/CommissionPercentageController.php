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
//        if ($request->commission_type == 1 && $request->amount_type == 0 && $request->has('amount') )
//        {
//            Validator::make($request->all(), [
//                'commission_type' => ['required'],
//                'package_type' => ['required'],
//                'ire_type' => ['required'],
//                'amount_type' => ['required'],
//                'amount' => ['required'],
//
//            ])->validate();
//
//            CommissionPercentage::create([
//                'commission_type' => $request->commission_type,
//                'package_type' => $request->package_type,
//                'ire_type' => $request->ire_type,
//                'amount_type' => $request->amount_type,
//                'amount' => $request->amount,
//            ]);
//
//            session()->flash('message', 'Added successfully');
//            return redirect()->route('adminPercentage');
//        }
//        elseif ($request->commission_type == 2 && $request->amount_type == 0 && $request->has('amount') )
//        {
//            Validator::make($request->all(), [
//                'commission_type' => ['required'],
//                'package_type' => ['required'],
//                'ire_type' => ['required'],
//                'amount_type' => ['required'],
//                'amount' => ['required'],
//
//            ])->validate();
//
//            CommissionPercentage::create([
//                'commission_type' => $request->commission_type,
//                'package_type' => $request->package_type,
//                'ire_type' => $request->ire_type,
//                'amount_type' => $request->amount_type,
//                'amount' => $request->amount,
//            ]);
//
//            session()->flash('message', 'Added successfully');
//            return redirect()->route('adminPercentage');
//        }
//        elseif ($request->commission_type == 0 && $request->has('amount'))
//        {
//            Validator::make($request->all(), [
//                'commission_type' => ['required'],
//                'ire_type' => ['required'],
//                'amount_type' => ['required'],
//                'amount' => ['required'],
//
//            ])->validate();
//
//            CommissionPercentage::create([
//                'commission_type' => $request->commission_type,
//                'ire_type' => $request->ire_type,
//                'amount_type' => $request->amount_type,
//                'amount' => $request->amount,
//            ]);
//
//            session()->flash('message', 'Added successfully');
//            return redirect()->route('adminPercentage');
//        }
//        elseif ($request->commission_type == 1 && $request->amount_type == 1 && $request->has('percentage_amount'))
//        {
//            Validator::make($request->all(), [
//                'commission_type' => ['required'],
//                'package_type' => ['required'],
//                'ire_type' => ['required'],
//                'amount_type' => ['required'],
//                'percentage_amount' => ['required'],
//
//            ])->validate();
//
//            if ($request->commission_type != 0)
//            {
//                $percentage_amount =  round($request->percentage_amount / 100, 2);
//            }
//
//            CommissionPercentage::create([
//                'commission_type' => $request->commission_type,
//                'package_type' => $request->package_type,
//                'ire_type' => $request->ire_type,
//                'amount_type' => $request->amount_type,
//                'amount' => $percentage_amount,
//            ]);
//
//            session()->flash('message', 'Added successfully');
//            return redirect()->route('adminPercentage');
//
//        }
//        elseif ($request->commission_type == 2 && $request->amount_type == 1 && $request->has('percentage_amount'))
//        {
//            Validator::make($request->all(), [
//                'commission_type' => ['required'],
//                'package_type' => ['required'],
//                'ire_type' => ['required'],
//                'amount_type' => ['required'],
//                'percentage_amount' => ['required'],
//
//            ])->validate();
//
//            if ($request->commission_type != 0)
//            {
//                $percentage_amount =  round($request->percentage_amount / 100, 2);
//            }
//
//            CommissionPercentage::create([
//                'commission_type' => $request->commission_type,
//                'package_type' => $request->package_type,
//                'ire_type' => $request->ire_type,
//                'amount_type' => $request->amount_type,
//                'amount' => $percentage_amount,
//            ]);
//
//            session()->flash('message', 'Added successfully');
//            return redirect()->route('adminPercentage');
//
//        }
//        elseif ($request->commission_type == 0 && $request->has('percentage_amount'))
//        {
//            Validator::make($request->all(), [
//                'commission_type' => ['required'],
//                'ire_type' => ['required'],
//                'amount_type' => ['required'],
//                'percentage_amount' => ['required'],
//
//            ])->validate();
//
//            $percentage_amount =  round($request->percentage_amount / 100, 2);
//
//            CommissionPercentage::create([
//                'commission_type' => $request->commission_type,
//                'ire_type' => $request->ire_type,
//                'amount_type' => $request->amount_type,
//                'amount' => $percentage_amount,
//            ]);
//
//            session()->flash('message', 'Added successfully');
//            return redirect()->route('adminPercentage');
//        }

        if ($request->commission_type == 1 && $request->amount_type == 0 && $request->has('amount') )
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'package_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'amount' => ['required'],

            ])->validate();

            CommissionPercentage::updateOrCreate(
                ['commission_type' => $request->commission_type, 'package_type' => $request->package_type, 'ire_type' => $request->ire_type, ],
                ['amount_type' => $request->amount_type, 'amount' => $request->amount,]
            );

            session()->flash('message', 'Added successfully');
            return redirect()->route('adminPercentage');
        }
        elseif ($request->commission_type == 2 && $request->amount_type == 0 && $request->has('amount') )
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'package_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'amount' => ['required'],

            ])->validate();

            CommissionPercentage::updateOrCreate(
                ['commission_type' => $request->commission_type, 'package_type' => $request->package_type, 'ire_type' => $request->ire_type, ],
                ['amount_type' => $request->amount_type, 'amount' => $request->amount,]
            );

            session()->flash('message', 'Added successfully');
            return redirect()->route('adminPercentage');
        }
        elseif ($request->commission_type == 0 && $request->has('amount'))
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'amount' => ['required'],

            ])->validate();

            CommissionPercentage::updateOrCreate(
                ['commission_type' => $request->commission_type, 'ire_type' => $request->ire_type, ],
                ['amount_type' => $request->amount_type, 'amount' => $request->amount,]
            );

            session()->flash('message', 'Added successfully');
            return redirect()->route('adminPercentage');
        }
        elseif ($request->commission_type == 1 && $request->amount_type == 1 && $request->has('percentage_amount'))
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'package_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'percentage_amount' => ['required'],

            ])->validate();

            if ($request->commission_type != 0)
            {
                $percentage_amount =  round($request->percentage_amount / 100, 2);
            }

            CommissionPercentage::updateOrCreate(
                ['commission_type' => $request->commission_type, 'package_type' => $request->package_type, 'ire_type' => $request->ire_type, ],
                ['amount_type' => $request->amount_type, 'amount' => $percentage_amount,]
            );

            session()->flash('message', 'Added successfully');
            return redirect()->route('adminPercentage');

        }
        elseif ($request->commission_type == 2 && $request->amount_type == 1 && $request->has('percentage_amount'))
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'package_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'percentage_amount' => ['required'],

            ])->validate();

            if ($request->commission_type != 0)
            {
                $percentage_amount =  round($request->percentage_amount / 100, 2);
            }

            CommissionPercentage::updateOrCreate(
                ['commission_type' => $request->commission_type, 'package_type' => $request->package_type, 'ire_type' => $request->ire_type, ],
                ['amount_type' => $request->amount_type, 'amount' => $percentage_amount,]
            );

            session()->flash('message', 'Added successfully');
            return redirect()->route('adminPercentage');

        }
        elseif ($request->commission_type == 0 && $request->has('percentage_amount'))
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'percentage_amount' => ['required'],

            ])->validate();

            $percentage_amount =  round($request->percentage_amount / 100, 2);

            CommissionPercentage::updateOrCreate(
                ['commission_type' => $request->commission_type, 'ire_type' => $request->ire_type, ],
                ['amount_type' => $request->amount_type, 'amount' => $percentage_amount,]
            );

            session()->flash('message', 'Added successfully');
            return redirect()->route('adminPercentage');
        }
    }

    public function edit(Request $request)
    {
        $commissionPercentage = CommissionPercentage::where('id', decrypt($request->commissionPercentage))->first();

        return view('commissionPercentage.edit', compact('commissionPercentage'));
    }

    public function update(Request $request)
    {
        if ($request->commission_type == 1 && $request->amount_type == 0 && $request->has('amount') )
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'package_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'amount' => ['required'],

            ])->validate();

            CommissionPercentage::where('id', decrypt($request->commissionPercentage))->update([
                'commission_type' => $request->commission_type,
                'package_type' => $request->package_type,
                'ire_type' => $request->ire_type,
                'amount_type' => $request->amount_type,
                'amount' => $request->amount,
            ]);

            session()->flash('message', 'Updated successfully');
            return redirect()->route('adminPercentage');
        }
        elseif ($request->commission_type == 2 && $request->amount_type == 0 && $request->has('amount') )
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'package_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'amount' => ['required'],

            ])->validate();

            CommissionPercentage::where('id', decrypt($request->commissionPercentage))->update([
                'commission_type' => $request->commission_type,
                'package_type' => $request->package_type,
                'ire_type' => $request->ire_type,
                'amount_type' => $request->amount_type,
                'amount' => $request->amount,
            ]);

            session()->flash('message', 'Updated successfully');
            return redirect()->route('adminPercentage');
        }
        elseif ($request->amount_type == 0 && $request->has('amount'))
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'amount' => ['required'],

            ])->validate();

            CommissionPercentage::where('id', decrypt($request->commissionPercentage))->update([
                'commission_type' => $request->commission_type,
                'ire_type' => $request->ire_type,
                'amount_type' => $request->amount_type,
                'amount' => $request->amount,
            ]);

            session()->flash('message', 'Updated successfully');
            return redirect()->route('adminPercentage');
        }
        elseif ($request->commission_type == 1 && $request->amount_type == 1 && $request->has('percentage_amount'))
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'package_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'percentage_amount' => ['required'],

            ])->validate();

            if ($request->commission_type != 0)
            {
                $percentage_amount =  round($request->percentage_amount / 100, 2);
            }

            CommissionPercentage::where('id', decrypt($request->commissionPercentage))->update([
                'commission_type' => $request->commission_type,
                'package_type' => $request->package_type,
                'ire_type' => $request->ire_type,
                'amount_type' => $request->amount_type,
                'amount' => $percentage_amount,
            ]);

            session()->flash('message', 'Updated successfully');
            return redirect()->route('adminPercentage');

        }
        elseif ($request->commission_type == 2 && $request->amount_type == 1 && $request->has('percentage_amount'))
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'package_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'percentage_amount' => ['required'],

            ])->validate();

            if ($request->commission_type != 0)
            {
                $percentage_amount =  round($request->percentage_amount / 100, 2);
            }

            CommissionPercentage::where('id', decrypt($request->commissionPercentage))->update([
                'commission_type' => $request->commission_type,
                'package_type' => $request->package_type,
                'ire_type' => $request->ire_type,
                'amount_type' => $request->amount_type,
                'amount' => $percentage_amount,
            ]);

            session()->flash('message', 'Updated successfully');
            return redirect()->route('adminPercentage');

        }
        elseif ($request->amount_type == 1 && $request->has('percentage_amount'))
        {
            Validator::make($request->all(), [
                'commission_type' => ['required'],
                'ire_type' => ['required'],
                'amount_type' => ['required'],
                'percentage_amount' => ['required'],

            ])->validate();

            if ($request->commission_type == 0)
            {
                $percentage_amount =  round($request->percentage_amount / 100, 2);
            }

            CommissionPercentage::where('id', decrypt($request->commissionPercentage))->update([
                'commission_type' => $request->commission_type,
                'ire_type' => $request->ire_type,
                'amount_type' => $request->amount_type,
                'amount' => $percentage_amount,
            ]);

            session()->flash('message', 'Updated successfully');
            return redirect()->route('adminPercentage');
        }
    }

    public function delete($id)
    {
        CommissionPercentage::where('id', decrypt($id))->delete();

        session()->flash('message', 'Deleted Successfully');
        return redirect()->route('adminPercentage');
    }
}
