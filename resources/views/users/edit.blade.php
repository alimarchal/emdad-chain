@section('headerScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@if(auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New User') }}
            </h2>
        </x-slot>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
                $('.js-example-basic-multiple1').select2();
            });
        </script>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <div class="mt-5 md:mt-0 md:col-span-2">
                    {{--                <form method="post" action="{{route('createUserForCompany',auth()->user()->business->id)}}">--}}
                    <form method="post" action="{{route('users.update', [$user->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">

                                <h3 class="text-2xl text-center mb-2">{{__('portal.Edit User')}}</h3>
                                <div class="grid grid-cols-8 gap-6">
                                    <!-- Name -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="name">
                                            {{__('portal.Name')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" type="text" name="name" value="{{$user->name}}" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="email">
                                            {{__('portal.Email')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="email" type="email" name="email" value="{{$user->email}}" required>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="password">
                                            {{__('portal.Password')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="password" type="password" name="password">
                                    </div>

                                    <!-- Empty -->
                                    <div class="col-span-6 sm:col-span-2">
                                    </div>

                                    <!-- Roles -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="role">
                                            {{__('portal.Role')}}
                                        </label>
{{--                                        <select name="role[]" id="role" class="form-input rounded-md shadow-sm mt-1 block w-full js-example-basic-multiple1" multiple="multiple" required>--}}
                                        {{-- Uncomment above line inorder to assign a user more than one role --}}
                                        <select name="role" id="role" class="form-input rounded-md shadow-sm mt-1 block w-full js-example-basic-multiple1" required>
                                            {{--                                        @foreach($roles as $role)--}}
                                            {{--                                            <option value="{{ $role->id }}" {{ ($userRole[0] == $role->id ? 'selected' : '')}}>{{ $role->name }}</option>--}}
                                            {{--                                        @endforeach--}}
                                            @foreach($roles as $id => $roles)
                                                <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>
                                                    @if(auth()->user()->registration_type == 'Buyer')
                                                        {{ str_replace('Buyer', '',$roles) }}
                                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                                        {{ str_replace('Supplier', '',$roles) }}
                                                    @else
                                                        {{ $roles }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Permissions -->
                                    <div class="col-span-12 sm:col-span-9">
                                        <label class="block font-medium text-sm text-gray-700" for="designation">
                                            {{__('portal.Permissions')}}
                                        </label>
                                        <select multiple="multiple" name="permissions[]" id="designation" class="form-input rounded-md shadow-sm mt-1 block w-full js-example-basic-multiple">
                                            {{--                                        @foreach($permissions as $id => $permission)--}}
                                            {{--                                            <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($userRole) && $userRole->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ $permission->name }}</option>--}}
                                            {{--                                        @endforeach--}}
                                            @foreach($permissions as $id => $permissions)
                                                <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($user) && $user->permissions()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                                                {{--                                                <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($user) && $user->getAllPermissions()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>--}}
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                    {{__('portal.Update')}}
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
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New User') }}
            </h2>
        </x-slot>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
                $('.js-example-basic-multiple1').select2();
            });
        </script>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <div class="mt-5 md:mt-0 md:col-span-2">
                    {{--                <form method="post" action="{{route('createUserForCompany',auth()->user()->business->id)}}">--}}
                    <form method="post" action="{{route('users.update', [$user->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">

                                <h3 class="text-2xl text-center mb-2">{{__('portal.Edit User')}}</h3>
                                <div class="grid grid-cols-8 gap-6">
                                    <!-- Name -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="name">
                                            {{__('portal.Name')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" type="text" style="font-family: sans-serif" name="name" value="{{$user->name}}" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="email">
                                            {{__('portal.Email')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="email" type="email" style="font-family: sans-serif" name="email" value="{{$user->email}}" required>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="password">
                                            {{__('portal.Password')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="password" type="password" name="password">
                                    </div>

                                    <!-- Empty -->
                                    <div class="col-span-6 sm:col-span-2">
                                    </div>

                                    <!-- Roles -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700" for="role">
                                            {{__('portal.Role')}}
                                        </label>
{{--                                        <select name="role[]" id="role" class="form-input rounded-md shadow-sm mt-1 block w-full js-example-basic-multiple1" multiple="multiple" required>--}}
                                        {{-- Uncomment above line inorder to assign a user more than one role --}}
                                            <select name="role" id="role" class="form-input rounded-md shadow-sm mt-1 block w-full js-example-basic-multiple1" required>
                                            {{--                                        @foreach($roles as $role)--}}
                                            {{--                                            <option value="{{ $role->id }}" {{ ($userRole[0] == $role->id ? 'selected' : '')}}>{{ $role->name }}</option>--}}
                                            {{--                                        @endforeach--}}
                                            @foreach($roles as $id => $roles)
                                                <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>
                                                    @if(auth()->user()->registration_type == 'Buyer')
                                                        {{ str_replace('Buyer', '',$roles) }}
                                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                                        {{ str_replace('Supplier', '',$roles) }}
                                                    @else
                                                        {{ $roles }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Permissions -->
                                    <div class="col-span-12 sm:col-span-9">
                                        <label class="block font-medium text-sm text-gray-700" for="designation">
                                            {{__('portal.Permissions')}}
                                        </label>
                                        <select multiple="multiple" name="permissions[]" id="designation" class="form-input rounded-md shadow-sm mt-1 block w-full js-example-basic-multiple">
                                            {{--                                        @foreach($permissions as $id => $permission)--}}
                                            {{--                                            <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($userRole) && $userRole->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ $permission->name }}</option>--}}
                                            {{--                                        @endforeach--}}
                                            @foreach($permissions as $id => $permissions)
                                                <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($user) && $user->permissions()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                                                {{--                                                <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($user) && $user->getAllPermissions()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>--}}
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 hover:text-white active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                                    {{__('portal.Update')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
