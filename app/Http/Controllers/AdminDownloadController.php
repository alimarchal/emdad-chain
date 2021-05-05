<?php

namespace App\Http\Controllers;

use App\Models\DownloadableFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminDownloadController extends Controller
{
    public function index()
    {
        $downloads = DownloadableFile::all();

        return view('adminDownload.index', compact('downloads'));
    }

    public function create()
    {
        return view('adminDownload.create');
    }

    public function store(Request $request)
    {
//        Validator::make($request->all(), [
//            'name_en' => ['required'],
//            'name_ar' => ['required'],
//            'icon' => ['required', 'file'],
//            'file' => ['required', 'file','mimes:pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
//                        application/vnd.openxmlformats-officedocument.presentationml.presentation,
//                        application/pdf'],
//
//        ])->validate();

        $icon = $request->file('icon')->store('', 'public');
        $file = $request->file('file')->store('', 'public');

        DownloadableFile::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'icon' => $icon,
            'file' => $file
        ]);

        session()->flash('message', 'Added successfully');
        return redirect()->route('adminDownload');
    }

}
