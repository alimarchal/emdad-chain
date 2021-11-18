<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('role.createrole', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);


        $role = Role::create(['name' => $request->name]);
        $permissions = $request->input('permissions') ? $request->input('permissions') : [];
        $role->givePermissionTo($permissions);

        return redirect('/role')->with('success', __('portal.Role created successfully!'));
    }

    public function show($id)
    {
        //        $roles = Role::all();
        //        return view('role.show', compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get()->pluck('name', 'name');

        return view('role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name =  $request->get('name');

        $role->update($request->except('permissions'));
        $permissions = $request->input('permissions') ? $request->input('permissions') : [];
        $role->syncPermissions($permissions);

        return redirect('/role')->with('success', __('portal.Role Updated successfully!'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success', __('portal.Role deleted successfully.'));
    }
}
