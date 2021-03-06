<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New User') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @include('users.sessionMessage')
<<<<<<< HEAD
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form method="post" action="{{route('rolePost')}}">
                        @csrf
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                    <!-- Roles -->
                                    <div class="col-span-6 sm:col-span-2 p-2">
                                        <label class="block font-medium text-sm text-gray-700" for="role">
                                            Role
                                        </label>
                                        <select name="role" id="role" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                            <option value="">Select</option>
                                            @foreach(Spatie\Permission\Models\Role::all() as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-span-6">
                                        <label class="block font-medium text-sm text-gray-700" for="permissions">
                                            Permissions
                                        </label>
                                        <div class="mt-2 grid grid-cols-1 md:grid-cols-3 gap-4">

                                            @foreach(\Spatie\Permission\Models\Permission::all() as $permission)

                                                    @if($loop->iteration > 7)
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
                                    Save
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
=======
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <!-- Roles -->
                            <div class="col-span-6 sm:col-span-2">
                                <label class="block font-medium text-sm text-gray-700" for="role">
                                    Role
                                </label>
                                <select name="role" id="role" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="">Select</option>
                                    @foreach (Spatie\Permission\Models\Role::all() as $role)
                                        @if ($role->id >= 11 && $role->id <= 18)
                                            <option value="{{ $role->id }}">{{ $role->name }} - {{ $role->id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-span-6">
                                <label class="block font-medium text-sm text-gray-700" for="permissions">
                                    Permissions
                                </label>
                                <div class="mt-2 grid grid-cols-1 md:grid-cols-3 gap-4">

                                    @foreach (\Spatie\Permission\Models\Permission::all() as $permission)

                                   
                                        <label class="flex items-center">
                                            <input type="checkbox" class="form-checkbox" value="{{ $permission->id }}" name="permission[]">
                                            <span class="ml-2 text-sm text-gray-600">{{ $permission->name }}-{{ $permission->id }}</span>
                                        </label>

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
    </div>
    </div>
>>>>>>> master
</x-app-layout>
