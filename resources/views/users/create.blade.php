<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New User') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @include('users.sessionMessage')
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form method="post" action="{{route('createUserForCompany',auth()->user()->business->id)}}">
                        @csrf
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <h3 class="text-2xl text-center mb-2">{{\App\Models\Business::find(auth()->user()->business_id)->business_name}}</h3>
                                <div class="grid grid-cols-8 gap-6">
                                    <!-- Gender -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="gender">
                                            Gender
                                        </label>
                                        <select name="gender" id="gender" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                            <option value="">Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <input type="hidden" name="business_id" value="{{auth()->user()->business_id}}">
                                        <input type="hidden" name="usertype" value="company_user_{{auth()->user()->business_id}}">
                                    </div>
                                    <!-- Name -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="name">
                                            Name
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" type="text" name="name" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="email">
                                            Email
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="email" type="email" name="email" required>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="password">
                                            Password
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="password" type="password" name="password" required>
                                    </div>

                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="Mobile">
                                            Mobile
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="Mobile" type="tel" name="mobile" required>
                                    </div>
                                    <!-- Designation -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="designation">
                                            Designation
                                        </label>
                                        <select name="designation" id="designation" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                            <option value="">Select</option>
                                            <option value="General Manager">General Manager</option>
                                            <option value="Department Head">Department Head</option>
                                            <option value="Section Head">Section Head</option>
                                            <option value="Warehouse Manager">Warehouse Manager</option>
                                        </select>
                                    </div>

                                    <!-- Roles -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="role">
                                            Role
                                        </label>
                                        <select name="role" id="role" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                            <option value="">Select</option>
                                            @foreach(Spatie\Permission\Models\Role::all() as $role)
                                                @if($role->name == "SuperAdmin" || $role->name == "CEO")
                                                @else
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-span-6">
                                        <label class="block font-medium text-sm text-gray-700" for="permissions">
                                            Permissions
                                        </label>
                                        <div class="mt-2 grid grid-cols-1 md:grid-cols-3 gap-4">

                                            @foreach(\Spatie\Permission\Models\Permission::all() as $permission)

                                                    @if($permission->name == "PoBuyer" || $permission->name == "QoSupplier" )
                                                    <label class="flex items-center">
                                                    <input type="checkbox" class="form-checkbox" value="{{$permission->name}}" name="permission[]">
                                                    <span class="ml-2 text-sm text-gray-600">{{$permission->name}}</span>
                                                    </label>
                                                    @endif

                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--
            <x-jet-section-border/>
            <x-jet-section-title title="Create User" description="Update your account's profile information and email address."/>
            <x-jet-section-border/>
            -->
        </div>
    </div>
</x-app-layout>
