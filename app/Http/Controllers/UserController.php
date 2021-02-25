<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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

            $users = User::where('id', '!=', Auth::user()->id)->paginate(50);
//            $users = User::with('roles')->get();
//            dd($users);
            $business = Business::all();
            return view('users.index', compact('users', 'business'));
        }
        elseif(auth()->user()->usertype == "CEO") {
            $users = User::where('business_id', auth()->user()->business_id)->where('id', '!=', Auth::user()->id)->paginate(50);
            return view('users.index', compact('users'));
        }
        else {
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
        if (auth()->user()->usertype == "superadmin") {

            $roles  = Role::all();
//            $permissions  = Permission::all();
            return view('users.create', compact('roles'));
        }
        elseif(auth()->user()->usertype == "CEO" && auth()->user()->registration_type == 'Buyer') {

            $roles  = Role::where('id' , '>', 10)->get();
            return view('users.create', compact('roles'));
        }
        elseif(auth()->user()->usertype == "CEO" && auth()->user()->registration_type == 'Supplier') {

            $roles  = Role::where('id' , '>=', 5)->where('id', '<=', 10 )->get();
            return view('users.create', compact('roles'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create user')) {
            return abort(401);
        }
//        $user = User::create($request->all());
//        $data = array();
        $roleName  = Role::where('id' , $request->input('role'))->first();

        if($request->role == 1)
        {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'business_id' => auth()->user()->business_id,
                'usertype' => $roleName->name,
                'status' => 3,
            ];
        }
        else{
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'business_id' => auth()->user()->business_id,
                'usertype' => $roleName->name,
                'status' => 1,
            ];
        }

        $user = User::create($data);
        $password = $request->password;
        $user->notify(new \App\Notifications\UserCreate($password));
        $role = $request->input('role') ? $request->input('role') : [];
        $user->assignRole($role);

        return redirect()->route('users.index');
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
    public function edit(User $user)
    {
        if (auth()->user()->usertype == "superadmin") {

            $roles  = Role::get()->pluck('name', 'name');
            $permissions = Permission::get()->pluck('name', 'name');
//            $permissions  = Permission::all();
            return view('users.edit', compact('user', 'roles','permissions'));
        }
        elseif(auth()->user()->usertype == "CEO" && auth()->user()->registration_type == 'Buyer') {
            $roles  = Role::where('id' , '>', 10)->get()->pluck('name', 'name');
            $permissions = Permission::where('id' , '>=', 41)->where('id' , '<=', 65)->get()->pluck('name', 'name');
            return view('users.edit', compact('user', 'roles','permissions'));
        }
        elseif(auth()->user()->usertype == "CEO" && auth()->user()->registration_type == 'Supplier') {
            $roles  = Role::where('id' , '>=', 5)->where('id', '<=', 10 )->get()->pluck('name', 'name');
            $permissions = Permission::where('id' , '>=', 8)->where('id' , '<=', 40)->get()->pluck('name', 'name');
            return view('users.edit', compact('user', 'roles','permissions'));
        }
//        $user = User::findOrFail($id);
//        $roles  = Role::all();
//        $permissions  = Permission::all();
//        $roles = Role::get()->pluck('name', 'name');
//        $permissions = Permission::get()->pluck('name', 'name');
//        $userRole =  $user->roles->pluck('id');
        return view('users.edit', compact('user', 'roles','permissions'));
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
        if (!Gate::allows('edit user')) {
            return abort(401);
        }
        $user->update($request->all());
        $roles = $request->input('role') ? $request->input('role') : [];
        $permissions = $request->input('permissions') ? $request->input('permissions') : [];
        $user->syncRoles($roles);
        $user->syncPermissions($permissions);

        session()->flash('message', 'User successfully updated.');
        return redirect()->route('users.index');
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
        $role = Role::all();
        $input = $request->all();

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

        $role = $role->where('id', $input['role'])->first();
        $user = User::create([
            'gender' => $input['gender'],
            'name' => $input['name'],
            'designation' => $input['designation'],
            'business_id' => $input['business_id'],
            'usertype' => $input['usertype'],
            'mobile' => $input['mobile'],
            'registration_type' => $business->business_type,
            'status' => 3,
            'is_active' => 1,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        $role = $role->find($input['role']);
        $user->assignRole($role);
        session()->flash('message', 'User has been successfully created.');
        //        if (isset($input['permission'])) {
        //            foreach ($input['permission'] as $permission) {
        //                $user->givePermissionTo($permission);
        //            }
        //        }
        return redirect()->route('users.create');
    }

    // public function roleGet()
    // {
    //     return view('users.role');
    // }

    // public function rolesPost(Request $request)
    // {
    //     $role = Role::findById($request->role);
    //     $permissions = $request->permission;
    //     $role->syncPermissions($permissions);
    //     return redirect()->back();
    // }
}
