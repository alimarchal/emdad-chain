<?php

namespace App\Http\Controllers;

use App\Models\SmsMessages;
use Illuminate\Http\Request;

class SmsMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sms = SmsMessages::all();
        return view('sms.index', compact('sms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SmsMessages::create($request->all());
        session()->flash('message', 'SMS created successfully.');
        return redirect()->route('smsMessages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SmsMessages $smsMessages
     * @return \Illuminate\Http\Response
     */
    public function show(SmsMessages $smsMessages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SmsMessages $smsMessages
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $smsMessages = SmsMessages::findOrFail($id);
        return view('sms.edit', compact('smsMessages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SmsMessages $smsMessages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $smsMessages = SmsMessages::findOrFail($id);
        $smsMessages->update($request->all());
        session()->flash('message', 'SMS updated successfully.');
        return redirect()->route('smsMessages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SmsMessages $smsMessages
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsMessages $smsMessages)
    {
        //
    }
}
