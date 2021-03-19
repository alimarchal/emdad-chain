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
                @if(auth()->user()->registration_type == 'Supplier')
                    <!-- Remaining User and Driver count for respective packages -->
                        @php
                            $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();
                            $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                            $userRemaining = $package->users - $userCount;
                            $driverRemaining = $package->driver - $driverCount;
                        @endphp
                        @if($business_package->package_id == 5 || $business_package->package_id == 6 )
                            <div class="flex flex-wrap" style="justify-content: flex-start">
                                <h1 class="text-1xl mt-0 pb-0 text-center"> Remaining Users you can add: </h1>
                                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$userRemaining}} &nbsp;</h1>
                                <h1 class="text-1xl mt-0 pb-0 text-center"> Remaining Drivers you can add: </h1>
                                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$driverRemaining}} </h1>
                            </div>
                        @endif
                        <hr>
                @elseif(auth()->user()->registration_type == 'Buyer')
                    <!-- Remaining User count for respective packages -->
                        @php
                            $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();
                            $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                            $userRemaining = $package->users - $userCount;
                        @endphp
{{--                        @if($business_package->package_id == 1 || $business_package->package_id == 2 )--}}
                            <div class="flex flex-wrap" style="justify-content: flex-start">
                                <h1 class="text-1xl mt-0 pb-0 text-center"> Remaining Users you can add: </h1>
                                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$userCount}} </h1>
                            </div>
{{--                        @endif--}}
                        <hr>
                @endif
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
                                            @if (auth()->user()->registration_type == 'Buyer')
                                                @if ($role->name == 'Buyer Driver')
                                                @else
                                                    <option value="{{$role->id}}">{{str_replace('Buyer', '', $role->name)}}</option>
                                                @endif
                                            @elseif (auth()->user()->registration_type == 'Supplier')
                                                <option value="{{$role->id}}">{{str_replace('Supplier', '', $role->name)}}</option>
                                            @else
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
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
