<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $input = $request->all();

//        dd($input);
        Validator::make($input, [
            'gender' => ['required', 'string', 'max:191'],
            'name' => ['required', 'string', 'max:191'],
            'designation' => ['required'],
            'business_id' => ['required'],
            'usertype' => ['required'],
            'role' => ['required'],
            'mobile' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'max:191'],
        ])->validate();

        $user = User::create([
            'gender' => $input['gender'],
            'name' => $input['name'],
            'designation' => $input['designation'],
            'business_id' => $input['business_id'],
            'usertype' => $input['usertype'],
            'mobile' => $input['mobile'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        $role = Role::findById($input['role']);
        $user->assignRole($role);
        session()->flash('message', 'User has been successfully created.');
        if (isset($input['permission'])) {
            foreach ($input['permission'] as $permission) {
                $user->givePermissionTo($permission);
            }
        }
        return redirect()->route('users.create');
    }
}
