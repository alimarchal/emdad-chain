<?php

namespace App\Http\Controllers;

use App\Models\Ire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminIreController extends Controller
{
    public function index()
    {
        $ires = Ire::all();

        return view('adminIres.index', compact('ires'));
    }

    public function edit(Request $request)
    {
        $id = decrypt($request->ire_id);
        $ire = Ire::where('id', $id)->first();

        return view('adminIres.edit', compact('ire'));
    }

    public function update(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => ['required'],
//            'email' => ['required', 'email', 'unique:ires'],
//            'password' => ['required', 'confirmed'],
//            'bank' => ['required'],
//            'iban' => ['required','max:24'],
//            'nid_num' => ['required', 'string', 'max:10'],
//            'type' => ['required'],
//            'gender' => ['required'],
//            'mobile_number' => ['required', 'string', 'max:20'],
//            'nid_image' => ['required', 'file','mimes:jpeg,jpg,png', 'max:5120'],
//
//        ]);
//
//        if ($validator->fails())
//        {
//            return redirect()->back()->withErrors($validator);
//        }

        $id = decrypt($request->ire_id);

        Ire::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bank' => $request->bank,
            'iban' => $request->iban,
            'nid_num' => $request->nid_num,
            'type' => $request->type,
            'gender' => $request->gender,
            'mobile_number' => $request->mobile_number,
        ]);

        if ($request->hasFile('nid_image'))
        {
            $path = $request->file('nid_image')->store('', 'public');
            $request->merge(['nid_image' => $path]);

            Ire::where('id', $id)->update([
                'nid_image' => $request['nid_image'],
            ]);
        }

        session()->flash('message', 'Edited successfully');
        return redirect()->route('adminIres');
    }
}
