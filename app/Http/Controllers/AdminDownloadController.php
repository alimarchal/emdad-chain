<?php

namespace App\Http\Controllers;

use App\Models\DownloadableFile;
use App\Models\IreCommission;
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
        Validator::make($request->all(), [
            'name_en' => ['required'],
            'name_ar' => ['required'],
            'icon' => ['required', 'file', 'mimes:jpeg,jpg,png'],
//            'file' => ['required', 'file' ,'mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
//                                            application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/pdf',],

        ])->validate();

        $icon = $request->file('icon')->store('', 'public');
        $file = $request->file('file')->store('', 'public');

        DownloadableFile::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'icon' => $icon,
            'file' => $file
        ]);

        session()->flash('message', __('portal.Added successfully!'));
        return redirect()->route('adminDownload');
    }

    public function edit(Request $request)
    {
        $download = DownloadableFile::where('id', decrypt($request->download_id))->first();

        return view('adminDownload.edit', compact('download'));
    }

    public function update(Request $request)
    {
        DownloadableFile::where('id', decrypt($request->id))->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
        ]);

        if ($request->hasFile('icon'))
        {
            $icon = $request->file('icon')->store('', 'public');
            DownloadableFile::where('id', decrypt($request->id))->update([
                'icon' => $icon,
            ]);
        }

        elseif ($request->hasFile('file')){
            $file = $request->file('file')->store('', 'public');
            DownloadableFile::where('id', decrypt($request->id))->update([
                'file' => $file,
            ]);
        }

        session()->flash('message', __('portal.Successfully Updated!'));
        return redirect()->route('adminDownload');
    }

    public function delete($id)
    {
        DownloadableFile::where('id', decrypt($id))->delete();

        session()->flash('message', __('portal.Successfully Delete.'));
        return redirect()->route('adminDownload');
    }

}
