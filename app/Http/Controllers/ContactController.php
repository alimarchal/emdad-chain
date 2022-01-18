<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        if (auth()->check() && (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('IT Admin')))
        {
            $requests = Contact::orderBy('status', 'DESC')->paginate(10);
            return view('contact.index',compact('requests'));
        }
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'phone' => 'required|max:20',
            'subject' => 'required|max:60',
            'message' => 'required',
        ]);

        $request->merge(['status'=> 'pending']);
        Contact::create($request->all());
        session()->flash('message', 'Your message successfully received. We will let you know.');
        return redirect()->back();
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->all());
        session()->flash('message', 'Status updated....');
        return redirect()->back();
    }

}
