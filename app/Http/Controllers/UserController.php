<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Carbon\Carbon;
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
        if (auth()->user()->hasRole('SuperAdmin')) {
            $users = User::where('id', '!=', Auth::user()->id)->paginate(50);
            $business = Business::all();
            return view('users.index', compact('users', 'business'));
        }
        elseif(auth()->user()->usertype == "CEO") {
            //Checking users & driver count for related packages
            $userCount = User::where([['business_id', \auth()->user()->business_id], ['usertype', '!=','Supplier Driver'], ['id', '!=', \auth()->id()]])->count();
            $driverCount = User::where([['business_id', \auth()->user()->business_id], ['usertype', 'Supplier Driver'],['id', '!=', \auth()->id()]])->count();
            $users = User::where('business_id', auth()->user()->business_id)->where('id', '!=', Auth::user()->id)->paginate(50);
            return view('users.index', compact('users', 'userCount', 'driverCount'));
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
        if (auth()->user()->hasRole('SuperAdmin')) {

            $roles  = Role::all();
//            $permissions  = Permission::all();
            return view('users.create', compact('roles'));
        }
        elseif(auth()->user()->usertype == "CEO" && auth()->user()->registration_type == 'Buyer')
        {
            //Checking users count for related packages
            $userCount = User::where([['business_id', \auth()->user()->business_id], ['id', '!=', \auth()->id()]])->count();
            if (\auth()->user()->business_package->package_id == 1 && $userCount == 2 )
            {
                session()->flash('message', 'Add Users limit reached');
                return redirect()->back();
            }
            elseif (\auth()->user()->business_package->package_id == 2 && $userCount == 5 )
            {
                session()->flash('message', 'Add Users limit reached');
                return redirect()->back();
            }
            elseif (\auth()->user()->business_package->package_id == 3 || \auth()->user()->business_package->package_id == 4 && $userCount == 100 )
            {
                session()->flash('message', 'Add Users limit reached');
                return redirect()->back();
            }

            $roles  = Role::where('id' , '>', 10)->where('id', '<', 18)->get();
            return view('users.create', compact('roles', 'userCount'));
        }
        elseif(auth()->user()->usertype == "CEO" && auth()->user()->registration_type == 'Supplier')
        {
            //Checking users & driver count for related packages
            $userCount = User::where([['business_id', \auth()->user()->business_id], ['usertype', '!=','Supplier Driver'], ['id', '!=', \auth()->id()]])->count();
            $driverCount = User::where([['business_id', \auth()->user()->business_id], ['usertype', 'Supplier Driver'],['id', '!=', \auth()->id()]])->count();
//            dd($driverCount);
            if (\auth()->user()->business_package->package_id == 5 && $userCount == 2 && $driverCount == 2 )
            {
                session()->flash('message', 'Add Users and Driver limit reached');
                return redirect()->back();
            }
            elseif (\auth()->user()->business_package->package_id == 6 && $userCount == 10 && $driverCount == 20 )
            {
                session()->flash('message', 'Add Users and Driver limit reached');
                return redirect()->back();
            }
//            elseif (\auth()->user()->business_package->package_id == 7  && $userCount == 100 )
//            {
//                session()->flash('message', 'Add Users limit reached');
//                return redirect()->back();
//            }
            //Checking users count for free package
            elseif (\auth()->user()->business_package->package_id == 5 && $userCount != 2 && $driverCount == 2 )
            {
                $roles  = Role::where('id' , '>=', 5)->where('id', '<', 10 )->get();
                return view('users.create', compact('roles','userCount','driverCount'));
            }
            //Checking drivers count for free package
            elseif (\auth()->user()->business_package->package_id == 5 && $userCount == 2 && $driverCount != 2 )
            {
                $roles  = Role::where('id', '=', 10 )->get();
                return view('users.create', compact('roles','userCount','driverCount'));
            }

            //Checking users count for gold package
            elseif (\auth()->user()->business_package->package_id == 6 && $userCount != 10 && $driverCount == 20 )
            {
                $roles  = Role::where('id' , '>=', 5)->where('id', '<', 10 )->get();
                return view('users.create', compact('roles','userCount','driverCount'));
            }
            //Checking drivers count for gold package
            elseif (\auth()->user()->business_package->package_id == 6 && $userCount == 10 && $driverCount != 20 )
            {
                $roles  = Role::where('id', '=', 10 )->get();
                return view('users.create', compact('roles','userCount','driverCount'));
            }
            //Checking users count for platinum package
            elseif (\auth()->user()->business_package->package_id == 7 && $userCount != 100)
            {
                $roles  = Role::where('id' , '>=', 5)->where('id', '<=', 10 )->get();
                return view('users.create', compact('roles','userCount','driverCount'));
            }
            //Checking users count for platinum package
            elseif (\auth()->user()->business_package->package_id == 7 && $userCount == 100)
            {
                $roles  = Role::where('id', '=', 10 )->get();
                return view('users.create', compact('roles','userCount','driverCount'));
            }

            $roles  = Role::where('id' , '>=', 5)->where('id', '<=', 10 )->get();
            return view('users.create', compact('roles','userCount','driverCount'));
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

//        dd($request->all());
        if (!Gate::allows('create user')) {
            return abort(401);
        }
//        $user = User::create($request->all());
//        $data = array();
        $roleName  = Role::where('id' , $request->input('role'))->first();

        if($request->role == 1 || auth()->user()->hasRole('SuperAdmin'))
        {
            if ($roleName->name == 'MarketingManager' && $roleName->id == 19)
            {
                $validated = validator::make($request->all(),[
                    'email' => 'required|email|unique:users',
                ]);

                if ($validated->fails()) {
                    session()->flash('message', 'Email already exits');
                    return redirect()->back()->withInput();
                }

                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'designation' => $request->designation,
                    'email_verified_at' => Carbon::now(),
                    'usertype' => ($roleName->name == "SuperAdmin"?strtolower($roleName->name):$roleName->name),
                    'status' => 3,
                ];
            }
            elseif ($roleName->name == 'SupplyChainManager' && $roleName->id == 20)
            {
                $validated = validator::make($request->all(),[
                    'email' => 'required|email|unique:users',
                ]);

                if ($validated->fails()) {
                    session()->flash('message', 'Email already exits');
                    return redirect()->back()->withInput();
                }

                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'designation' => $request->designation,
                    'email_verified_at' => Carbon::now(),
                    'usertype' => ($roleName->name == "SuperAdmin"?strtolower($roleName->name):$roleName->name),
                    'status' => 3,
                ];
            }
            else
            {
                $validated = validator::make($request->all(),[
                    'email' => 'required|email|unique:users',
                ]);

                if ($validated->fails()) {
                    session()->flash('message', 'Email already exits');
                    return redirect()->back()->withInput();
                }

                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'designation' => $request->designation,
                    'business_id' => auth()->user()->business_id,
                    'usertype' => ($roleName->name == "SuperAdmin"?strtolower($roleName->name):$roleName->name),
                    'status' => 3,
                ];
            }
        }
        else{
            $validated = validator::make($request->all(),[
                'email' => 'required|email|unique:users',
            ]);

            if ($validated->fails()) {
                session()->flash('message', 'Email already exits');
                return redirect()->back()->withInput();
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'designation' => $request->designation,
                'email_verified_at' => Carbon::now(),
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

        session()->flash('message', 'User added been successfully.');
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
        if (auth()->user()->hasRole('SuperAdmin')) {

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
//        return view('users.edit', compact('user', 'roles','permissions'));
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
        return redirect()->route('packages.index');
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

    public function createSupplier()
    {
        return view('users.ceo.createSupplier');
    }

    public function storeSupplier(Request $request)
    {
        $validated = validator::make($request->all(),[
            'gender' => 'required',
            'name' => 'required',
            'middle_initial' => 'required',
            'family_name' => 'required',
            'nid_num' => 'required',
            'nid_exp_date' => 'required|date',
            'mobile' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withInput()->withErrors($validated->errors());
        }

        $data = [
            'gender' => $request->gender,
            'name' => $request->name,
            'middle_initial' => $request->middle_initial,
            'family_name' => $request->family_name,
            'nid_num' => $request->nid_num,
            'nid_exp_date' => $request->nid_exp_date,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'CEO',
            'registration_type' => 'Supplier',
            'added_by' => 1,           /* 1 for buyer*/
            'added_by_userId' => \auth()->id(),
        ];


        $user = User::create($data);
        $password = $request->password;
        $user->notify(new \App\Notifications\UserCreate($password));
        $user->assignRole('CEO');

        session()->flash('message', 'Supplier added successfully.');
        return redirect()->route('businessSuppliers');
    }

    public function createBuyer()
    {
        return view('users.ceo.createBuyer');
    }

    public function storeBuyer(Request $request)
    {
        $validated = validator::make($request->all(),[
            'gender' => 'required',
            'name' => 'required',
            'middle_initial' => 'required',
            'family_name' => 'required',
            'nid_num' => 'required',
            'nid_exp_date' => 'required|date',
            'mobile' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withInput()->withErrors($validated->errors());
        }

        $data = [
            'gender' => $request->gender,
            'name' => $request->name,
            'middle_initial' => $request->middle_initial,
            'family_name' => $request->family_name,
            'nid_num' => $request->nid_num,
            'nid_exp_date' => $request->nid_exp_date,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'CEO',
            'registration_type' => 'Buyer',
            'added_by' => 2,           /* 2 for supplier*/
            'added_by_userId' => \auth()->id(),
        ];


        $user = User::create($data);
        $password = $request->password;
        $user->notify(new \App\Notifications\UserCreate($password));
        $user->assignRole('CEO');

        session()->flash('message', 'Buyer added successfully.');
        return redirect()->route('businessBuyers');
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
