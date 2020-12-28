<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $user = User::find(auth()->user()->id);
//        $user->assignRole('writer');
//        Role::create(['name' => 'super admin']);
//        Role::create(['name' => 'admin']);
//        Role::create(['name' => 'gm']);
//        Role::create(['name' => 'dh']);
//        Role::create(['name' => 'sh']);
//        Role::create(['name' => 'user']);
//        Permission::create(['name'=>'create user']);
//        Permission::create(['name'=>'edit user']);
//        Permission::create(['name'=>'delete user']);
//        Permission::create(['name'=>'po buyer']);
//        Permission::create(['name'=>'qo supplier']);

//        $permission = Permission::create(['name'=>'edit post']);
//        $role = Role::findById(1);
//        $permission = Permission::findById(3);
//        $role->givePermissionTo($permission);
//        $role->revokePermissionTo($permission);



        // testing end
        if (auth()->user()->usertype == "superadmin") {

            $users = User::paginate(50);
            $business = Business::all();
            return view('users.index', compact('users', 'business'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $business = Business::all();
        return view('users.show', compact('user', 'business'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $business = Business::all();
        return view('users.edit', compact('user', 'business'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->has('img')) {
            $path = $request->file('img')->store('', 'public');
            $request->merge(['profile_photo_path' => $path]);
        }
        $user->update($request->all());
        session()->flash('message', 'Profile successfully updated.');
        return redirect()->route('users.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('message', 'Profile successfully deleted.');
        return redirect()->route('users.index');
    }

    public function registrationType(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->update($request->all());
        return redirect()->route('business.create');
    }

    public function createUserForCompany(Request $request, Business $business)
    {
        dd($request->all());
    }
}
