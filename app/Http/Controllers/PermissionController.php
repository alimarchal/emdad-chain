<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('permission.createpermission');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'guard_name' => 'required',

        ]);

        $role = Permission::create(['name' => $request->name]);
        return redirect()->route('permission.index')->with('success', __('portal.Permission created successfully!'));
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permission.editpermission', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->name =  $request->get('name');

        $permission->guard_name = $request->get('guard_name');
        $permission->save();

        return redirect()->route('permission.index')->with('success', __('portal.Permission Updated successfully!'));
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back()->with('success', __('portal.Permission deleted successfully.'));
    }
}
