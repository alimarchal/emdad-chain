@include('_layouts.header')
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center lg:hidden">
                    <a href="{{ route('dashboard') }}">
                        <!-- <x-jet-application-mark class="block h-9 w-auto"/> -->
                        <img src="{{url('logo.png')}}" alt="EMDAD CHAIN LOGO" class="block h-9 w-auto"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    @role('SuperAdmin')
                        <x-jet-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                            {{ __('Users') }}
                        </x-jet-nav-link>
                    @endrole

                    @if(Auth::user()->status == 1)
                    @else
                        @if(Auth::user()->registration_type)
                            <x-jet-nav-link href="{{ route('business.create') }}" :active="request()->routeIs('business.*')">
                                {{ __('Business') }}
                                @php
                                    $isBusinessDataExist = \App\Models\Business::where('user_id',Auth::user()->id)->first();
                                    if ($isBusinessDataExist) {
                                    //$isBusinessFinanceDataExist = \App\Models\BusinessFinanceDetail::where('business_id',$isBusinessDataExist->id)->first();
                                    $isBusinessWarehouseDataExist = \App\Models\BusinessWarehouse::where('business_id',$isBusinessDataExist->id)->first();
                                    //$isBusinessFinanceDataExist = \App\Models\BusinessFinanceDetail::where('business_id',$isBusinessDataExist->id)->first();
                                    $isBusinessPOIExist = \App\Models\POInfo::where('business_id',$isBusinessDataExist->id)->first();
                                    }
                                @endphp
                                @if(isset($isBusinessDataExist))
                                    &nbsp;<img src="{{url('complete_check.jpg')}}" class="w-4 inline">
                                @endif
                            </x-jet-nav-link>



                            @if(isset($isBusinessWarehouseDataExist))

                                <x-jet-nav-link href="{{route('businessWarehouseShow',$isBusinessWarehouseDataExist->business_id)}}" :active="request()->routeIs('businessWarehouse.*')">
                                    {{ __('Warehouse') }}
                                    @if(isset($isBusinessWarehouseDataExist))
                                        &nbsp;<img src="{{url('complete_check.jpg')}}" class="w-4 inline">
                                    @endif
                                </x-jet-nav-link>

                            @else
                                <x-jet-nav-link href="{{ route('businessWarehouse.create') }}" :active="request()->routeIs('businessWarehouse.*')">
                                    {{ __('Warehouse') }}
                                    @if(isset($isBusinessWarehouseDataExist))
                                        &nbsp;<img src="{{url('complete_check.jpg')}}" class="w-4 inline">
                                    @endif
                                </x-jet-nav-link>
                            @endif

                            @if(isset($isBusinessPOIExist))
                                <x-jet-nav-link href="{{ route('purchaseOrderInfo.show',$isBusinessPOIExist->id) }}" :active="request()->routeIs('purchaseOrderInfo.*')">
                                    {{ __('P.O. Info') }}
                                    @if(isset($isBusinessPOIExist))
                                        &nbsp;<img src="{{url('complete_check.jpg')}}" class="w-4 inline">
                                    @endif
                                </x-jet-nav-link>
                            @else
                                <x-jet-nav-link href="{{ route('purchaseOrderInfo.create') }}" :active="request()->routeIs('purchaseOrderInfo.*')">
                                    {{ __('P.O. Info') }}
                                    @if(isset($isBusinessPOIExist))
                                        &nbsp;<img src="{{url('complete_check.jpg')}}" class="w-4 inline">
                                    @endif
                                </x-jet-nav-link>
                            @endif

                        @endif
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div x-data="{ notificationOpen: false }" class="relative">
                    <button @click="notificationOpen = ! notificationOpen" class="flex mx-4 text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div x-show="notificationOpen" @click="notificationOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                    <div x-show="notificationOpen" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10" style="width:20rem;">
                        <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                            <img class="h-8 w-8 rounded-full object-cover mx-1"
                                 src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">
                            <p class="text-sm mx-2">
                                <span class="font-bold" href="#">Sara Salah</span> replied on the <span class="font-bold text-indigo-400" href="#">Upload Image</span> artical . 2m
                            </p>
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                            <img class="h-8 w-8 rounded-full object-cover mx-1"
                                 src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80" alt="avatar">
                            <p class="text-sm mx-2">
                                <span class="font-bold" href="#">Slick Net</span> start following you . 45m
                            </p>
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                            <img class="h-8 w-8 rounded-full object-cover mx-1"
                                 src="https://images.unsplash.com/photo-1450297350677-623de575f31c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">
                            <p class="text-sm mx-2">
                                <span class="font-bold" href="#">Jane Doe</span> Like Your reply on <span class="font-bold text-indigo-400" href="#">Test with TDD</span> artical . 1h
                            </p>
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                            <img class="h-8 w-8 rounded-full object-cover mx-1"
                                 src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=398&q=80" alt="avatar">
                            <p class="text-sm mx-2">
                                <span class="font-bold" href="#">Abigail Bennett</span> start following you . 3h
                            </p>
                        </a>
                    </div>
                </div>
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                            </button>

                        @else
                            <button
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>
                        <div class="border-t border-gray-100"></div>
                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        @can('all')
                        <div class="border-t border-gray-100"></div>
                        <x-jet-dropdown-link href="{{ route('downloads') }}">
                            {{ __('Downloads') }}
                        </x-jet-dropdown-link>
                        @endcan

                        @can('create user')
                        <div class="border-t border-gray-100"></div>
                        <x-jet-dropdown-link href="{{ route('users.create') }}">
                            {{ __('Add User') }}
                        </x-jet-dropdown-link>
                        @endcan
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <!-- Team Settings -->
                            <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Team Settings') }}
                            </x-jet-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Create New Team') }}
                                </x-jet-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team"/>
                            @endforeach

                            <div class="border-t border-gray-100"></div>
                    @endif

                    <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('ZZ') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

            <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                        {{ __('Create New Team') }}
                    </x-jet-responsive-nav-link>

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link"/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
