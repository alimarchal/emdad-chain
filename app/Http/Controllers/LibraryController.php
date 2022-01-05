<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        $lib = Library::all();
        return view('libr.index', compact('lib'));
    }

    public function create()
    {
        return view('libr.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required',
            'language' => 'required',
            'user_type' => 'required',
            'order' => 'required',
        ]);


        if ($request->has('attachment_url_1')) {
            $path = $request->file('attachment_url_1')->store('', 'public');
            $request->merge(['attachment_url' => $path]);
        }
        $library = Library::create($request->all());
        session()->flash('message', "Library created successfully");
        return redirect()->route('library.index');
    }

    public function edit(Library $library)
    {
        return view('libr.edit', compact('library'));
    }

    public function update(Request $request, Library $library)
    {
        $request->validate([
            'url' => 'required',
            'title' => 'required',
            'language' => 'required',
            'user_type' => 'required',
            'order' => 'required',
        ]);


        if ($request->has('attachment_url_1')) {
            $path = $request->file('attachment_url_1')->store('', 'public');
            $request->merge(['attachment_url' => $path]);
        }
        $library = $library->update($request->all());
        session()->flash('message', "Library updated successfully");
        return redirect()->route('library.index');
    }

    public function showLibrary(Request $request)
    {

        if (auth()->user()->usertype == 'SuperAdmin') {
            $library = Library::all();
            return view('libr.showLibrary', compact('library'));
        } elseif (auth()->user()->registration_type == 'Buyer' || auth()->user()->registration_type == NULL) {
            $library = Library::where('user_type', 'Buyer')->where('language', '=', (auth()->user()->rtl == 0 ? 'English' : 'Arabic'))->get();
            return view('libr.showLibrary', compact('library'));
        } else {
            $library = Library::where('user_type', 'Supplier')->where('language', '=', (auth()->user()->rtl == 0 ? 'English' : 'Arabic'))->get();
            return view('libr.showLibrary', compact('library'));
        }

    }

    public function markRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
