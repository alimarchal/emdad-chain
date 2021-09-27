<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lib = Library::all();
        return view('libr.index', compact('lib'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libr.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function show(Library $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function edit(Library $library)
    {
        return view('libr.edit', compact('library'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Library $library)
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
        $library = $library->update($request->all());
        session()->flash('message', "Library updated successfully");
        return redirect()->route('library.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        //
    }

    public function showLibrary(Request $request)
    {
        $library = null;
        if (auth()->user()->usertype == 'SuperAdmin') {
            $library = Library::all();
        } elseif (auth()->user()->registration_type == 'Buyer' || auth()->user()->registration_type == NULL) {
            $library = Library::where('user_type', 'Buyer')->get();
        } else {
            $library = Library::where('user_type', 'Supplier')->get();
        }
        return view('libr.showLibrary', compact('library'));
    }
}
