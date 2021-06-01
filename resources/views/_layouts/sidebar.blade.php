@section('headerScripts')
{{--    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>--}}
@endsection

@if (auth()->user()->rtl == 0)
    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
         class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex items-center justify-center mt-8">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ url('logo.png') }}" alt="EMDAD CHAIN LOGO" class="block h-9 w-auto"/>
                </a>
                <a href="{{ route('dashboard') }}"
                   @if(auth()->user()->hasRole('SuperAdmin')) title="SuperAdmin Virtual office"
                   @elseif(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer') title="Buyer Virtual office"
                   @elseif(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier') title="Supplier Virtual office"
                   @elseif(auth()->user()->hasRole('Buyer Warehouse Admin')) title="Warehouse Admin Virtual office"
                   @elseif(auth()->user()->hasRole('Supplier Sales')) title="Supplier Sales Virtual office"
                   @endif
                >
                <span class="text-white text-2xl mx-2 font-semibold">
                    Virtual office
                </span>
                </a>
            </div>
        </div>

        <nav class="mt-10">
            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dashboard') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="{{ route('dashboard') }}">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                </svg>
                <span class="mx-3">Dashboard</span>
            </a>

            {{-- Roles & Permissions--}}
            @if(auth()->user()->can('all'))

            {{-- Roles --}}
            <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('role.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('role.index') }}">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"></path>
                </svg>
                <span class="mx-3">Roles</span>
            </a>

            {{-- Permissions --}}
            <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('permission.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('permission.index') }}">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M6.625 2.655A9 9 0 0119 11a1 1 0 11-2 0 7 7 0 00-9.625-6.492 1 1 0 11-.75-1.853zM4.662 4.959A1 1 0 014.75 6.37 6.97 6.97 0 003 11a1 1 0 11-2 0 8.97 8.97 0 012.25-5.953 1 1 0 011.412-.088z" clip-rule="evenodd"></path>
                    <path fill-rule="evenodd" d="M5 11a5 5 0 1110 0 1 1 0 11-2 0 3 3 0 10-6 0c0 1.677-.345 3.276-.968 4.729a1 1 0 11-1.838-.789A9.964 9.964 0 005 11zm8.921 2.012a1 1 0 01.831 1.145 19.86 19.86 0 01-.545 2.436 1 1 0 11-1.92-.558c.207-.713.371-1.445.49-2.192a1 1 0 011.144-.83z"
                          clip-rule="evenodd"></path>
                    <path fill-rule="evenodd" d="M10 10a1 1 0 011 1c0 2.236-.46 4.368-1.29 6.304a1 1 0 01-1.838-.789A13.952 13.952 0 009 11a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                <span class="mx-3">Permissions</span>
            </a>
            @endif

            {{-- B & S Info link --}}
{{--           @if(auth()->user()->hasRole('CEO') && Auth::user()->status == 3)--}}
           @if(auth()->user()->hasRole('CEO') && Auth::user()->registration_type != null)
            <div x-data="{ open: false } ">
                <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('business.*') || request()->routeIs('businessWarehouseShow')|| request()->routeIs('businessWarehouse.create')|| request()->routeIs('purchaseOrderInfo.*')|| request()->routeIs('businessSuppliers')|| request()->routeIs('businessBuyers')|| request()->routeIs('vehicle.create')|| request()->routeIs('vehicle.index')|| request()->routeIs('users.index')|| request()->routeIs('packages.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    {{--                    <path d="M2.25,12.584c-0.713,0-1.292,0.578-1.292,1.291s0.579,1.291,1.292,1.291c0.713,0,1.292-0.578,1.292-1.291S2.963,12.584,2.25,12.584z M2.25,14.307c-0.238,0-0.43-0.193-0.43-0.432s0.192-0.432,0.43-0.432c0.238,0,0.431,0.193,0.431,0.432S2.488,14.307,2.25,14.307z M5.694,6.555H18.61c0.237,0,0.431-0.191,0.431-0.43s-0.193-0.431-0.431-0.431H5.694c-0.238,0-0.43,0.192-0.43,0.431S5.457,6.555,5.694,6.555z M2.25,8.708c-0.713,0-1.292,0.578-1.292,1.291c0,0.715,0.579,1.292,1.292,1.292c0.713,0,1.292-0.577,1.292-1.292C3.542,9.287,2.963,8.708,2.25,8.708z M2.25,10.43c-0.238,0-0.43-0.192-0.43-0.431c0-0.237,0.192-0.43,0.43-0.43c0.238,0,0.431,0.192,0.431,0.43C2.681,10.238,2.488,10.43,2.25,10.43z M18.61,9.57H5.694c-0.238,0-0.43,0.192-0.43,0.43c0,0.238,0.192,0.431,0.43,0.431H18.61c0.237,0,0.431-0.192,0.431-0.431C19.041,9.762,18.848,9.57,18.61,9.57z M18.61,13.443H5.694c-0.238,0-0.43,0.193-0.43,0.432s0.192,0.432,0.43,0.432H18.61c0.237,0,0.431-0.193,0.431-0.432S18.848,13.443,18.61,13.443z M2.25,4.833c-0.713,0-1.292,0.578-1.292,1.292c0,0.713,0.579,1.291,1.292,1.291c0.713,0,1.292-0.578,1.292-1.291C3.542,5.412,2.963,4.833,2.25,4.833z M2.25,6.555c-0.238,0-0.43-0.191-0.43-0.43s0.192-0.431,0.43-0.431c0.238,0,0.431,0.192,0.431,0.431S2.488,6.555,2.25,6.555z"></path>--}}
                        <path d="M17.498,11.697c-0.453-0.453-0.704-1.055-0.704-1.697c0-0.642,0.251-1.244,0.704-1.697c0.069-0.071,0.15-0.141,0.257-0.22c0.127-0.097,0.181-0.262,0.137-0.417c-0.164-0.558-0.388-1.093-0.662-1.597c-0.075-0.141-0.231-0.22-0.391-0.199c-0.13,0.02-0.238,0.027-0.336,0.027c-1.325,0-2.401-1.076-2.401-2.4c0-0.099,0.008-0.207,0.027-0.336c0.021-0.158-0.059-0.316-0.199-0.391c-0.503-0.274-1.039-0.498-1.597-0.662c-0.154-0.044-0.32,0.01-0.416,0.137c-0.079,0.106-0.148,0.188-0.22,0.257C11.244,2.956,10.643,3.207,10,3.207c-0.642,0-1.244-0.25-1.697-0.704c-0.071-0.069-0.141-0.15-0.22-0.257C7.987,2.119,7.821,2.065,7.667,2.109C7.109,2.275,6.571,2.497,6.07,2.771C5.929,2.846,5.85,3.004,5.871,3.162c0.02,0.129,0.027,0.237,0.027,0.336c0,1.325-1.076,2.4-2.401,2.4c-0.098,0-0.206-0.007-0.335-0.027C3.001,5.851,2.845,5.929,2.77,6.07C2.496,6.572,2.274,7.109,2.108,7.667c-0.044,0.154,0.01,0.32,0.137,0.417c0.106,0.079,0.187,0.148,0.256,0.22c0.938,0.936,0.938,2.458,0,3.394c-0.069,0.072-0.15,0.141-0.256,0.221c-0.127,0.096-0.181,0.262-0.137,0.416c0.166,0.557,0.388,1.096,0.662,1.596c0.075,0.143,0.231,0.221,0.392,0.199c0.129-0.02,0.237-0.027,0.335-0.027c1.325,0,2.401,1.076,2.401,2.402c0,0.098-0.007,0.205-0.027,0.334C5.85,16.996,5.929,17.154,6.07,17.23c0.501,0.273,1.04,0.496,1.597,0.66c0.154,0.047,0.32-0.008,0.417-0.137c0.079-0.105,0.148-0.186,0.22-0.256c0.454-0.453,1.055-0.703,1.697-0.703c0.643,0,1.244,0.25,1.697,0.703c0.071,0.07,0.141,0.15,0.22,0.256c0.073,0.098,0.188,0.152,0.307,0.152c0.036,0,0.073-0.004,0.109-0.016c0.558-0.164,1.096-0.387,1.597-0.66c0.141-0.076,0.22-0.234,0.199-0.393c-0.02-0.129-0.027-0.236-0.027-0.334c0-1.326,1.076-2.402,2.401-2.402c0.098,0,0.206,0.008,0.336,0.027c0.159,0.021,0.315-0.057,0.391-0.199c0.274-0.5,0.496-1.039,0.662-1.596c0.044-0.154-0.01-0.32-0.137-0.416C17.648,11.838,17.567,11.77,17.498,11.697 M16.671,13.334c-0.059-0.002-0.114-0.002-0.168-0.002c-1.749,0-3.173,1.422-3.173,3.172c0,0.053,0.002,0.109,0.004,0.166c-0.312,0.158-0.64,0.295-0.976,0.406c-0.039-0.045-0.077-0.086-0.115-0.123c-0.601-0.6-1.396-0.93-2.243-0.93s-1.643,0.33-2.243,0.93c-0.039,0.037-0.077,0.078-0.116,0.123c-0.336-0.111-0.664-0.248-0.976-0.406c0.002-0.057,0.004-0.113,0.004-0.166c0-1.75-1.423-3.172-3.172-3.172c-0.054,0-0.11,0-0.168,0.002c-0.158-0.312-0.293-0.639-0.405-0.975c0.044-0.039,0.085-0.078,0.124-0.115c1.236-1.236,1.236-3.25,0-4.486C3.009,7.719,2.969,7.68,2.924,7.642c0.112-0.336,0.247-0.664,0.405-0.976C3.387,6.668,3.443,6.67,3.497,6.67c1.75,0,3.172-1.423,3.172-3.172c0-0.054-0.002-0.11-0.004-0.168c0.312-0.158,0.64-0.293,0.976-0.405C7.68,2.969,7.719,3.01,7.757,3.048c0.6,0.6,1.396,0.93,2.243,0.93s1.643-0.33,2.243-0.93c0.038-0.039,0.076-0.079,0.115-0.123c0.336,0.112,0.663,0.247,0.976,0.405c-0.002,0.058-0.004,0.114-0.004,0.168c0,1.749,1.424,3.172,3.173,3.172c0.054,0,0.109-0.002,0.168-0.004c0.158,0.312,0.293,0.64,0.405,0.976c-0.045,0.038-0.086,0.077-0.124,0.116c-0.6,0.6-0.93,1.396-0.93,2.242c0,0.847,0.33,1.645,0.93,2.244c0.038,0.037,0.079,0.076,0.124,0.115C16.964,12.695,16.829,13.021,16.671,13.334 M10,5.417c-2.528,0-4.584,2.056-4.584,4.583c0,2.529,2.056,4.584,4.584,4.584s4.584-2.055,4.584-4.584C14.584,7.472,12.528,5.417,10,5.417 M10,13.812c-2.102,0-3.812-1.709-3.812-3.812c0-2.102,1.71-3.812,3.812-3.812c2.102,0,3.812,1.71,3.812,3.812C13.812,12.104,12.102,13.812,10,13.812"></path>
                    </svg>
                    <span class="mx-3" >Business Info</span>
                    <span x-show="open == false" >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 2.5em;"  viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 2.5em;"   viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </a>

                @php
                    $isBusinessDataExist = \App\Models\Business::where('user_id', Auth::user()->id)->first();
                    if ($isBusinessDataExist) {
                        $isBusinessWarehouseDataExist = \App\Models\BusinessWarehouse::where('business_id', $isBusinessDataExist->id)->first();
                        $isBusinessPOIExist = \App\Models\POInfo::where('business_id', $isBusinessDataExist->id)->first();
                    }
                @endphp

                <ul
    {{--                x-show="open"--}}
                    x-show.transition.in.duration.50ms.out.duration.100ms="open"
    {{--                x-show.transition.in="open"--}}
    {{--                x-show.transition.out="open"--}}
                    @click.away="open = false"
                >
                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('business.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                         </svg>
                       <a href="{{ route('business.create') }}"><span class="mx-3">Business</span></a>
                        @if (isset($isBusinessDataExist))
                            &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                        @endif
                    </li>
                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('businessWarehouse.create') || request()->routeIs('businessWarehouseShow') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        @if (isset($isBusinessWarehouseDataExist))
                            <a href="{{ route('businessWarehouseShow', $isBusinessWarehouseDataExist->business_id) }}"><span class="mx-3">Warehouse</span></a>
                            @if (isset($isBusinessWarehouseDataExist))
                                &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                            @endif
                        @else
                            <a href="{{ route('businessWarehouse.create') }}"><span class="mx-3">Warehouse</span></a>
                            @if (isset($isBusinessWarehouseDataExist))
                                &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                            @endif
                        @endif
                     </li>
                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('purchaseOrderInfo.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        @if (isset($isBusinessPOIExist))
                            <a href="{{ route('purchaseOrderInfo.show', $isBusinessPOIExist->id) }}"><span class="mx-3">P.O. Info</span></a>
                            @if (isset($isBusinessPOIExist))
                                &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                            @endif
                        @else
                            <a href="{{ route('purchaseOrderInfo.create') }}"><span class="mx-3">P.O. Info</span></a>
                            @if (isset($isBusinessPOIExist))
                                &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                            @endif
                        @endif
                    </li>

                    @if (auth()->user()->status == 3)
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('users.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('users.index') }}"><span class="mx-3">Users</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('packages.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('packages.index') }}"><span class="mx-3">Subscription</span></a>
                        </li>
                    @endif

                    @if (auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer' && auth()->user()->status == 3)
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('businessSuppliers') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                                <a href="{{ route('businessSuppliers') }}"><span class="mx-3">Suppliers</span></a>
                        </li>
                    @endif
                    @if (auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('businessBuyers') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('businessBuyers') }}"><span class="mx-3">Buyers</span></a>
                    </li>
                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('vehicle.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('vehicle.create') }}"><span class="mx-3 ">Add Vehicle</span></a>
                    </li>
                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('vehicle.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('vehicle.index') }}"><span class="mx-3 ">List of Vehicles</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            @endif

            {{-- Business link --}}
            @if(auth()->user()->can('all') || auth()->user()->hasRole('Sales Specialist') || auth()->user()->hasRole('Legal Approval Officer 1') || auth()->user()->hasRole('Finance Officer 1') || auth()->user()->hasRole('IT Admin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('business.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('business.index') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none" d="M16.852,5.051h-4.018c0.131-0.225,0.211-0.482,0.211-0.761V3.528c0-0.841-0.682-1.522-1.521-1.522H8.478c-0.841,0-1.523,0.682-1.523,1.522V4.29c0,0.279,0.081,0.537,0.211,0.761H3.148c-0.841,0-1.522,0.682-1.522,1.523v9.897c0,0.842,0.682,1.523,1.522,1.523h13.704c0.842,0,1.523-0.682,1.523-1.523V6.574C18.375,5.733,17.693,5.051,16.852,5.051zM7.716,3.528c0-0.42,0.341-0.761,0.762-0.761h3.045c0.42,0,0.762,0.341,0.762,0.761V4.29c0,0.421-0.342,0.761-0.762,0.761H8.478c-0.42,0-0.762-0.34-0.762-0.761V3.528z M17.615,16.471c0,0.422-0.342,0.762-0.764,0.762H3.148c-0.42,0-0.761-0.34-0.761-0.762V9.62h15.228V16.471z M17.615,8.858H2.387V6.574c0-0.421,0.341-0.761,0.761-0.761h13.704c0.422,0,0.764,0.34,0.764,0.761V8.858z"></path>
                    </svg>
                    <span class="mx-3">Businesses</span>
                </a>
            @endif

            {{-- IREs link --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('adminIres') || request()->routeIs('adminIreEdit') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('adminIres') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none" d="M14.023,12.154c1.514-1.192,2.488-3.038,2.488-5.114c0-3.597-2.914-6.512-6.512-6.512
								c-3.597,0-6.512,2.916-6.512,6.512c0,2.076,0.975,3.922,2.489,5.114c-2.714,1.385-4.625,4.117-4.836,7.318h1.186
								c0.229-2.998,2.177-5.512,4.86-6.566c0.853,0.41,1.804,0.646,2.813,0.646c1.01,0,1.961-0.236,2.812-0.646
								c2.684,1.055,4.633,3.568,4.859,6.566h1.188C18.648,16.271,16.736,13.539,14.023,12.154z M10,12.367
								c-2.943,0-5.328-2.385-5.328-5.327c0-2.943,2.385-5.328,5.328-5.328c2.943,0,5.328,2.385,5.328,5.328
								C15.328,9.982,12.943,12.367,10,12.367z"></path>
                    </svg>
                    <span class="mx-3">IREs</span>
                </a>

                 {{-- Incomplete Business link --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('incompleteBusiness') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('incompleteBusiness') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
                    </svg>
                    <span class="mx-3">Incomplete Registration</span>
                </a>

                {{-- Downloads link --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('adminDownload') || request()->routeIs('adminDownloadCreate')|| request()->routeIs('adminDownloadEdit') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('adminDownload') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.634,10.633c0.116,0.113,0.265,0.168,0.414,0.168c0.153,0,0.308-0.06,0.422-0.177l4.015-4.111c0.229-0.235,0.225-0.608-0.009-0.836c-0.232-0.229-0.606-0.222-0.836,0.009l-3.604,3.689L6.35,5.772C6.115,5.543,5.744,5.55,5.514,5.781C5.285,6.015,5.29,6.39,5.522,6.617L9.634,10.633z"></path>
                        <path d="M17.737,9.815c-0.327,0-0.592,0.265-0.592,0.591v2.903H2.855v-2.903c0-0.327-0.264-0.591-0.591-0.591c-0.327,0-0.591,0.265-0.591,0.591V13.9c0,0.328,0.264,0.592,0.591,0.592h15.473c0.327,0,0.591-0.264,0.591-0.592v-3.494C18.328,10.08,18.064,9.815,17.737,9.815z"></path>
                    </svg>
                    <span class="mx-3">Downloads</span>
                </a>

                {{-- Commission percentage link --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('adminPercentage') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('adminPercentage') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.319,8.257c-0.242,0-0.438,0.196-0.438,0.438c0,0.243,0.196,0.438,0.438,0.438c0.242,0,0.438-0.196,0.438-0.438C4.757,8.454,4.561,8.257,4.319,8.257 M7.599,10.396c0,0.08,0.017,0.148,0.05,0.204c0.034,0.056,0.076,0.104,0.129,0.144c0.051,0.04,0.112,0.072,0.182,0.097c0.041,0.015,0.068,0.028,0.098,0.04V9.918C7.925,9.927,7.832,9.958,7.747,10.02C7.648,10.095,7.599,10.22,7.599,10.396 M15.274,6.505H1.252c-0.484,0-0.876,0.392-0.876,0.876v7.887c0,0.484,0.392,0.876,0.876,0.876h14.022c0.483,0,0.876-0.392,0.876-0.876V7.381C16.15,6.897,15.758,6.505,15.274,6.505M1.69,7.381c0.242,0,0.438,0.196,0.438,0.438S1.932,8.257,1.69,8.257c-0.242,0-0.438-0.196-0.438-0.438S1.448,7.381,1.69,7.381M1.69,15.269c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438c0.242,0,0.438,0.195,0.438,0.438S1.932,15.269,1.69,15.269M14.836,15.269c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438s0.438,0.195,0.438,0.438S15.078,15.269,14.836,15.269M15.274,13.596c-0.138-0.049-0.283-0.08-0.438-0.08c-0.726,0-1.314,0.589-1.314,1.314c0,0.155,0.031,0.301,0.08,0.438H2.924c0.049-0.138,0.081-0.283,0.081-0.438c0-0.726-0.589-1.314-1.315-1.314c-0.155,0-0.3,0.031-0.438,0.08V9.053C1.39,9.103,1.535,9.134,1.69,9.134c0.726,0,1.315-0.588,1.315-1.314c0-0.155-0.032-0.301-0.081-0.438h10.678c-0.049,0.137-0.08,0.283-0.08,0.438c0,0.726,0.589,1.314,1.314,1.314c0.155,0,0.301-0.031,0.438-0.081V13.596z M14.836,8.257c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438s0.438,0.196,0.438,0.438S15.078,8.257,14.836,8.257 M12.207,13.516c-0.242,0-0.438,0.196-0.438,0.438s0.196,0.438,0.438,0.438s0.438-0.196,0.438-0.438S12.449,13.516,12.207,13.516 M8.812,11.746c-0.059-0.043-0.126-0.078-0.199-0.104c-0.047-0.017-0.081-0.031-0.117-0.047v1.12c0.137-0.021,0.237-0.064,0.336-0.143c0.116-0.09,0.174-0.235,0.174-0.435c0-0.092-0.018-0.17-0.053-0.233C8.918,11.842,8.87,11.788,8.812,11.746 M18.78,3.875H4.757c-0.484,0-0.876,0.392-0.876,0.876V5.19c0,0.242,0.196,0.438,0.438,0.438c0.242,0,0.438-0.196,0.438-0.438V4.752H18.78v7.888h-1.315c-0.242,0-0.438,0.196-0.438,0.438c0,0.243,0.195,0.438,0.438,0.438h1.315c0.483,0,0.876-0.393,0.876-0.876V4.752C19.656,4.268,19.264,3.875,18.78,3.875 M8.263,8.257c-1.694,0-3.067,1.374-3.067,3.067c0,1.695,1.373,3.068,3.067,3.068c1.695,0,3.067-1.373,3.067-3.068C11.33,9.631,9.958,8.257,8.263,8.257 M9.488,12.543c-0.062,0.137-0.147,0.251-0.255,0.342c-0.108,0.092-0.234,0.161-0.378,0.209c-0.123,0.041-0.229,0.063-0.359,0.075v0.347H8.058v-0.347c-0.143-0.009-0.258-0.032-0.388-0.078c-0.152-0.053-0.281-0.128-0.388-0.226c-0.108-0.098-0.191-0.217-0.25-0.359c-0.059-0.143-0.087-0.307-0.083-0.492h0.575c-0.004,0.219,0.046,0.391,0.146,0.518c0.088,0.109,0.207,0.165,0.388,0.185v-1.211c-0.102-0.031-0.189-0.067-0.3-0.109c-0.136-0.051-0.259-0.116-0.368-0.198c-0.109-0.082-0.198-0.183-0.265-0.306c-0.067-0.123-0.101-0.275-0.101-0.457c0-0.159,0.031-0.298,0.093-0.419c0.062-0.121,0.146-0.222,0.252-0.303S7.597,9.57,7.735,9.527C7.85,9.491,7.944,9.474,8.058,9.468V9.134h0.438v0.333c0.114,0.005,0.207,0.021,0.319,0.054c0.134,0.04,0.251,0.099,0.351,0.179c0.099,0.079,0.178,0.18,0.237,0.303c0.059,0.122,0.088,0.265,0.088,0.427H8.916c-0.007-0.169-0.051-0.297-0.134-0.387C8.712,9.968,8.626,9.932,8.496,9.919v1.059c0.116,0.035,0.213,0.074,0.333,0.118c0.145,0.053,0.272,0.121,0.383,0.203c0.111,0.083,0.2,0.186,0.268,0.308c0.067,0.123,0.101,0.273,0.101,0.453C9.581,12.244,9.549,12.406,9.488,12.543"></path>
                    </svg>
                    <span class="mx-3">Commission percentage</span>
                </a>

            @endif

            @can('all')

                {{-- Category link --}}
    {{--            <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('category.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"--}}
    {{--               href="{{ route('category.create') }}">--}}
    {{--                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
    {{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>--}}
    {{--                </svg>--}}
    {{--                <span class="mx-3">Categories Admin</span>--}}
    {{--            </a>--}}

                {{-- Support Requests link --}}
    {{--            <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('contact.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"--}}
    {{--               href="{{ route('contact.index') }}">--}}
    {{--                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
    {{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>--}}
    {{--                </svg>--}}
    {{--                <span class="mx-3">Support Requests</span>--}}
    {{--            </a>--}}

            @endcan

            {{-- RFQs link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))

                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">SMS</span>
                </a>


                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">RFQs</span>
                </a>
            @endif

            {{-- RFQs link for Buyer --}}
            @if(auth()->user()->can('Buyer Create New Draft RFQ') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer' && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('RFQ.create') || request()->routeIs('RFQCart.index')|| request()->routeIs('PlacedRFQ.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
    {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                        </svg>
                        <span class="mx-3">RFQs</span>
                    <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 6em;" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                        <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 6em;"  viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    </a>
                    <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @click.away="open = false">
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('RFQ.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('RFQ.create') }}"><span class="mx-3 ">Create RFQ</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('RFQCart.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('RFQCart.index') }}"><span class="mx-3 ">RFQs Cart
                                    @if (\App\Models\ECart::where('user_id', auth()->user()->id)
                                    ->where('business_id', auth()->user()->business_id)
                                    ->count())
                                        ({{ \App\Models\ECart::where('user_id', auth()->user()->id)->where('business_id', auth()->user()->business_id)->count() }})
                                    @endif</span>
                            </a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('PlacedRFQ.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('PlacedRFQ.index') }}"><span class="mx-3 ">RFQs History</span>
                            </a>
                        </li>

                    </ul>
                </div>
            @endif

            @if(auth()->user()->can('PoBuyer') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer' && Auth::user()->status == 3)
    {{--        @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('CEO') && Auth::user()->status == 3)--}}

            {{-- Placed RFQs link --}}
    {{--            <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('PlacedRFQ.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"--}}
    {{--               href="{{ route('PlacedRFQ.index') }}">--}}
    {{--                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
    {{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>--}}
    {{--                </svg>--}}
    {{--                <span class="mx-3 ">Placed RFQs</span>--}}
    {{--            </a>--}}
            {{--        @endif--}}
            @endif

{{--            @if(auth()->user()->hasRole('SuperAdmin'))--}}
{{--                <div x-data="{ open: false } ">--}}
{{--                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('viewRFQs') || request()->routeIs('QoutationsBuyerReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">--}}
{{--                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>--}}
{{--                            --}}{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
{{--                        </svg>--}}
{{--                        <span class="mx-3">Quotation</span>--}}
{{--                    <span x-show="open == false">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 4em;"   viewBox="0 0 20 20" fill="currentColor">--}}
{{--                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />--}}
{{--                        </svg>--}}
{{--                    </span>--}}
{{--                        <span x-show="open == true">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 4em;"  viewBox="0 0 20 20" fill="currentColor">--}}
{{--                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                        </svg>--}}
{{--                    </span>--}}
{{--                    </a>--}}
{{--                    <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @click.away="open = false">--}}
{{--                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('viewRFQs') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">--}}
{{--                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>--}}
{{--                            </svg>--}}
{{--                            <a href="{{ route('viewRFQs') }}"><span class="mx-3 ">Quotation (Supplier)</span></a>--}}
{{--                        </li>--}}
{{--                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('QoutationsBuyerReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">--}}
{{--                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>--}}
{{--                            </svg>--}}
{{--                            <a href="{{ route('QoutationsBuyerReceived') }}"><span class="mx-3 ">Quotation (Buyer)</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
            {{-- Qoutations link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">Quotations</span>
                </a>
            @endif

            {{-- Qoutations (Supplier) link --}}
            @if(auth()->user()->can('Supplier View New RFQs')|| auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('viewRFQs') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('viewRFQs') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="mx-3 ">Quotations</span>
                    <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 4em;"   viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 4em;"  viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </a>
            @endif

            {{-- Qoutations (Buyer) link --}}
            @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer' && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('QoutationsBuyerReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('QoutationsBuyerReceived') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span class="mx-3 ">Qoutations</span>
                </a>
                @endif

            {{-- Purchase Order for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">Purchase Order</span>
                </a>
            @endif

            {{-- Purchase Order link --}}
            @if(auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dpo.index') || request()->routeIs('po.po') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                        </svg>
                        <span class="mx-3">Purchase Order</span>
                        <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 1.5em;"   viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                        <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 1.5em;"  viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    </a>
                    <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @click.away="open = false">
                        @if(auth()->user()->can('PoBuyer') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)
                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dpo.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                </svg>
                                <a href="{{ route('dpo.index') }}"><span class="mx-3 ">DPOs</span></a>
                            </li>
                        @endif

                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('po.po') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('po.po') }}"><span class="mx-3 ">PO</span>
                            </a>
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Delivery link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">Delivery</span>
                </a>
            @endif

            {{-- Delivery link --}}
            @if(auth()->user()->hasRole('CEO')  && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('QoutationsBuyerReceived')|| request()->routeIs('deliveryNote.index')|| request()->routeIs('notes') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                        </svg>
                        <span class="mx-3">Delivery</span>
                        <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 5em;"   viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                        <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 5em;"  viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    </a>
                    <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @click.away="open = false">
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('deliveryNote.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('deliveryNote.index') }}"><span class="mx-3 ">Create Delivery Note</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{request()->routeIs('notes') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('notes') }}"><span class="mx-3 ">DN history</span>
                            </a>
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Shipments link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">Shipments</span>
                </a>
            @endif

            {{-- Shipments link --}}
            @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.create') || request()->routeIs('shipment.index')|| request()->routeIs('shipmentCart.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                        </svg>
                        <span class="mx-3">Shipments</span>
                        <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 4em;"   viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                        <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 4em;"  viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    </a>
                    <ul
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        @click.away="open = false"
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipment.create') }}"><span class="mx-3 ">Generate</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipmentCart.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipmentCart.index') }}"><span class="mx-3 ">Cart
                                    @if (\App\Models\ShipmentCart::where('supplier_business_id', auth()->user()->business_id)
                                    ->count())
                                        ({{ \App\Models\ShipmentCart::where('supplier_business_id', auth()->user()->business_id)->count() }})
                                    @endif</span>
                            </a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipment.index') }}"><span class="mx-3 ">Placed Shipments</span>
                            </a>
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Payments link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">Payments</span>
                </a>
            @endif

            {{-- Payments link --}}
            @if(auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)
            <div x-data="{ open: false } ">
                <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('payment.index') || request()->routeIs('generate_proforma_invoices')|| request()->routeIs('bank-payments.index')|| request()->routeIs('invoices')|| request()->routeIs('proforma_invoices')|| request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span class="mx-3">Payments</span>
                    <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 4em;"   viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 4em;"  viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </a>
                <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @click.away="open = false">
                    @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('payment.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('payment.index') }}"><span class="mx-3 ">Generate Invoice</span></a>
                    </li>

                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('generate_proforma_invoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('generate_proforma_invoices') }}"><span class="mx-3 ">Generate Proforma Invoice</span>
                        </a>
                    </li>

                    @endif

                    @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)

                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('invoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('invoices') }}"><span class="mx-3 ">Invoices History</span>
                        </a>
                    </li>

                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('bank-payments.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('bank-payments.index') }}"><span class="mx-3 ">Unpaid Invoices</span>
                        </a>
                    </li>
                    @endif



                    {{-- for buyer --}}
                    @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)

                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('proforma_invoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('proforma_invoices') }}"><span class="mx-3 ">Proforma Invoices</span>
                        </a>
                    </li>

                    @endif

                    {{-- for super admin --}}
                    @if(auth()->user()->hasRole('SuperAdmin'))

                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('emdadInvoices') }}"><span class="mx-3 ">Emdad Invoices</span></a>
                    </li>

                    @endif

                        {{-- for supllier --}}
                    @if(auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('emdadInvoices') }}"><span class="mx-3 ">Emdad Invoices</span></a>
                    </li>

                    @endif
                </ul>
            </div>
        @endif

        </nav>
    </div>
@else
    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden" style="direction: rtl"></div>

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
         class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0" style="direction: rtl">
        <div class="flex items-center justify-center mt-8" style="direction: rtl">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ url('logo.png') }}" alt="EMDAD CHAIN LOGO" class="block h-9 w-auto"/>
                </a>
                <a href="{{ route('dashboard') }}">
                <span class="text-white text-2xl mx-2 font-semibold">
                    @if(auth()->user()->hasRole('SuperAdmin'))  المشرف الرئيسي
                    @elseif(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer') مشتري
                    @elseif(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier') مورّد
                    @elseif(auth()->user()->hasRole('Buyer Warehouse Admin')) Warehouse Admin
                    @elseif(auth()->user()->hasRole('Supplier Sales')) Supplier Sales
                    @endif
                </span>
                </a>
            </div>
        </div>

        <nav class="mt-10">
            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dashboard') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="{{ route('dashboard') }}">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                </svg>
                <span class="mx-3">اللوحة الرئيسية</span>
            </a>

            {{-- Roles & Permissions--}}
            @if(auth()->user()->can('all'))

                {{-- Roles --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('role.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('role.index') }}">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="mx-3">الوظائف</span>
                </a>

                {{-- Permissions --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('permission.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('permission.index') }}">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6.625 2.655A9 9 0 0119 11a1 1 0 11-2 0 7 7 0 00-9.625-6.492 1 1 0 11-.75-1.853zM4.662 4.959A1 1 0 014.75 6.37 6.97 6.97 0 003 11a1 1 0 11-2 0 8.97 8.97 0 012.25-5.953 1 1 0 011.412-.088z" clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M5 11a5 5 0 1110 0 1 1 0 11-2 0 3 3 0 10-6 0c0 1.677-.345 3.276-.968 4.729a1 1 0 11-1.838-.789A9.964 9.964 0 005 11zm8.921 2.012a1 1 0 01.831 1.145 19.86 19.86 0 01-.545 2.436 1 1 0 11-1.92-.558c.207-.713.371-1.445.49-2.192a1 1 0 011.144-.83z"
                              clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M10 10a1 1 0 011 1c0 2.236-.46 4.368-1.29 6.304a1 1 0 01-1.838-.789A13.952 13.952 0 009 11a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="mx-3">التصريحات</span>
                </a>
            @endif

            {{-- B & S Info link --}}
            @if(auth()->user()->hasRole('CEO') && Auth::user()->status == 3)
                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('business.*') || request()->routeIs('businessWarehouseShow')|| request()->routeIs('businessWarehouse.create')|| request()->routeIs('purchaseOrderInfo.*')|| request()->routeIs('vehicle.create')|| request()->routeIs('vehicle.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            {{--                    <path d="M2.25,12.584c-0.713,0-1.292,0.578-1.292,1.291s0.579,1.291,1.292,1.291c0.713,0,1.292-0.578,1.292-1.291S2.963,12.584,2.25,12.584z M2.25,14.307c-0.238,0-0.43-0.193-0.43-0.432s0.192-0.432,0.43-0.432c0.238,0,0.431,0.193,0.431,0.432S2.488,14.307,2.25,14.307z M5.694,6.555H18.61c0.237,0,0.431-0.191,0.431-0.43s-0.193-0.431-0.431-0.431H5.694c-0.238,0-0.43,0.192-0.43,0.431S5.457,6.555,5.694,6.555z M2.25,8.708c-0.713,0-1.292,0.578-1.292,1.291c0,0.715,0.579,1.292,1.292,1.292c0.713,0,1.292-0.577,1.292-1.292C3.542,9.287,2.963,8.708,2.25,8.708z M2.25,10.43c-0.238,0-0.43-0.192-0.43-0.431c0-0.237,0.192-0.43,0.43-0.43c0.238,0,0.431,0.192,0.431,0.43C2.681,10.238,2.488,10.43,2.25,10.43z M18.61,9.57H5.694c-0.238,0-0.43,0.192-0.43,0.43c0,0.238,0.192,0.431,0.43,0.431H18.61c0.237,0,0.431-0.192,0.431-0.431C19.041,9.762,18.848,9.57,18.61,9.57z M18.61,13.443H5.694c-0.238,0-0.43,0.193-0.43,0.432s0.192,0.432,0.43,0.432H18.61c0.237,0,0.431-0.193,0.431-0.432S18.848,13.443,18.61,13.443z M2.25,4.833c-0.713,0-1.292,0.578-1.292,1.292c0,0.713,0.579,1.291,1.292,1.291c0.713,0,1.292-0.578,1.292-1.291C3.542,5.412,2.963,4.833,2.25,4.833z M2.25,6.555c-0.238,0-0.43-0.191-0.43-0.43s0.192-0.431,0.43-0.431c0.238,0,0.431,0.192,0.431,0.431S2.488,6.555,2.25,6.555z"></path>--}}
                            <path d="M17.498,11.697c-0.453-0.453-0.704-1.055-0.704-1.697c0-0.642,0.251-1.244,0.704-1.697c0.069-0.071,0.15-0.141,0.257-0.22c0.127-0.097,0.181-0.262,0.137-0.417c-0.164-0.558-0.388-1.093-0.662-1.597c-0.075-0.141-0.231-0.22-0.391-0.199c-0.13,0.02-0.238,0.027-0.336,0.027c-1.325,0-2.401-1.076-2.401-2.4c0-0.099,0.008-0.207,0.027-0.336c0.021-0.158-0.059-0.316-0.199-0.391c-0.503-0.274-1.039-0.498-1.597-0.662c-0.154-0.044-0.32,0.01-0.416,0.137c-0.079,0.106-0.148,0.188-0.22,0.257C11.244,2.956,10.643,3.207,10,3.207c-0.642,0-1.244-0.25-1.697-0.704c-0.071-0.069-0.141-0.15-0.22-0.257C7.987,2.119,7.821,2.065,7.667,2.109C7.109,2.275,6.571,2.497,6.07,2.771C5.929,2.846,5.85,3.004,5.871,3.162c0.02,0.129,0.027,0.237,0.027,0.336c0,1.325-1.076,2.4-2.401,2.4c-0.098,0-0.206-0.007-0.335-0.027C3.001,5.851,2.845,5.929,2.77,6.07C2.496,6.572,2.274,7.109,2.108,7.667c-0.044,0.154,0.01,0.32,0.137,0.417c0.106,0.079,0.187,0.148,0.256,0.22c0.938,0.936,0.938,2.458,0,3.394c-0.069,0.072-0.15,0.141-0.256,0.221c-0.127,0.096-0.181,0.262-0.137,0.416c0.166,0.557,0.388,1.096,0.662,1.596c0.075,0.143,0.231,0.221,0.392,0.199c0.129-0.02,0.237-0.027,0.335-0.027c1.325,0,2.401,1.076,2.401,2.402c0,0.098-0.007,0.205-0.027,0.334C5.85,16.996,5.929,17.154,6.07,17.23c0.501,0.273,1.04,0.496,1.597,0.66c0.154,0.047,0.32-0.008,0.417-0.137c0.079-0.105,0.148-0.186,0.22-0.256c0.454-0.453,1.055-0.703,1.697-0.703c0.643,0,1.244,0.25,1.697,0.703c0.071,0.07,0.141,0.15,0.22,0.256c0.073,0.098,0.188,0.152,0.307,0.152c0.036,0,0.073-0.004,0.109-0.016c0.558-0.164,1.096-0.387,1.597-0.66c0.141-0.076,0.22-0.234,0.199-0.393c-0.02-0.129-0.027-0.236-0.027-0.334c0-1.326,1.076-2.402,2.401-2.402c0.098,0,0.206,0.008,0.336,0.027c0.159,0.021,0.315-0.057,0.391-0.199c0.274-0.5,0.496-1.039,0.662-1.596c0.044-0.154-0.01-0.32-0.137-0.416C17.648,11.838,17.567,11.77,17.498,11.697 M16.671,13.334c-0.059-0.002-0.114-0.002-0.168-0.002c-1.749,0-3.173,1.422-3.173,3.172c0,0.053,0.002,0.109,0.004,0.166c-0.312,0.158-0.64,0.295-0.976,0.406c-0.039-0.045-0.077-0.086-0.115-0.123c-0.601-0.6-1.396-0.93-2.243-0.93s-1.643,0.33-2.243,0.93c-0.039,0.037-0.077,0.078-0.116,0.123c-0.336-0.111-0.664-0.248-0.976-0.406c0.002-0.057,0.004-0.113,0.004-0.166c0-1.75-1.423-3.172-3.172-3.172c-0.054,0-0.11,0-0.168,0.002c-0.158-0.312-0.293-0.639-0.405-0.975c0.044-0.039,0.085-0.078,0.124-0.115c1.236-1.236,1.236-3.25,0-4.486C3.009,7.719,2.969,7.68,2.924,7.642c0.112-0.336,0.247-0.664,0.405-0.976C3.387,6.668,3.443,6.67,3.497,6.67c1.75,0,3.172-1.423,3.172-3.172c0-0.054-0.002-0.11-0.004-0.168c0.312-0.158,0.64-0.293,0.976-0.405C7.68,2.969,7.719,3.01,7.757,3.048c0.6,0.6,1.396,0.93,2.243,0.93s1.643-0.33,2.243-0.93c0.038-0.039,0.076-0.079,0.115-0.123c0.336,0.112,0.663,0.247,0.976,0.405c-0.002,0.058-0.004,0.114-0.004,0.168c0,1.749,1.424,3.172,3.173,3.172c0.054,0,0.109-0.002,0.168-0.004c0.158,0.312,0.293,0.64,0.405,0.976c-0.045,0.038-0.086,0.077-0.124,0.116c-0.6,0.6-0.93,1.396-0.93,2.242c0,0.847,0.33,1.645,0.93,2.244c0.038,0.037,0.079,0.076,0.124,0.115C16.964,12.695,16.829,13.021,16.671,13.334 M10,5.417c-2.528,0-4.584,2.056-4.584,4.583c0,2.529,2.056,4.584,4.584,4.584s4.584-2.055,4.584-4.584C14.584,7.472,12.528,5.417,10,5.417 M10,13.812c-2.102,0-3.812-1.709-3.812-3.812c0-2.102,1.71-3.812,3.812-3.812c2.102,0,3.812,1.71,3.812,3.812C13.812,12.104,12.102,13.812,10,13.812"></path>
                        </svg>
                        <span class="mx-3">معلومات المشتري والمورد</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">

                        </svg>
                    </a>

                    @php
                        $isBusinessDataExist = \App\Models\Business::where('user_id', Auth::user()->id)->first();
                        if ($isBusinessDataExist) {
                            $isBusinessWarehouseDataExist = \App\Models\BusinessWarehouse::where('business_id', $isBusinessDataExist->id)->first();
                            $isBusinessPOIExist = \App\Models\POInfo::where('business_id', $isBusinessDataExist->id)->first();
                        }
                    @endphp

                    <ul
                        {{--                x-show="open"--}}
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        {{--                x-show.transition.in="open"--}}
                        {{--                x-show.transition.out="open"--}}
                        @click.away="open = false"
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('business.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('business.create') }}"><span class="mx-3">النشاط التجاري</span></a>
                            @if (isset($isBusinessDataExist))
                                &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                            @endif
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('businessWarehouse.create') || request()->routeIs('businessWarehouseShow') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            @if (isset($isBusinessWarehouseDataExist))
                                <a href="{{ route('businessWarehouseShow', $isBusinessWarehouseDataExist->business_id) }}"><span class="mx-3">المستودع</span></a>
                                @if (isset($isBusinessWarehouseDataExist))
                                    &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                                @endif
                            @else
                                <a href="{{ route('businessWarehouse.create') }}"><span class="mx-3">المستودع</span></a>
                                @if (isset($isBusinessWarehouseDataExist))
                                    &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                                @endif
                            @endif
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('purchaseOrderInfo.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            @if (isset($isBusinessPOIExist))
                                <a href="{{ route('purchaseOrderInfo.show', $isBusinessPOIExist->id) }}"><span class="mx-3">معلومات  أمر الشراء</span></a>
                                @if (isset($isBusinessPOIExist))
                                    &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                                @endif
                            @else
                                <a href="{{ route('purchaseOrderInfo.create') }}"><span class="mx-3">معلومات  أمر الشراء</span></a>
                                @if (isset($isBusinessPOIExist))
                                    &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                                @endif
                            @endif
                        </li>
                        @if (auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('vehicle.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                </svg>
                                <a href="{{ route('vehicle.create') }}"><span class="mx-3 ">إضافة عربة</span></a>
                            </li>
                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('vehicle.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                </svg>
                                <a href="{{ route('vehicle.index') }}"><span class="mx-3 ">قائمة العربات</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif

            {{-- Business link --}}
            @if(auth()->user()->can('edit user') && Auth::user()->status == 3)
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('business.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('business.index') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0
                        0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="mx-3">النشاطات التجارية</span>
                </a>
            @endif

            {{-- Incomplete Business link --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('incompleteBusiness') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('incompleteBusiness') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0
                        0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="mx-3">Incomplete Registration</span>
                </a>
            @endif

            @can('all')

                {{-- Category link --}}
                {{--            <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('category.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"--}}
                {{--               href="{{ route('category.create') }}">--}}
                {{--                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
                {{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>--}}
                {{--                </svg>--}}
                {{--                <span class="mx-3">Categories Admin</span>--}}
                {{--            </a>--}}

                {{-- Support Requests link --}}
                {{--            <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('contact.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"--}}
                {{--               href="{{ route('contact.index') }}">--}}
                {{--                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
                {{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>--}}
                {{--                </svg>--}}
                {{--                <span class="mx-3">Support Requests</span>--}}
                {{--            </a>--}}

            @endcan

            {{-- RFQs link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">RFQs</span>
                </a>
            @endif

            {{-- RFQs link --}}
            @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer' && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('RFQ.create') || request()->routeIs('RFQCart.index')|| request()->routeIs('PlacedRFQ.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                        </svg>
                        <span class="mx-3">طلب عروض الأسعار</span>
                    </a>
                    <ul
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        @click.away="open = false"
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('RFQ.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('RFQ.create') }}"><span class="mx-3 ">إنشاء طلب عروض الأسعار</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('RFQCart.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('RFQCart.index') }}"><span class="mx-3 ">سلة طلبات عروض الأسعار
                                    @if (\App\Models\ECart::where('user_id', auth()->user()->id)
                                    ->where('business_id', auth()->user()->business_id)
                                    ->count())
                                        ({{ \App\Models\ECart::where('user_id', auth()->user()->id)->where('business_id', auth()->user()->business_id)->count() }})
                                    @endif</span>
                            </a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('PlacedRFQ.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('PlacedRFQ.index') }}"><span class="mx-3 ">سجل طلبات عروض الأسعار</span>
                            </a>
                        </li>

                    </ul>
                </div>
            @endif

            @if(auth()->user()->can('PoBuyer') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer' && Auth::user()->status == 3)
                {{--        @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('CEO') && Auth::user()->status == 3)--}}

                {{-- Placed RFQs link --}}
                {{--            <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('PlacedRFQ.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"--}}
                {{--               href="{{ route('PlacedRFQ.index') }}">--}}
                {{--                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
                {{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>--}}
                {{--                </svg>--}}
                {{--                <span class="mx-3 ">Placed RFQs</span>--}}
                {{--            </a>--}}
                {{--        @endif--}}
            @endif

            @if(auth()->user()->hasRole('SuperAdmin'))
                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('viewRFQs') || request()->routeIs('QoutationsBuyerReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                        </svg>
                        <span class="mx-3">عرض السعر</span>
                    </a>
                    <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @click.away="open = false">
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('viewRFQs') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('viewRFQs') }}"><span class="mx-3 ">عرض السعر (مورّد)</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('QoutationsBuyerReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('QoutationsBuyerReceived') }}"><span class="mx-3 ">عرض السعر (مشتري)</span>
                            </a>
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Qoutations link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">Qoutations</span>
                </a>
            @endif

            {{-- Qoutations (Supplier) link --}}
            @if(auth()->user()->can('Supplier View New RFQs')|| auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('viewRFQs') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('viewRFQs') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="mx-3 ">Quotations</span>
                </a>
            @endif

            {{-- Qoutations (Buyer) link --}}
            @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer' && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('QoutationsBuyerReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('QoutationsBuyerReceived') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span class="mx-3 ">Quotations</span>
                </a>
            @endif

            {{-- Purchase Order for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">أمر شراء</span>
                </a>
            @endif

            {{-- Purchase Order link --}}
            @if(auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dpo.index') || request()->routeIs('po.po') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                        </svg>
                        <span class="mx-3">أمر شراء</span>
                    </a>
                    <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @click.away="open = false">
                        @if(auth()->user()->can('PoBuyer') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)
                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dpo.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                </svg>
                                <a href="{{ route('dpo.index') }}"><span class="mx-3 ">مسودة أوامر الشراء</span></a>
                            </li>
                        @endif

                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('bank-payments.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                        <a href="{{ route('bank-payments.index') }}"><span class="mx-3 ">Manual Payments</span>
                        </a>
                    </li>

{{--                @endif--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('po.po') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                        </svg>
                        <a href="{{ route('po.po') }}"><span class="mx-3 ">أمر شراء</span>
                        </a>
                    </li>

                    </ul>
                </div>
            @endif

            {{-- Delivery link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">التوصيل</span>
                </a>
            @endif

            {{-- Delivery link --}}
            @if(auth()->user()->hasRole('CEO')  && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('QoutationsBuyerReceived')|| request()->routeIs('deliveryNote.index')|| request()->routeIs('notes') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                        </svg>
                        <span class="mx-3">التوصيل</span>
                    </a>
                    <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @click.away="open = false">
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('deliveryNote.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('deliveryNote.index') }}"><span class="mx-3 ">إنشاء مذكرة توصيل</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{request()->routeIs('notes') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('notes') }}"><span class="mx-3 ">سجل مذكرات التوصيل</span>
                            </a>
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Shipments link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">الشحنات</span>
                </a>
            @endif

            {{-- Shipments link --}}
            @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.create') || request()->routeIs('shipment.index')|| request()->routeIs('shipmentCart.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                        </svg>
                        <span class="mx-3">الشحنات</span>
                    </a>
                    <ul
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        @click.away="open = false"
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipment.create') }}"><span class="mx-3 ">إنشاء</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipmentCart.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipmentCart.index') }}"><span class="mx-3 ">سلة
                                    @if (\App\Models\ShipmentCart::where('supplier_business_id', auth()->user()->business_id)
                                    ->count())
                                        ({{ \App\Models\ShipmentCart::where('supplier_business_id', auth()->user()->business_id)->count() }})
                                    @endif</span>
                            </a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipment.index') }}"><span class="mx-3 ">الشحنات التامة</span>
                            </a>
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Payments link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">المدفوعات</span>
                </a>
            @endif

            {{-- Patments link --}}
            @if(auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)
                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('payment.index') || request()->routeIs('generate_proforma_invoices')|| request()->routeIs('invoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <span class="mx-3">المدفوعات</span>
                    </a>
                    <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @click.away="open = false">
                        @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('payment.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                </svg>
                                <a href="{{ route('payment.index') }}"><span class="mx-3 ">إنشاء فاتورة</span></a>
                            </li>

                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('generate_proforma_invoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                </svg>
                                <a href="{{ route('generate_proforma_invoices') }}"><span class="mx-3 ">إنشاء فاتورة أولية (For Supplier)</span>
                                </a>
                            </li>

                        @endif

                        @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)

                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('invoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                </svg>
                                <a href="{{ route('invoices') }}"><span class="mx-3 ">سجل الفواتير</span>
                                </a>
                            </li>
                        @endif



                        {{-- for buyer --}}
                        @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)

                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('proforma_invoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                </svg>
                                <a href="{{ route('proforma_invoices') }}"><span class="mx-3 ">الفواتير الأولية (For Buyer)</span>
                                </a>
                            </li>

                        @endif
                    </ul>
                </div>
            @endif

        </nav>
    </div>
@endif

