@section('headerScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New User') }}
        </h2>
    </x-slot>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            $('.js-example-basic-single').select2();
        });
    </script>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @include('users.sessionMessage')
            <div class="mt-5 md:mt-0 md:col-span-2">
{{--                <form method="post" action="{{route('createUserForCompany',auth()->user()->business->id)}}">--}}
                <form method="post" action="{{route('users.store')}}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">

                            <h3 class="text-2xl text-center mb-2">Add User</h3>
                            <div class="grid grid-cols-8 gap-6">
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
                                </div>

                                <!-- Roles -->
                                <div class="col-span-6 sm:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700" for="role">
                                        Role
                                    </label>
                                    <select name="role" id="role" class="form-input rounded-md shadow-sm mt-1 block w-full js-example-basic-single" required>
                                        <option disabled selected value="">Select</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Permissions -->
                                <div class="col-span-12 sm:col-span-9">
                                    <label class="block font-medium text-sm text-gray-700" for="designation">
                                        Permissions
                                    </label>
                                    <select multiple="multiple" name="permissions[]" id="designation" class="form-input rounded-md shadow-sm mt-1 block w-full js-example-basic-multiple" required>
                                        @foreach($permissions as $permission)
                                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
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
