<?php

namespace App\Http\Controllers;

use App\Models\SmsMessages;
use Illuminate\Http\Request;

class SmsMessagesController extends Controller
{
    public function index()
    {
        $sms = SmsMessages::all();
        return view('sms.index', compact('sms'));
    }

    public function create()
    {
        return view('sms.create');
    }

    public function store(Request $request)
    {
        SmsMessages::create($request->all());
        session()->flash('message', 'SMS created successfully.');
        return redirect()->route('smsMessages.index');
    }

    public function edit($id)
    {
        $smsMessages = SmsMessages::findOrFail($id);
        return view('sms.edit', compact('smsMessages'));
    }

    public function update(Request $request,  $id)
    {
        $smsMessages = SmsMessages::findOrFail($id);
        $smsMessages->update($request->all());
        session()->flash('message', 'SMS updated successfully.');
        return redirect()->route('smsMessages.index');
    }

}
