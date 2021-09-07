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
                   @if(auth()->user()->hasRole('SuperAdmin')) title="SuperAdmin {{__('sidebar.Virtual office')}}"
                   @elseif(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer') title="{{auth()->user()->registration_type}} {{__('sidebar.Virtual office')}}"
                   @elseif(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier') title="{{auth()->user()->registration_type}} {{__('sidebar.Virtual office')}}"
                   @else
                   @php $roleName = auth()->user()->roles()->pluck('name'); @endphp
                   title="{{$roleName[0]}} Virtual office"
                    @endif
                >
                <span class="text-white text-2xl mx-2 font-semibold">
                    {{ __('sidebar.Virtual office') }}
                </span>
                </a>
            </div>
        </div>

        <nav class="mt-10">

            @if(auth()->user()->logistic_solution == 0)
                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dashboard') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('dashboard') }}">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Home')}}</span>
                </a>
            @endif

            @if(auth()->user()->logistic_solution == 1)
                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('logistics.dashboard') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('logistics.dashboard') }}">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                    <span class="mx-3">Home</span>
                </a>


                @if(Auth::user()->logistics_business_id == 0)
                    <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs(['logistics.index','logistics.business']) ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray 700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('logistics.business') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span class="mx-3">Business</span>
                    </a>
                @else
                    <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs(['logistics.index','logistics.business']) ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray 700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('logistics.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span class="mx-3">Business</span>
                    </a>
                @endif

                    @if(Auth::user()->logistics_business_id == 0)
                        <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs(['packagingSolution.index','packagingSolution.create']) ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray 700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('packagingSolution.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span class="mx-3">Packaging Solution</span>
                        </a>
                    @else
                        <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs(['packagingSolution.index','packagingSolution.create']) ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray 700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('packagingSolution.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span class="mx-3">Packaging Solution</span>
                        </a>
                    @endif


                    @if(Auth::user()->logistics_business_id == 0)
                        <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs(['storageSolution.index','storageSolution.create']) ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray 700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('storageSolution.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                            </svg>
                            <span class="mx-3">Storage Solution</span>
                        </a>
                    @else
                        <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs(['storageSolution.index','storageSolution.create']) ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray 700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('storageSolution.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                            </svg>
                            <span class="mx-3">Storage Solution</span>
                        </a>
                    @endif

                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('logistics.setting') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray 700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('logistics.setting') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="mx-3">Setting</span>
                </a>


                    <div x-data="{ open: false } ">
                        <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdad_payments') || request()->routeIs('supplier_payment') || request()->routeIs('emdadInvoices') || request()->routeIs('singleCategoryPayments') || request()->routeIs('singleCategorySupplierPayment') || request()->routeIs('singleCategoryEmdadInvoicesIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"  href="javascript:void(0);">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path fill="none" d="M5.229,6.531H4.362c-0.239,0-0.434,0.193-0.434,0.434c0,0.239,0.194,0.434,0.434,0.434h0.868c0.24,0,0.434-0.194,0.434-0.434C5.663,6.724,5.469,6.531,5.229,6.531 M10,6.531c-1.916,0-3.47,1.554-3.47,3.47c0,1.916,1.554,3.47,3.47,3.47c1.916,0,3.47-1.555,3.47-3.47C13.47,8.084,11.916,6.531,10,6.531 M11.4,11.447c-0.071,0.164-0.169,0.299-0.294,0.406c-0.124,0.109-0.27,0.191-0.437,0.248c-0.167,0.057-0.298,0.09-0.492,0.098v0.402h-0.35v-0.402c-0.21-0.004-0.352-0.039-0.527-0.1c-0.175-0.064-0.324-0.154-0.449-0.27c-0.124-0.115-0.221-0.258-0.288-0.428c-0.068-0.17-0.1-0.363-0.096-0.583h0.664c-0.004,0.259,0.052,0.464,0.169,0.613c0.116,0.15,0.259,0.229,0.527,0.236v-1.427c-0.159-0.043-0.268-0.095-0.425-0.156c-0.157-0.061-0.299-0.139-0.425-0.235C8.852,9.752,8.75,9.631,8.672,9.486C8.594,9.34,8.556,9.16,8.556,8.944c0-0.189,0.036-0.355,0.108-0.498c0.072-0.144,0.169-0.264,0.292-0.36c0.122-0.097,0.263-0.17,0.422-0.221c0.159-0.052,0.277-0.077,0.451-0.077V7.401h0.35v0.387c0.174,0,0.29,0.023,0.445,0.071c0.155,0.047,0.29,0.118,0.404,0.212c0.115,0.095,0.206,0.215,0.274,0.359c0.067,0.146,0.103,0.315,0.103,0.508H10.74c-0.007-0.201-0.06-0.354-0.154-0.46c-0.096-0.106-0.199-0.159-0.408-0.159v1.244c0.174,0.047,0.296,0.102,0.462,0.165c0.167,0.063,0.314,0.144,0.443,0.241c0.128,0.099,0.23,0.221,0.309,0.366c0.077,0.146,0.116,0.324,0.116,0.536C11.509,11.092,11.473,11.283,11.4,11.447 M18.675,4.795H1.326c-0.479,0-0.868,0.389-0.868,0.868v8.674c0,0.479,0.389,0.867,0.868,0.867h17.349c0.479,0,0.867-0.389,0.867-0.867V5.664C19.542,5.184,19.153,4.795,18.675,4.795M1.76,5.664c0.24,0,0.434,0.193,0.434,0.434C2.193,6.336,2,6.531,1.76,6.531S1.326,6.336,1.326,6.097C1.326,5.857,1.52,5.664,1.76,5.664 M1.76,14.338c-0.24,0-0.434-0.195-0.434-0.434c0-0.24,0.194-0.434,0.434-0.434s0.434,0.193,0.434,0.434C2.193,14.143,2,14.338,1.76,14.338 M18.241,14.338c-0.24,0-0.435-0.195-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,14.143,18.48,14.338,18.241,14.338 M18.675,12.682c-0.137-0.049-0.281-0.08-0.434-0.08c-0.719,0-1.302,0.584-1.302,1.303c0,0.152,0.031,0.297,0.08,0.434H2.981c0.048-0.137,0.08-0.281,0.08-0.434c0-0.719-0.583-1.303-1.301-1.303c-0.153,0-0.297,0.031-0.434,0.08V7.318c0.136,0.049,0.28,0.08,0.434,0.08c0.718,0,1.301-0.583,1.301-1.301c0-0.153-0.032-0.298-0.08-0.434H17.02c-0.049,0.136-0.08,0.28-0.08,0.434c0,0.718,0.583,1.301,1.302,1.301c0.152,0,0.297-0.031,0.434-0.08V12.682z M18.241,6.531c-0.24,0-0.435-0.194-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,6.336,18.48,6.531,18.241,6.531 M9.22,8.896c0,0.095,0.019,0.175,0.058,0.242c0.039,0.066,0.088,0.124,0.148,0.171c0.061,0.047,0.13,0.086,0.21,0.115c0.079,0.028,0.11,0.055,0.192,0.073V8.319c-0.21,0-0.322,0.044-0.437,0.132C9.277,8.54,9.22,8.688,9.22,8.896 M15.639,12.602h-0.868c-0.239,0-0.434,0.195-0.434,0.434c0,0.24,0.194,0.436,0.434,0.436h0.868c0.24,0,0.434-0.195,0.434-0.436C16.072,12.797,15.879,12.602,15.639,12.602 M10.621,10.5c-0.068-0.052-0.145-0.093-0.23-0.124c-0.086-0.031-0.123-0.06-0.212-0.082v1.374c0.209-0.016,0.332-0.076,0.465-0.186c0.134-0.107,0.201-0.281,0.201-0.516c0-0.11-0.02-0.202-0.062-0.277C10.743,10.615,10.688,10.551,10.621,10.5"></path>
                            </svg>
                            <span class="mx-3">{{__('Packaging Solution')}}</span>
                            <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                            <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 4em;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                        </a>
                        <ul x-show="open" x-show.transition.in.duration.50ms.out.duration.100ms="open" x-show.transition.in="open" x-show.transition.out="open" @click.away="open = false" >
                            {{-- Multi Categories Routes --}}
                            <div x-data="{ open: false } ">
                                <a @click="open = true"
                                   class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdad_payments') || request()->routeIs('supplier_payment')|| request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                                   href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                        <path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/>
                                    </svg>
                                    <span class="mx-3">{{__('sidebar.Multi categories')}}</span>
                                    <span x-show="open == false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                                    <span x-show="open == true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                            </span>
                                </a>
                                <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('emdad_payments') || request()->routeIs('supplier_payment')|| request()->routeIs('emdadInvoices'))  x-data="{ open: true } " @endif>
                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdad_payments') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('emdad_payments') }}"><span class="mx-3 ">{{__('sidebar.Manual Payments')}}</span></a>
                                    </li>

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('supplier_payment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('supplier_payment') }}"><span class="mx-3 ">{{__('sidebar.Payments to supplier')}}</span></a>
                                    </li>

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('emdadInvoices') }}"><span class="mx-3 ">{{ __('sidebar.Emdad Invoices') }}</span></a>
                                    </li>
                                </ul>
                            </div>

                            {{-- Single Category Routes --}}
                            <div x-data="{ open: false } ">
                                <a @click="open = true"
                                   class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryPayments') || request()->routeIs('singleCategorySupplierPayment') || request()->routeIs('singleCategoryEmdadInvoicesIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                                   href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                        <path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/>
                                    </svg>
                                    <span class="mx-3">{{__('sidebar.Single category')}}</span>
                                    <span x-show="open == false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                </span>
                                    <span x-show="open == true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                                </a>
                                <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('singleCategoryPayments') || request()->routeIs('singleCategorySupplierPayment') || request()->routeIs('singleCategoryEmdadInvoicesIndex'))  x-data="{ open: true } " @endif>
                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryPayments') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('singleCategoryPayments') }}"><span class="mx-3 ">{{__('sidebar.Manual Payments')}}</span></a>
                                    </li>

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategorySupplierPayment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('singleCategorySupplierPayment') }}"><span class="mx-3 ">{{__('sidebar.Payments to supplier')}}</span></a>
                                    </li>

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryEmdadInvoicesIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('singleCategoryEmdadInvoicesIndex') }}"><span class="mx-3 ">{{ __('sidebar.Emdad Invoices') }}</span></a>
                                    </li>
                                </ul>
                            </div>

                            {{--<li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdad_payments') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                </svg>
                                <a href="{{ route('emdad_payments') }}"><span class="mx-3 ">Manual Payments</span></a>
                            </li>

                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('supplier_payment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                </svg>
                                <a href="{{ route('supplier_payment') }}"><span class="mx-3 ">Payments to supplier</span></a>
                            </li>

                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('emdadInvoices') }}"><span class="mx-3 ">Emdad Invoices</span></a>
                            </li>--}}

                        </ul>
                    </div>


            @endif

            {{-- Roles & Permissions--}}
            @if(auth()->user()->can('all'))

                {{-- Roles --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('role.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('role.index') }}">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Roles') }}</span>
                </a>

                {{-- Permissions --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('permission.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('permission.index') }}">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6.625 2.655A9 9 0 0119 11a1 1 0 11-2 0 7 7 0 00-9.625-6.492 1 1 0 11-.75-1.853zM4.662 4.959A1 1 0 014.75 6.37 6.97 6.97 0 003 11a1 1 0 11-2 0 8.97 8.97 0 012.25-5.953 1 1 0 011.412-.088z" clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M5 11a5 5 0 1110 0 1 1 0 11-2 0 3 3 0 10-6 0c0 1.677-.345 3.276-.968 4.729a1 1 0 11-1.838-.789A9.964 9.964 0 005 11zm8.921 2.012a1 1 0 01.831 1.145 19.86 19.86 0 01-.545 2.436 1 1 0 11-1.92-.558c.207-.713.371-1.445.49-2.192a1 1 0 011.144-.83z"
                              clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M10 10a1 1 0 011 1c0 2.236-.46 4.368-1.29 6.304a1 1 0 01-1.838-.789A13.952 13.952 0 009 11a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Permissions') }}</span>
                </a>
            @endif

            {{-- Business link --}}
            @if(auth()->user()->can('all') || auth()->user()->hasRole('Sales Specialist') || auth()->user()->hasRole('Legal Approval Officer 1') || auth()->user()->hasRole('Finance Officer 1') || auth()->user()->hasRole('SC Supervisor') || auth()->user()->hasRole('SC Specialist') || auth()->user()->hasRole('IT Admin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('business.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('business.index') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none"
                              d="M16.852,5.051h-4.018c0.131-0.225,0.211-0.482,0.211-0.761V3.528c0-0.841-0.682-1.522-1.521-1.522H8.478c-0.841,0-1.523,0.682-1.523,1.522V4.29c0,0.279,0.081,0.537,0.211,0.761H3.148c-0.841,0-1.522,0.682-1.522,1.523v9.897c0,0.842,0.682,1.523,1.522,1.523h13.704c0.842,0,1.523-0.682,1.523-1.523V6.574C18.375,5.733,17.693,5.051,16.852,5.051zM7.716,3.528c0-0.42,0.341-0.761,0.762-0.761h3.045c0.42,0,0.762,0.341,0.762,0.761V4.29c0,0.421-0.342,0.761-0.762,0.761H8.478c-0.42,0-0.762-0.34-0.762-0.761V3.528z M17.615,16.471c0,0.422-0.342,0.762-0.764,0.762H3.148c-0.42,0-0.761-0.34-0.761-0.762V9.62h15.228V16.471z M17.615,8.858H2.387V6.574c0-0.421,0.341-0.761,0.761-0.761h13.704c0.422,0,0.764,0.34,0.764,0.761V8.858z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Businesses') }}</span>
                </a>
            @endif

            {{-- Business Certificates update link --}}
            @if(auth()->user()->hasRole('Sales Specialist') || auth()->user()->hasRole('Legal Approval Officer 1') || auth()->user()->hasRole('Finance Officer 1') || auth()->user()->hasRole('SC Supervisor') || auth()->user()->hasRole('IT Admin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('certificates') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('certificates') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none"
                              d="M16.852,5.051h-4.018c0.131-0.225,0.211-0.482,0.211-0.761V3.528c0-0.841-0.682-1.522-1.521-1.522H8.478c-0.841,0-1.523,0.682-1.523,1.522V4.29c0,0.279,0.081,0.537,0.211,0.761H3.148c-0.841,0-1.522,0.682-1.522,1.523v9.897c0,0.842,0.682,1.523,1.522,1.523h13.704c0.842,0,1.523-0.682,1.523-1.523V6.574C18.375,5.733,17.693,5.051,16.852,5.051zM7.716,3.528c0-0.42,0.341-0.761,0.762-0.761h3.045c0.42,0,0.762,0.341,0.762,0.761V4.29c0,0.421-0.342,0.761-0.762,0.761H8.478c-0.42,0-0.762-0.34-0.762-0.761V3.528z M17.615,16.471c0,0.422-0.342,0.762-0.764,0.762H3.148c-0.42,0-0.761-0.34-0.761-0.762V9.62h15.228V16.471z M17.615,8.858H2.387V6.574c0-0.421,0.341-0.761,0.761-0.761h13.704c0.422,0,0.764,0.34,0.764,0.761V8.858z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Businesses Certificates') }}</span>
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
                    <span class="mx-3">{{ __('sidebar.IREs') }}</span>
                </a>

                {{-- Incomplete Business link --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('incompleteBusiness') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('incompleteBusiness') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Incomplete Registration') }}</span>
                </a>

                {{-- Downloads link --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('adminDownload') || request()->routeIs('adminDownloadCreate')|| request()->routeIs('adminDownloadEdit') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('adminDownload') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.634,10.633c0.116,0.113,0.265,0.168,0.414,0.168c0.153,0,0.308-0.06,0.422-0.177l4.015-4.111c0.229-0.235,0.225-0.608-0.009-0.836c-0.232-0.229-0.606-0.222-0.836,0.009l-3.604,3.689L6.35,5.772C6.115,5.543,5.744,5.55,5.514,5.781C5.285,6.015,5.29,6.39,5.522,6.617L9.634,10.633z"></path>
                        <path d="M17.737,9.815c-0.327,0-0.592,0.265-0.592,0.591v2.903H2.855v-2.903c0-0.327-0.264-0.591-0.591-0.591c-0.327,0-0.591,0.265-0.591,0.591V13.9c0,0.328,0.264,0.592,0.591,0.592h15.473c0.327,0,0.591-0.264,0.591-0.592v-3.494C18.328,10.08,18.064,9.815,17.737,9.815z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Downloads') }}</span>
                </a>

                {{-- Commission percentage link --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('adminPercentage') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('adminPercentage') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.319,8.257c-0.242,0-0.438,0.196-0.438,0.438c0,0.243,0.196,0.438,0.438,0.438c0.242,0,0.438-0.196,0.438-0.438C4.757,8.454,4.561,8.257,4.319,8.257 M7.599,10.396c0,0.08,0.017,0.148,0.05,0.204c0.034,0.056,0.076,0.104,0.129,0.144c0.051,0.04,0.112,0.072,0.182,0.097c0.041,0.015,0.068,0.028,0.098,0.04V9.918C7.925,9.927,7.832,9.958,7.747,10.02C7.648,10.095,7.599,10.22,7.599,10.396 M15.274,6.505H1.252c-0.484,0-0.876,0.392-0.876,0.876v7.887c0,0.484,0.392,0.876,0.876,0.876h14.022c0.483,0,0.876-0.392,0.876-0.876V7.381C16.15,6.897,15.758,6.505,15.274,6.505M1.69,7.381c0.242,0,0.438,0.196,0.438,0.438S1.932,8.257,1.69,8.257c-0.242,0-0.438-0.196-0.438-0.438S1.448,7.381,1.69,7.381M1.69,15.269c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438c0.242,0,0.438,0.195,0.438,0.438S1.932,15.269,1.69,15.269M14.836,15.269c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438s0.438,0.195,0.438,0.438S15.078,15.269,14.836,15.269M15.274,13.596c-0.138-0.049-0.283-0.08-0.438-0.08c-0.726,0-1.314,0.589-1.314,1.314c0,0.155,0.031,0.301,0.08,0.438H2.924c0.049-0.138,0.081-0.283,0.081-0.438c0-0.726-0.589-1.314-1.315-1.314c-0.155,0-0.3,0.031-0.438,0.08V9.053C1.39,9.103,1.535,9.134,1.69,9.134c0.726,0,1.315-0.588,1.315-1.314c0-0.155-0.032-0.301-0.081-0.438h10.678c-0.049,0.137-0.08,0.283-0.08,0.438c0,0.726,0.589,1.314,1.314,1.314c0.155,0,0.301-0.031,0.438-0.081V13.596z M14.836,8.257c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438s0.438,0.196,0.438,0.438S15.078,8.257,14.836,8.257 M12.207,13.516c-0.242,0-0.438,0.196-0.438,0.438s0.196,0.438,0.438,0.438s0.438-0.196,0.438-0.438S12.449,13.516,12.207,13.516 M8.812,11.746c-0.059-0.043-0.126-0.078-0.199-0.104c-0.047-0.017-0.081-0.031-0.117-0.047v1.12c0.137-0.021,0.237-0.064,0.336-0.143c0.116-0.09,0.174-0.235,0.174-0.435c0-0.092-0.018-0.17-0.053-0.233C8.918,11.842,8.87,11.788,8.812,11.746 M18.78,3.875H4.757c-0.484,0-0.876,0.392-0.876,0.876V5.19c0,0.242,0.196,0.438,0.438,0.438c0.242,0,0.438-0.196,0.438-0.438V4.752H18.78v7.888h-1.315c-0.242,0-0.438,0.196-0.438,0.438c0,0.243,0.195,0.438,0.438,0.438h1.315c0.483,0,0.876-0.393,0.876-0.876V4.752C19.656,4.268,19.264,3.875,18.78,3.875 M8.263,8.257c-1.694,0-3.067,1.374-3.067,3.067c0,1.695,1.373,3.068,3.067,3.068c1.695,0,3.067-1.373,3.067-3.068C11.33,9.631,9.958,8.257,8.263,8.257 M9.488,12.543c-0.062,0.137-0.147,0.251-0.255,0.342c-0.108,0.092-0.234,0.161-0.378,0.209c-0.123,0.041-0.229,0.063-0.359,0.075v0.347H8.058v-0.347c-0.143-0.009-0.258-0.032-0.388-0.078c-0.152-0.053-0.281-0.128-0.388-0.226c-0.108-0.098-0.191-0.217-0.25-0.359c-0.059-0.143-0.087-0.307-0.083-0.492h0.575c-0.004,0.219,0.046,0.391,0.146,0.518c0.088,0.109,0.207,0.165,0.388,0.185v-1.211c-0.102-0.031-0.189-0.067-0.3-0.109c-0.136-0.051-0.259-0.116-0.368-0.198c-0.109-0.082-0.198-0.183-0.265-0.306c-0.067-0.123-0.101-0.275-0.101-0.457c0-0.159,0.031-0.298,0.093-0.419c0.062-0.121,0.146-0.222,0.252-0.303S7.597,9.57,7.735,9.527C7.85,9.491,7.944,9.474,8.058,9.468V9.134h0.438v0.333c0.114,0.005,0.207,0.021,0.319,0.054c0.134,0.04,0.251,0.099,0.351,0.179c0.099,0.079,0.178,0.18,0.237,0.303c0.059,0.122,0.088,0.265,0.088,0.427H8.916c-0.007-0.169-0.051-0.297-0.134-0.387C8.712,9.968,8.626,9.932,8.496,9.919v1.059c0.116,0.035,0.213,0.074,0.333,0.118c0.145,0.053,0.272,0.121,0.383,0.203c0.111,0.083,0.2,0.186,0.268,0.308c0.067,0.123,0.101,0.273,0.101,0.453C9.581,12.244,9.549,12.406,9.488,12.543"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Commission percentage') }}</span>
                </a>

            @endif

            {{-- Super Admin Ratings link --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('ratingView') || request()->routeIs('ratingListIndex') || request()->routeIs('ratingViewByID') || request()->routeIs('emdadRated') || request()->routeIs('emdadRatedViewByID') || request()->routeIs('emdadUnRated') || request()->routeIs('buyerRated') || request()->routeIs('supplierRated') || request()->routeIs('buyerList') || request()->routeIs('rateBuyer') || request()->routeIs('supplierList') || request()->routeIs('rateSupplier') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('ratingView') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none"
                              d="M16.85,7.275l-3.967-0.577l-1.773-3.593c-0.208-0.423-0.639-0.69-1.11-0.69s-0.902,0.267-1.11,0.69L7.116,6.699L3.148,7.275c-0.466,0.068-0.854,0.394-1,0.842c-0.145,0.448-0.023,0.941,0.314,1.27l2.871,2.799l-0.677,3.951c-0.08,0.464,0.112,0.934,0.493,1.211c0.217,0.156,0.472,0.236,0.728,0.236c0.197,0,0.396-0.048,0.577-0.143l3.547-1.864l3.548,1.864c0.18,0.095,0.381,0.143,0.576,0.143c0.256,0,0.512-0.08,0.729-0.236c0.381-0.277,0.572-0.747,0.492-1.211l-0.678-3.951l2.871-2.799c0.338-0.329,0.459-0.821,0.314-1.27C17.705,7.669,17.316,7.343,16.85,7.275z M13.336,11.754l0.787,4.591l-4.124-2.167l-4.124,2.167l0.788-4.591L3.326,8.5l4.612-0.67l2.062-4.177l2.062,4.177l4.613,0.67L13.336,11.754z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Ratings') }}</span>
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
                   href="{{route('smsMessages.index')}}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.SMS') }}</span>
                </a>

                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.RFQs') }}</span>
                </a>
            @endif

            {{-- RFQs link for Buyer --}}
            @if(auth()->user()->can('Buyer Create New RFQ') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer' && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('rfqView') || request()->routeIs('RFQ.create')|| request()->routeIs('RFQCart.index')|| request()->routeIs('PlacedRFQ.index')|| request()->routeIs('create_single_rfq')|| request()->routeIs('single_cart_index')|| request()->routeIs('single_category_rfq_index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('rfqView') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                    </svg>
                    <span class="mx-3">{{ __('sidebar.RFQs') }}</span>
                </a>

                {{--<div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('RFQ.create') || request()->routeIs('RFQCart.index')|| request()->routeIs('PlacedRFQ.index')|| request()->routeIs('create_single_rfq')|| request()->routeIs('single_cart_index')|| request()->routeIs('single_category_rfq_index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
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
                    <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('RFQ.create') || request()->routeIs('RFQCart.index')|| request()->routeIs('PlacedRFQ.index')|| request()->routeIs('create_single_rfq')|| request()->routeIs('single_cart_index')|| request()->routeIs('single_category_rfq_index'))  x-data="{ open: true } " @endif>
                        <div x-data="{ open: false } ">
                            <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('RFQ.create') || request()->routeIs('RFQCart.index') || request()->routeIs('PlacedRFQ.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/></svg>
                                <span class="mx-3" >Multi Categories</span>
                                <span x-show="open == false" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 1.2em;"  viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span x-show="open == true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 1.2em;"   viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </a>
                            <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('RFQ.create') || request()->routeIs('RFQCart.index')|| request()->routeIs('PlacedRFQ.index'))  x-data="{ open: true } " @endif>
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
                                    @if (\App\Models\ECart::where('business_id', auth()->user()->business_id)->count())
                                                ({{ \App\Models\ECart::where('business_id', auth()->user()->business_id)->count() }})
                                                ({{ \App\Models\ECart::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 1])->count() }})
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
                        <div x-data="{ open: false } ">
                            <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('create_single_rfq') || request()->routeIs('single_cart_index') || request()->routeIs('single_category_rfq_index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/></svg>
                                <span class="mx-3" >Single Category</span>
                                <span x-show="open == false" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 1.3em;"  viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span x-show="open == true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 1.3em;"   viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </a>
                            <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('create_single_rfq')||request()->routeIs('single_cart_index')||request()->routeIs('single_category_rfq_index'))  x-data="{ open: true } " @endif>
                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('create_single_rfq') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('create_single_rfq') }}"><span class="mx-3 ">Create RFQ</span></a>
                                </li>
                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('single_cart_index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('single_cart_index') }}"><span class="mx-3 ">RFQs Cart
                                    @if (\App\Models\ECart::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 0])->count())
                                                ({{ \App\Models\ECart::where(['business_id' => auth()->user()->business_id , 'rfq_type' => 0])->count() }})
                                    @endif </span>
                                    </a>
                                </li>
                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('single_category_rfq_index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('single_category_rfq_index') }}"><span class="mx-3 ">RFQs History</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>--}}
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

            {{-- Qoutations link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3 font-extrabold">{{ __('sidebar.Quotations') }}</span>
                </a>
            @endif

            {{-- Qoutations (Supplier) link --}}
            @if(auth()->user()->can('Supplier View New RFQs')|| auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6
                            {{ request()->routeIs('viewRFQs') || request()->routeIs('singleCategoryRFQs') || request()->routeIs('singleCategoryQuotedRFQQuoted')||
                            request()->routeIs('singleCategoryQuotedRFQRejected')|| request()->routeIs('singleCategoryQuotedRFQModificationNeeded')||
                            request()->routeIs('singleCategoryQuotedRFQPendingConfirmation') || request()->routeIs('singleCategoryQuotedModifiedRFQ') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}
                        hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.627,7.885C8.499,8.388,7.873,8.101,8.13,8.177L4.12,7.143c-0.218-0.057-0.351-0.28-0.293-0.498c0.057-0.218,0.279-0.351,0.497-0.294l4.011,1.037C8.552,7.444,8.685,7.667,8.627,7.885 M8.334,10.123L4.323,9.086C4.105,9.031,3.883,9.162,3.826,9.38C3.769,9.598,3.901,9.82,4.12,9.877l4.01,1.037c-0.262-0.062,0.373,0.192,0.497-0.294C8.685,10.401,8.552,10.18,8.334,10.123 M7.131,12.507L4.323,11.78c-0.218-0.057-0.44,0.076-0.497,0.295c-0.057,0.218,0.075,0.439,0.293,0.495l2.809,0.726c-0.265-0.062,0.37,0.193,0.495-0.293C7.48,12.784,7.35,12.562,7.131,12.507M18.159,3.677v10.701c0,0.186-0.126,0.348-0.306,0.393l-7.755,1.948c-0.07,0.016-0.134,0.016-0.204,0l-7.748-1.948c-0.179-0.045-0.306-0.207-0.306-0.393V3.677c0-0.267,0.249-0.461,0.509-0.396l7.646,1.921l7.654-1.921C17.91,3.216,18.159,3.41,18.159,3.677 M9.589,5.939L2.656,4.203v9.857l6.933,1.737V5.939z M17.344,4.203l-6.939,1.736v9.859l6.939-1.737V4.203z M16.168,6.645c-0.058-0.218-0.279-0.351-0.498-0.294l-4.011,1.037c-0.218,0.057-0.351,0.28-0.293,0.498c0.128,0.503,0.755,0.216,0.498,0.292l4.009-1.034C16.092,7.085,16.225,6.863,16.168,6.645 M16.168,9.38c-0.058-0.218-0.279-0.349-0.498-0.294l-4.011,1.036c-0.218,0.057-0.351,0.279-0.293,0.498c0.124,0.486,0.759,0.232,0.498,0.294l4.009-1.037C16.092,9.82,16.225,9.598,16.168,9.38 M14.963,12.385c-0.055-0.219-0.276-0.35-0.495-0.294l-2.809,0.726c-0.218,0.056-0.351,0.279-0.293,0.496c0.127,0.506,0.755,0.218,0.498,0.293l2.807-0.723C14.89,12.825,15.021,12.603,14.963,12.385"></path>
                        </svg>
                        <span class="mx-3 font-extrabold">{{ __('sidebar.Quotations') }}</span>
                        <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 3.3em;" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                        <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 3.3em;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    </a>

                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
                        {{-- Uncomment below code for dropdown to keep to droped and comment above code --}}
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('viewRFQs') || request()->routeIs('singleCategoryRFQs') || request()->routeIs('singleCategoryQuotedRFQQuoted') || request()->routeIs('singleCategoryQuotedRFQRejected') || request()->routeIs('singleCategoryQuotedRFQModificationNeeded') || request()->routeIs('singleCategoryQuotedRFQPendingConfirmation') || request()->routeIs('singleCategoryQuotedModifiedRFQ') )  x-data="{ open: true } " @endif--}}
                    >
                        @php
                            $business_cate = \App\Models\BusinessCategory::where('business_id', auth()->user()->business_id)->get();
                            if ($business_cate->isNotEmpty()) {
                                foreach ($business_cate as $item) {
                                    $business_categories[] = (int)$item->category_number;
                                }
                            }
                            sort($business_categories);
                            // Counting NEW RFQs for multiple categories for supplier
                            $multiEOrderItems = \App\Models\EOrderItems::where(['status' => 'pending', 'rfq_type' => 1])->where('bypass', 0)->whereDate('quotation_time', '>=', \Carbon\Carbon::now())->whereIn('item_code', $business_categories)->get();
                            $noMultiCategoryQuotationPresent = array();
                            foreach ($multiEOrderItems as $multiEOrderItem)
                                {
                                    $quotes = \App\Models\Qoute::where(['e_order_items_id' => $multiEOrderItem->id, 'supplier_business_id' => auth()->user()->business_id])->first();
                                        if (!($quotes))
                                            {
                                                $noMultiCategoryQuotationPresent[] = $multiEOrderItem->id;
                                            }
                                }

                            // Counting NEW RFQs for single category for supplier
                            $eOrderItems = \App\Models\EOrderItems::where(['status' => 'pending', 'rfq_type' => 0])
                                                                            ->where('bypass', 0)
                                                                            ->whereDate('quotation_time', '>=', \Carbon\Carbon::now())
                                                                            ->whereIn('item_code', $business_categories)
                                                                            ->get();
                            $eOrders = array();
                            foreach ($eOrderItems as $eOrderItem)
                            {
                                $eOrderPresent[] = \App\Models\EOrders::where(['id' => $eOrderItem->e_order_id])->first();
                                $eOrders = $eOrderPresent;
                            }
                            $quotesNotPresent = array(); /* For saving and counting eOrders having no Quotes */
                            if (count($eOrders) > 0)
                            {
                                foreach($eOrders as $eOrder)
                                    {
                                        $quotes = \App\Models\Qoute::where(['e_order_id' => $eOrder->id, 'supplier_business_id' => auth()->user()->business_id])->first();
                                        if (!($quotes))
                                            {
                                                $quotesNotPresent[] = $eOrder->id;
                                            }
                                    }
                            }
                        @endphp
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('viewRFQs') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('viewRFQs') }}"><span class="mx-2">{{ __('sidebar.Multi categories') }} ({{count($noMultiCategoryQuotationPresent)}})</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryRFQs') ||request()->routeIs('singleCategoryQuotedRFQQuoted') ||request()->routeIs('singleCategoryQuotedRFQRejected') ||request()->routeIs('singleCategoryQuotedRFQModificationNeeded') ||request()->routeIs('singleCategoryQuotedRFQPendingConfirmation') ||request()->routeIs('singleCategoryQuotedModifiedRFQ') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('singleCategoryRFQs') }}"><span class="mx-2 ">{{ __('sidebar.Single category') }} @if(count($eOrders) > 0 && count($quotesNotPresent) > 0) ({{count(array_unique($quotesNotPresent))}}) @else {{ '('. 0 .')' }} @endif </span></a>
                        </li>
                    </ul>
                </div>
            @endif

            {{-- Qoutations (Buyer) link --}}
            @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer' && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('QoutationsBuyerReceived') || request()->routeIs('singleCategoryBuyerRFQs') || request()->routeIs('singleCategoryRFQItems') || request()->routeIs('singleCategoryRFQQuotationsBuyerReceived') || request()->routeIs('singleCategoryRFQQuotationsBuyerRejected') || request()->routeIs('singleCategoryRFQQuotationsModificationNeeded') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.627,7.885C8.499,8.388,7.873,8.101,8.13,8.177L4.12,7.143c-0.218-0.057-0.351-0.28-0.293-0.498c0.057-0.218,0.279-0.351,0.497-0.294l4.011,1.037C8.552,7.444,8.685,7.667,8.627,7.885 M8.334,10.123L4.323,9.086C4.105,9.031,3.883,9.162,3.826,9.38C3.769,9.598,3.901,9.82,4.12,9.877l4.01,1.037c-0.262-0.062,0.373,0.192,0.497-0.294C8.685,10.401,8.552,10.18,8.334,10.123 M7.131,12.507L4.323,11.78c-0.218-0.057-0.44,0.076-0.497,0.295c-0.057,0.218,0.075,0.439,0.293,0.495l2.809,0.726c-0.265-0.062,0.37,0.193,0.495-0.293C7.48,12.784,7.35,12.562,7.131,12.507M18.159,3.677v10.701c0,0.186-0.126,0.348-0.306,0.393l-7.755,1.948c-0.07,0.016-0.134,0.016-0.204,0l-7.748-1.948c-0.179-0.045-0.306-0.207-0.306-0.393V3.677c0-0.267,0.249-0.461,0.509-0.396l7.646,1.921l7.654-1.921C17.91,3.216,18.159,3.41,18.159,3.677 M9.589,5.939L2.656,4.203v9.857l6.933,1.737V5.939z M17.344,4.203l-6.939,1.736v9.859l6.939-1.737V4.203z M16.168,6.645c-0.058-0.218-0.279-0.351-0.498-0.294l-4.011,1.037c-0.218,0.057-0.351,0.28-0.293,0.498c0.128,0.503,0.755,0.216,0.498,0.292l4.009-1.034C16.092,7.085,16.225,6.863,16.168,6.645 M16.168,9.38c-0.058-0.218-0.279-0.349-0.498-0.294l-4.011,1.036c-0.218,0.057-0.351,0.279-0.293,0.498c0.124,0.486,0.759,0.232,0.498,0.294l4.009-1.037C16.092,9.82,16.225,9.598,16.168,9.38 M14.963,12.385c-0.055-0.219-0.276-0.35-0.495-0.294l-2.809,0.726c-0.218,0.056-0.351,0.279-0.293,0.496c0.127,0.506,0.755,0.218,0.498,0.293l2.807-0.723C14.89,12.825,15.021,12.603,14.963,12.385"></path>
                        </svg>
                        <span class="mx-3 font-extrabold">{{__('sidebar.Quotations')}}</span>
                        <span x-show="open == false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 3.3em;" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <span x-show="open == true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 3.3em;" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    </a>

                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('QoutationsBuyerReceived') || request()->routeIs('singleCategoryBuyerRFQs') || request()->routeIs('singleCategoryRFQItems') || request()->routeIs('singleCategoryRFQQuotationsBuyerReceived') || request()->routeIs('singleCategoryRFQQuotationsBuyerRejected') || request()->routeIs('singleCategoryRFQQuotationsModificationNeeded'))  x-data="{ open: true } " @endif--}}
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('QoutationsBuyerReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            @php
                                $multiPlacedRFQ = \App\Models\Qoute::where(['business_id' => auth()->user()->business_id, 'status' => 'pending' ,'rfq_type' => 1])->count();
                            @endphp
                            <a href="{{ route('QoutationsBuyerReceived') }}"><span class="mx-2">{{ __('sidebar.Multi categories') }} ({{$multiPlacedRFQ}})</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryBuyerRFQs') || request()->routeIs('singleCategoryRFQItems') || request()->routeIs('singleCategoryRFQQuotationsBuyerReceived') || request()->routeIs('singleCategoryRFQQuotationsBuyerRejected') || request()->routeIs('singleCategoryRFQQuotationsModificationNeeded') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            @php
                                $singlePlacedRFQ = \App\Models\Qoute::where(['business_id' => auth()->user()->business_id, 'status' => 'pending' ,'rfq_type' => 0])->get();
                            @endphp
                            <a href="{{ route('singleCategoryBuyerRFQs') }}"><span class="mx-2">{{ __('sidebar.Single category') }} ({{count($singlePlacedRFQ->unique('e_order_id'))}})</span></a>
                        </li>
                    </ul>
                </div>
            @endif

            {{-- Purchase Order for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Purchase Order') }}</span>
                </a>
            @endif

            {{-- Purchase Order link --}}
            @if(auth()->user()->can('Buyer DPO Approval') || auth()->user()->can('Buyer View Purchase Orders') || auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('purchaseOrderView') ||request()->routeIs('dpo.index') ||request()->routeIs('singleCategoryDPOIndex') ||request()->routeIs('singleCategoryPO') || request()->routeIs('po.po') || request()->routeIs('singleCategoryPO') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('purchaseOrderView') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none"
                              d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                        <path fill="none"
                              d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                        <path fill="none"
                              d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Purchase Order') }}</span>
                </a>

                {{--<div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dpo.index') || request()->routeIs('singleCategoryIndex') || request()->routeIs('singleCategoryPO') || request()->routeIs('po.po')  || request()->routeIs('singleCategoryPO') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="none" d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                            <path fill="none" d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                            <path fill="none" d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
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
                    <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('dpo.index') ||request()->routeIs('singleCategoryIndex') ||request()->routeIs('singleCategoryPO') || request()->routeIs('po.po') || request()->routeIs('singleCategoryPO'))  x-data="{ open: true } " @endif>
                        @if(auth()->user()->can('Buyer DPO Approval') || auth()->user()->can('Buyer View Purchase Orders') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)
                            <div x-data="{ open: false } ">
                                <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dpo.index') || request()->routeIs('singleCategoryIndex')  ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/></svg>
                                    <span class="mx-3" style="margin-left: 20px;">DPOs</span>
                                    <span x-show="open == false" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 5.7em;"  viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    </span>
                                    <span x-show="open == true">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 5.7em;"   viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    </span>
                                </a>
                                <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('dpo.index') || request()->routeIs('singleCategoryIndex'))  x-data="{ open: true } " @endif>
                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dpo.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('dpo.index') }}"><span class="mx-3 ">Multi Categories</span></a>
                                    </li>

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('singleCategoryIndex') }}"><span class="mx-3 ">Single Category</span></a>
                                    </li>
                                </ul>
                            </div>

                           --}}{{-- <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dpo.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                </svg>
                                <a href="{{ route('dpo.index') }}"><span class="mx-3 ">DPOs</span></a>
                            </li>--}}{{--
                        @endif

                        <div x-data="{ open: false } ">
                            <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('po.po') || request()->routeIs('singleCategoryPO')  ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/></svg>
                                <span class="mx-3" style="margin-left: 20px;">PO</span>
                                <span x-show="open == false" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 6.9em;"  viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                </span>
                                <span x-show="open == true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 6.9em;"   viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                </span>
                            </a>
                            <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('po.po') || request()->routeIs('singleCategoryPO'))  x-data="{ open: true } " @endif>
                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('po.po') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('po.po') }}"><span class="mx-3 ">Multi Categories</span></a>
                                </li>

                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryPO') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('singleCategoryPO') }}"><span class="mx-3 ">Single Category</span></a>
                                </li>
                            </ul>
                        </div>
                       --}}{{-- <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('po.po') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('po.po') }}"><span class="mx-3 ">PO</span>
                            </a>
                        </li>--}}{{--

                    </ul>
                </div>--}}
            @endif

            {{-- Delivery link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Delivery Note') }}</span>
                </a>
            @endif

            {{-- Delivery link --}}
            @if(auth()->user()->hasRole('CEO')  && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('deliveryView') ||request()->routeIs('deliveryNote.index') ||request()->routeIs('notes') ||request()->routeIs('singleCategoryIndex') ||request()->routeIs('singleCategoryNotes') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('deliveryView') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.638,6.181h-3.844C13.581,4.273,11.963,2.786,10,2.786c-1.962,0-3.581,1.487-3.793,3.395H2.362c-0.233,0-0.424,0.191-0.424,0.424v10.184c0,0.232,0.191,0.424,0.424,0.424h15.276c0.234,0,0.425-0.191,0.425-0.424V6.605C18.062,6.372,17.872,6.181,17.638,6.181 M13.395,9.151c0.234,0,0.425,0.191,0.425,0.424S13.629,10,13.395,10c-0.232,0-0.424-0.191-0.424-0.424S13.162,9.151,13.395,9.151 M10,3.635c1.493,0,2.729,1.109,2.936,2.546H7.064C7.271,4.744,8.506,3.635,10,3.635 M6.605,9.151c0.233,0,0.424,0.191,0.424,0.424S6.838,10,6.605,10c-0.233,0-0.424-0.191-0.424-0.424S6.372,9.151,6.605,9.151 M17.214,16.365H2.786V7.029h3.395v1.347C5.687,8.552,5.332,9.021,5.332,9.575c0,0.703,0.571,1.273,1.273,1.273c0.702,0,1.273-0.57,1.273-1.273c0-0.554-0.354-1.023-0.849-1.199V7.029h5.941v1.347c-0.495,0.176-0.849,0.645-0.849,1.199c0,0.703,0.57,1.273,1.272,1.273s1.273-0.57,1.273-1.273c0-0.554-0.354-1.023-0.849-1.199V7.029h3.395V16.365z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Delivery Note') }}</span>
                </a>

            @endif

            {{-- Shipments link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3 font-extrabold">{{__('sidebar.Shipments')}}</span>
                </a>
            @endif

            {{-- Supplier Shipments link --}}
            @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.create') || request()->routeIs('shipment.index')|| request()->routeIs('shipmentCart.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             class="w-6 h-6"
                             viewBox="0 0 172 172"
                             style=" fill:#000000;">
                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none"
                               style="mix-blend-mode: normal">
                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                <g fill="currentColor">
                                    <path
                                        d="M24.72553,59.66303c-2.28438,0 -4.03125,1.74688 -4.03125,4.03125v80.625c0,2.28438 1.74687,4.03125 4.03125,4.03125h10.21197c0,0.5375 -0.13385,0.9401 -0.13385,1.4776c0,3.225 0.94115,6.3151 2.55365,8.86823h-13.1698c-2.28438,0 -4.03125,1.74687 -4.03125,4.03125c0,2.28438 1.74687,4.03125 4.03125,4.03125h113.41302c0.40312,0 0.94063,-0.13333 1.34375,-0.2677c8.6,-0.67187 15.45313,-7.92865 15.45313,-16.66302c0,-0.5375 0.00052,-0.9401 -0.13385,-1.4776h10.34583c2.28438,0 4.03125,-1.74687 4.03125,-4.03125v-47.03125v-0.27032v-0.5354c0,-0.13437 0.00052,-0.13595 -0.13385,-0.27032c0,-0.13437 -0.13385,-0.26718 -0.13385,-0.40155l-8.46667,-21.09845c-3.62813,-9.1375 -12.3625,-14.91457 -22.17187,-15.04895h-13.4375c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v76.59375h-54.82605c-1.075,-1.6125 -2.41665,-2.95625 -3.89478,-4.03125h50.79218c2.28438,0 4.03125,-1.74687 4.03125,-4.03125v-68.53125c0,-2.28437 -1.74687,-4.03125 -4.03125,-4.03125zM28.75678,67.59167h79.4151v47.03125h-79.4151zM128.46197,67.59167h5.375v22.84375c0,1.88125 1.21042,3.49165 3.09167,3.89478l23.78333,5.91302v39.91095h-9.13593c-3.09062,-4.43437 -8.06355,-7.25677 -13.84167,-7.25677c-3.35937,0 -6.5849,1.07447 -9.2724,2.82135zM141.89948,68.12708c4.8375,1.20937 8.7349,4.70313 10.61615,9.40625l5.50885,13.84167l-16.125,-4.03125zM28.89063,136.12292h12.89947c-1.47812,1.075 -2.8224,2.41875 -3.8974,4.03125h-9.00208zM51.60053,140.68958c3.225,0 6.17968,1.74792 7.79218,4.43542c0.13437,0.67188 0.40522,1.20833 0.80835,1.61145c0.26875,0.94063 0.5354,2.0172 0.5354,2.95782c0,4.43437 -3.225,8.06198 -7.39062,8.86823h-3.35937c-4.16563,-0.80625 -7.39062,-4.43385 -7.39062,-8.86823c0,-4.97188 4.03282,-9.0047 9.0047,-9.0047zM137.46667,140.68958c4.97188,0 9.00208,4.03282 9.00208,9.0047c0.26875,4.70313 -3.3599,8.46458 -7.92865,9.00208c-0.26875,-0.13438 -0.53645,-0.13385 -0.93958,-0.13385h-1.74792c-4.16563,-0.80625 -7.39063,-4.43385 -7.39063,-8.86823c0,-4.97188 4.03282,-9.0047 9.0047,-9.0047zM68.26355,148.21667h52.67395c0,0.5375 -0.13385,0.9401 -0.13385,1.4776c0,3.225 0.94115,6.3151 2.55365,8.86823h-57.51355c1.6125,-2.55312 2.55365,-5.64323 2.55365,-8.86823c0,-0.5375 0.00052,-0.9401 -0.13385,-1.4776zM6.71875,158.66223c-1.04141,0 -2.08229,0.3711 -2.82135,1.11017c-0.80625,0.67188 -1.2099,1.74635 -1.2099,2.82135c0,1.075 0.40365,2.14948 1.2099,2.82135c0.80625,0.80625 1.74635,1.2099 2.82135,1.2099c1.075,0 2.14948,-0.40365 2.82135,-1.2099c0.80625,-0.80625 1.2099,-1.74635 1.2099,-2.82135c0,-1.075 -0.40365,-2.14948 -1.2099,-2.82135c-0.73906,-0.73906 -1.77994,-1.11017 -2.82135,-1.11017z"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="mx-3 font-extrabold">{{__('sidebar.Shipments')}}</span>
                        <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 3.6em;" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                        <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 3.6em;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    </a>
                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('shipment.create') || request()->routeIs('shipmentCart.index')|| request()->routeIs('shipment.index'))  x-data="{ open: true } " @endif--}}
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipment.create') }}"><span class="mx-3 ">{{__('sidebar.Generate')}}</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipmentCart.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipmentCart.index') }}"><span class="mx-3 ">{{__('sidebar.Cart')}}
                                    @if (\App\Models\ShipmentCart::where('supplier_business_id', auth()->user()->business_id)
                                    ->count())
                                        ({{ \App\Models\ShipmentCart::where('supplier_business_id', auth()->user()->business_id)->count() }})
                                    @endif</span>
                            </a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipment.index') }}"><span class="mx-3 ">{{__('sidebar.Placed Shipments')}}</span>
                            </a>
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Payments link for SuperAdmin && Finance Officer --}}
            @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('Finance Officer 1'))
                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdad_payments') || request()->routeIs('supplier_payment') || request()->routeIs('emdadInvoices') || request()->routeIs('singleCategoryPayments') || request()->routeIs('singleCategorySupplierPayment') || request()->routeIs('singleCategoryEmdadInvoicesIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="none"
                                  d="M5.229,6.531H4.362c-0.239,0-0.434,0.193-0.434,0.434c0,0.239,0.194,0.434,0.434,0.434h0.868c0.24,0,0.434-0.194,0.434-0.434C5.663,6.724,5.469,6.531,5.229,6.531 M10,6.531c-1.916,0-3.47,1.554-3.47,3.47c0,1.916,1.554,3.47,3.47,3.47c1.916,0,3.47-1.555,3.47-3.47C13.47,8.084,11.916,6.531,10,6.531 M11.4,11.447c-0.071,0.164-0.169,0.299-0.294,0.406c-0.124,0.109-0.27,0.191-0.437,0.248c-0.167,0.057-0.298,0.09-0.492,0.098v0.402h-0.35v-0.402c-0.21-0.004-0.352-0.039-0.527-0.1c-0.175-0.064-0.324-0.154-0.449-0.27c-0.124-0.115-0.221-0.258-0.288-0.428c-0.068-0.17-0.1-0.363-0.096-0.583h0.664c-0.004,0.259,0.052,0.464,0.169,0.613c0.116,0.15,0.259,0.229,0.527,0.236v-1.427c-0.159-0.043-0.268-0.095-0.425-0.156c-0.157-0.061-0.299-0.139-0.425-0.235C8.852,9.752,8.75,9.631,8.672,9.486C8.594,9.34,8.556,9.16,8.556,8.944c0-0.189,0.036-0.355,0.108-0.498c0.072-0.144,0.169-0.264,0.292-0.36c0.122-0.097,0.263-0.17,0.422-0.221c0.159-0.052,0.277-0.077,0.451-0.077V7.401h0.35v0.387c0.174,0,0.29,0.023,0.445,0.071c0.155,0.047,0.29,0.118,0.404,0.212c0.115,0.095,0.206,0.215,0.274,0.359c0.067,0.146,0.103,0.315,0.103,0.508H10.74c-0.007-0.201-0.06-0.354-0.154-0.46c-0.096-0.106-0.199-0.159-0.408-0.159v1.244c0.174,0.047,0.296,0.102,0.462,0.165c0.167,0.063,0.314,0.144,0.443,0.241c0.128,0.099,0.23,0.221,0.309,0.366c0.077,0.146,0.116,0.324,0.116,0.536C11.509,11.092,11.473,11.283,11.4,11.447 M18.675,4.795H1.326c-0.479,0-0.868,0.389-0.868,0.868v8.674c0,0.479,0.389,0.867,0.868,0.867h17.349c0.479,0,0.867-0.389,0.867-0.867V5.664C19.542,5.184,19.153,4.795,18.675,4.795M1.76,5.664c0.24,0,0.434,0.193,0.434,0.434C2.193,6.336,2,6.531,1.76,6.531S1.326,6.336,1.326,6.097C1.326,5.857,1.52,5.664,1.76,5.664 M1.76,14.338c-0.24,0-0.434-0.195-0.434-0.434c0-0.24,0.194-0.434,0.434-0.434s0.434,0.193,0.434,0.434C2.193,14.143,2,14.338,1.76,14.338 M18.241,14.338c-0.24,0-0.435-0.195-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,14.143,18.48,14.338,18.241,14.338 M18.675,12.682c-0.137-0.049-0.281-0.08-0.434-0.08c-0.719,0-1.302,0.584-1.302,1.303c0,0.152,0.031,0.297,0.08,0.434H2.981c0.048-0.137,0.08-0.281,0.08-0.434c0-0.719-0.583-1.303-1.301-1.303c-0.153,0-0.297,0.031-0.434,0.08V7.318c0.136,0.049,0.28,0.08,0.434,0.08c0.718,0,1.301-0.583,1.301-1.301c0-0.153-0.032-0.298-0.08-0.434H17.02c-0.049,0.136-0.08,0.28-0.08,0.434c0,0.718,0.583,1.301,1.302,1.301c0.152,0,0.297-0.031,0.434-0.08V12.682z M18.241,6.531c-0.24,0-0.435-0.194-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,6.336,18.48,6.531,18.241,6.531 M9.22,8.896c0,0.095,0.019,0.175,0.058,0.242c0.039,0.066,0.088,0.124,0.148,0.171c0.061,0.047,0.13,0.086,0.21,0.115c0.079,0.028,0.11,0.055,0.192,0.073V8.319c-0.21,0-0.322,0.044-0.437,0.132C9.277,8.54,9.22,8.688,9.22,8.896 M15.639,12.602h-0.868c-0.239,0-0.434,0.195-0.434,0.434c0,0.24,0.194,0.436,0.434,0.436h0.868c0.24,0,0.434-0.195,0.434-0.436C16.072,12.797,15.879,12.602,15.639,12.602 M10.621,10.5c-0.068-0.052-0.145-0.093-0.23-0.124c-0.086-0.031-0.123-0.06-0.212-0.082v1.374c0.209-0.016,0.332-0.076,0.465-0.186c0.134-0.107,0.201-0.281,0.201-0.516c0-0.11-0.02-0.202-0.062-0.277C10.743,10.615,10.688,10.551,10.621,10.5"></path>
                        </svg>
                        <span class="mx-3">{{__('sidebar.Payments')}}</span>
                        <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 4em;" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                        <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 4em;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    </a>
                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('emdad_payments') || request()->routeIs('supplier_payment') || request()->routeIs('emdadInvoices') || request()->routeIs('singleCategoryPayments') || request()->routeIs('singleCategorySupplierPayment') || request()->routeIs('singleCategoryEmdadInvoicesIndex'))  x-data="{ open: true } " @endif--}}
                    >
                        {{-- Multi Categories Routes --}}
                        <div x-data="{ open: false } ">
                            <a @click="open = true"
                               class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdad_payments') || request()->routeIs('supplier_payment')|| request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                               href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/>
                                </svg>
                                <span class="mx-3">{{__('sidebar.Multi categories')}}</span>
                                <span x-show="open == false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                                <span x-show="open == true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                            </span>
                            </a>
                            <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('emdad_payments') || request()->routeIs('supplier_payment')|| request()->routeIs('emdadInvoices'))  x-data="{ open: true } " @endif>
                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdad_payments') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('emdad_payments') }}"><span class="mx-3 ">{{__('sidebar.Manual Payments')}}</span></a>
                                </li>

                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('supplier_payment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('supplier_payment') }}"><span class="mx-3 ">{{__('sidebar.Payments to supplier')}}</span></a>
                                </li>

                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('emdadInvoices') }}"><span class="mx-3 ">{{ __('sidebar.Emdad Invoices') }}</span></a>
                                </li>
                            </ul>
                        </div>

                        {{-- Single Category Routes --}}
                        <div x-data="{ open: false } ">
                            <a @click="open = true"
                               class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryPayments') || request()->routeIs('singleCategorySupplierPayment') || request()->routeIs('singleCategoryEmdadInvoicesIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                               href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/>
                                </svg>
                                <span class="mx-3">{{__('sidebar.Single category')}}</span>
                                <span x-show="open == false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                </span>
                                <span x-show="open == true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            </a>
                            <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('singleCategoryPayments') || request()->routeIs('singleCategorySupplierPayment') || request()->routeIs('singleCategoryEmdadInvoicesIndex'))  x-data="{ open: true } " @endif>
                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryPayments') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('singleCategoryPayments') }}"><span class="mx-3 ">{{__('sidebar.Manual Payments')}}</span></a>
                                </li>

                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategorySupplierPayment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('singleCategorySupplierPayment') }}"><span class="mx-3 ">{{__('sidebar.Payments to supplier')}}</span></a>
                                </li>

                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryEmdadInvoicesIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('singleCategoryEmdadInvoicesIndex') }}"><span class="mx-3 ">{{ __('sidebar.Emdad Invoices') }}</span></a>
                                </li>
                            </ul>
                        </div>

                        {{--<li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdad_payments') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('emdad_payments') }}"><span class="mx-3 ">Manual Payments</span></a>
                        </li>

                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('supplier_payment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('supplier_payment') }}"><span class="mx-3 ">Payments to supplier</span></a>
                        </li>

                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                </svg>
                                <a href="{{ route('emdadInvoices') }}"><span class="mx-3 ">Emdad Invoices</span></a>
                        </li>--}}

                    </ul>
                </div>
                {{--                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('emdad_payments') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"--}}
                {{--                   href="{{route('emdad_payments')}}">--}}

                {{--                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
                {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                {{--                    </svg>--}}
                {{--                    <span class="mx-3">Payments</span>--}}
                {{--                </a>--}}
            @endif

            {{-- Payments link --}}
            @if(auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('paymentView') ||request()->routeIs('payment.index') || request()->routeIs('generate_proforma_invoices')|| request()->routeIs('invoices')|| request()->routeIs('bank-payments.index')|| request()->routeIs('proforma_invoices')|| request()->routeIs('emdadInvoices')|| request()->routeIs('supplier_payment_received') || request()->routeIs('singleCategoryPaymentIndex') || request()->routeIs('singleCategoryGenerateProformaInvoiceView')|| request()->routeIs('singleCategoryInvoices')|| request()->routeIs('singleCategoryBankPaymentIndex')|| request()->routeIs('singleCategoryProformaInvoices')|| request()->routeIs('singleCategoryEmdadInvoicesIndex')|| request()->routeIs('singleCategorySupplierPaymentsReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('paymentView') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none"
                              d="M5.229,6.531H4.362c-0.239,0-0.434,0.193-0.434,0.434c0,0.239,0.194,0.434,0.434,0.434h0.868c0.24,0,0.434-0.194,0.434-0.434C5.663,6.724,5.469,6.531,5.229,6.531 M10,6.531c-1.916,0-3.47,1.554-3.47,3.47c0,1.916,1.554,3.47,3.47,3.47c1.916,0,3.47-1.555,3.47-3.47C13.47,8.084,11.916,6.531,10,6.531 M11.4,11.447c-0.071,0.164-0.169,0.299-0.294,0.406c-0.124,0.109-0.27,0.191-0.437,0.248c-0.167,0.057-0.298,0.09-0.492,0.098v0.402h-0.35v-0.402c-0.21-0.004-0.352-0.039-0.527-0.1c-0.175-0.064-0.324-0.154-0.449-0.27c-0.124-0.115-0.221-0.258-0.288-0.428c-0.068-0.17-0.1-0.363-0.096-0.583h0.664c-0.004,0.259,0.052,0.464,0.169,0.613c0.116,0.15,0.259,0.229,0.527,0.236v-1.427c-0.159-0.043-0.268-0.095-0.425-0.156c-0.157-0.061-0.299-0.139-0.425-0.235C8.852,9.752,8.75,9.631,8.672,9.486C8.594,9.34,8.556,9.16,8.556,8.944c0-0.189,0.036-0.355,0.108-0.498c0.072-0.144,0.169-0.264,0.292-0.36c0.122-0.097,0.263-0.17,0.422-0.221c0.159-0.052,0.277-0.077,0.451-0.077V7.401h0.35v0.387c0.174,0,0.29,0.023,0.445,0.071c0.155,0.047,0.29,0.118,0.404,0.212c0.115,0.095,0.206,0.215,0.274,0.359c0.067,0.146,0.103,0.315,0.103,0.508H10.74c-0.007-0.201-0.06-0.354-0.154-0.46c-0.096-0.106-0.199-0.159-0.408-0.159v1.244c0.174,0.047,0.296,0.102,0.462,0.165c0.167,0.063,0.314,0.144,0.443,0.241c0.128,0.099,0.23,0.221,0.309,0.366c0.077,0.146,0.116,0.324,0.116,0.536C11.509,11.092,11.473,11.283,11.4,11.447 M18.675,4.795H1.326c-0.479,0-0.868,0.389-0.868,0.868v8.674c0,0.479,0.389,0.867,0.868,0.867h17.349c0.479,0,0.867-0.389,0.867-0.867V5.664C19.542,5.184,19.153,4.795,18.675,4.795M1.76,5.664c0.24,0,0.434,0.193,0.434,0.434C2.193,6.336,2,6.531,1.76,6.531S1.326,6.336,1.326,6.097C1.326,5.857,1.52,5.664,1.76,5.664 M1.76,14.338c-0.24,0-0.434-0.195-0.434-0.434c0-0.24,0.194-0.434,0.434-0.434s0.434,0.193,0.434,0.434C2.193,14.143,2,14.338,1.76,14.338 M18.241,14.338c-0.24,0-0.435-0.195-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,14.143,18.48,14.338,18.241,14.338 M18.675,12.682c-0.137-0.049-0.281-0.08-0.434-0.08c-0.719,0-1.302,0.584-1.302,1.303c0,0.152,0.031,0.297,0.08,0.434H2.981c0.048-0.137,0.08-0.281,0.08-0.434c0-0.719-0.583-1.303-1.301-1.303c-0.153,0-0.297,0.031-0.434,0.08V7.318c0.136,0.049,0.28,0.08,0.434,0.08c0.718,0,1.301-0.583,1.301-1.301c0-0.153-0.032-0.298-0.08-0.434H17.02c-0.049,0.136-0.08,0.28-0.08,0.434c0,0.718,0.583,1.301,1.302,1.301c0.152,0,0.297-0.031,0.434-0.08V12.682z M18.241,6.531c-0.24,0-0.435-0.194-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,6.336,18.48,6.531,18.241,6.531 M9.22,8.896c0,0.095,0.019,0.175,0.058,0.242c0.039,0.066,0.088,0.124,0.148,0.171c0.061,0.047,0.13,0.086,0.21,0.115c0.079,0.028,0.11,0.055,0.192,0.073V8.319c-0.21,0-0.322,0.044-0.437,0.132C9.277,8.54,9.22,8.688,9.22,8.896 M15.639,12.602h-0.868c-0.239,0-0.434,0.195-0.434,0.434c0,0.24,0.194,0.436,0.434,0.436h0.868c0.24,0,0.434-0.195,0.434-0.436C16.072,12.797,15.879,12.602,15.639,12.602 M10.621,10.5c-0.068-0.052-0.145-0.093-0.23-0.124c-0.086-0.031-0.123-0.06-0.212-0.082v1.374c0.209-0.016,0.332-0.076,0.465-0.186c0.134-0.107,0.201-0.281,0.201-0.516c0-0.11-0.02-0.202-0.062-0.277C10.743,10.615,10.688,10.551,10.621,10.5"></path>
                    </svg>
                    <span class="mx-3">{{__('sidebar.Payments')}}</span>
                </a>


                {{--<div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('payment.index') || request()->routeIs('generate_proforma_invoices')|| request()->routeIs('bank-payments.index')|| request()->routeIs('invoices')|| request()->routeIs('proforma_invoices')|| request()->routeIs('emdadInvoices')|| request()->routeIs('supplier_payment_received') || request()->routeIs('singleCategoryPaymentIndex') || request()->routeIs('singleCategoryGenerateProformaInvoiceView') || request()->routeIs('singleCategoryProformaInvoices')  || request()->routeIs('singleCategoryInvoices') || request()->routeIs('singleCategoryBankPaymentIndex') || request()->routeIs('singleCategoryEmdadInvoicesIndex') || request()->routeIs('singleCategorySupplierPaymentsReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="none" d="M5.229,6.531H4.362c-0.239,0-0.434,0.193-0.434,0.434c0,0.239,0.194,0.434,0.434,0.434h0.868c0.24,0,0.434-0.194,0.434-0.434C5.663,6.724,5.469,6.531,5.229,6.531 M10,6.531c-1.916,0-3.47,1.554-3.47,3.47c0,1.916,1.554,3.47,3.47,3.47c1.916,0,3.47-1.555,3.47-3.47C13.47,8.084,11.916,6.531,10,6.531 M11.4,11.447c-0.071,0.164-0.169,0.299-0.294,0.406c-0.124,0.109-0.27,0.191-0.437,0.248c-0.167,0.057-0.298,0.09-0.492,0.098v0.402h-0.35v-0.402c-0.21-0.004-0.352-0.039-0.527-0.1c-0.175-0.064-0.324-0.154-0.449-0.27c-0.124-0.115-0.221-0.258-0.288-0.428c-0.068-0.17-0.1-0.363-0.096-0.583h0.664c-0.004,0.259,0.052,0.464,0.169,0.613c0.116,0.15,0.259,0.229,0.527,0.236v-1.427c-0.159-0.043-0.268-0.095-0.425-0.156c-0.157-0.061-0.299-0.139-0.425-0.235C8.852,9.752,8.75,9.631,8.672,9.486C8.594,9.34,8.556,9.16,8.556,8.944c0-0.189,0.036-0.355,0.108-0.498c0.072-0.144,0.169-0.264,0.292-0.36c0.122-0.097,0.263-0.17,0.422-0.221c0.159-0.052,0.277-0.077,0.451-0.077V7.401h0.35v0.387c0.174,0,0.29,0.023,0.445,0.071c0.155,0.047,0.29,0.118,0.404,0.212c0.115,0.095,0.206,0.215,0.274,0.359c0.067,0.146,0.103,0.315,0.103,0.508H10.74c-0.007-0.201-0.06-0.354-0.154-0.46c-0.096-0.106-0.199-0.159-0.408-0.159v1.244c0.174,0.047,0.296,0.102,0.462,0.165c0.167,0.063,0.314,0.144,0.443,0.241c0.128,0.099,0.23,0.221,0.309,0.366c0.077,0.146,0.116,0.324,0.116,0.536C11.509,11.092,11.473,11.283,11.4,11.447 M18.675,4.795H1.326c-0.479,0-0.868,0.389-0.868,0.868v8.674c0,0.479,0.389,0.867,0.868,0.867h17.349c0.479,0,0.867-0.389,0.867-0.867V5.664C19.542,5.184,19.153,4.795,18.675,4.795M1.76,5.664c0.24,0,0.434,0.193,0.434,0.434C2.193,6.336,2,6.531,1.76,6.531S1.326,6.336,1.326,6.097C1.326,5.857,1.52,5.664,1.76,5.664 M1.76,14.338c-0.24,0-0.434-0.195-0.434-0.434c0-0.24,0.194-0.434,0.434-0.434s0.434,0.193,0.434,0.434C2.193,14.143,2,14.338,1.76,14.338 M18.241,14.338c-0.24,0-0.435-0.195-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,14.143,18.48,14.338,18.241,14.338 M18.675,12.682c-0.137-0.049-0.281-0.08-0.434-0.08c-0.719,0-1.302,0.584-1.302,1.303c0,0.152,0.031,0.297,0.08,0.434H2.981c0.048-0.137,0.08-0.281,0.08-0.434c0-0.719-0.583-1.303-1.301-1.303c-0.153,0-0.297,0.031-0.434,0.08V7.318c0.136,0.049,0.28,0.08,0.434,0.08c0.718,0,1.301-0.583,1.301-1.301c0-0.153-0.032-0.298-0.08-0.434H17.02c-0.049,0.136-0.08,0.28-0.08,0.434c0,0.718,0.583,1.301,1.302,1.301c0.152,0,0.297-0.031,0.434-0.08V12.682z M18.241,6.531c-0.24,0-0.435-0.194-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,6.336,18.48,6.531,18.241,6.531 M9.22,8.896c0,0.095,0.019,0.175,0.058,0.242c0.039,0.066,0.088,0.124,0.148,0.171c0.061,0.047,0.13,0.086,0.21,0.115c0.079,0.028,0.11,0.055,0.192,0.073V8.319c-0.21,0-0.322,0.044-0.437,0.132C9.277,8.54,9.22,8.688,9.22,8.896 M15.639,12.602h-0.868c-0.239,0-0.434,0.195-0.434,0.434c0,0.24,0.194,0.436,0.434,0.436h0.868c0.24,0,0.434-0.195,0.434-0.436C16.072,12.797,15.879,12.602,15.639,12.602 M10.621,10.5c-0.068-0.052-0.145-0.093-0.23-0.124c-0.086-0.031-0.123-0.06-0.212-0.082v1.374c0.209-0.016,0.332-0.076,0.465-0.186c0.134-0.107,0.201-0.281,0.201-0.516c0-0.11-0.02-0.202-0.062-0.277C10.743,10.615,10.688,10.551,10.621,10.5"></path>
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
                    <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('payment.index') || request()->routeIs('generate_proforma_invoices')|| request()->routeIs('invoices')|| request()->routeIs('proforma_invoices')|| request()->routeIs('bank-payments.index')|| request()->routeIs('emdadInvoices')|| request()->routeIs('supplier_payment_received') || request()->routeIs('singleCategoryPaymentIndex')  || request()->routeIs('singleCategoryGenerateProformaInvoiceView') || request()->routeIs('singleCategoryProformaInvoices') || request()->routeIs('singleCategoryProformaInvoices') || request()->routeIs('singleCategoryInvoices') || request()->routeIs('singleCategoryBankPaymentIndex')|| request()->routeIs('singleCategoryEmdadInvoicesIndex') || request()->routeIs('singleCategorySupplierPaymentsReceived'))  x-data="{ open: true } " @endif>

                        --}}{{-- Multi Categories Routes --}}{{--
                        <div x-data="{ open: false } ">
                            <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('payment.index') || request()->routeIs('generate_proforma_invoices')|| request()->routeIs('bank-payments.index')|| request()->routeIs('invoices')|| request()->routeIs('proforma_invoices')|| request()->routeIs('emdadInvoices')|| request()->routeIs('supplier_payment_received') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/></svg>
                                <span class="mx-3" >Multi Categories</span>
                                <span x-show="open == false" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 1.2em;"  viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span x-show="open == true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 1.2em;"   viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                </span>
                            </a>
                            <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('payment.index') || request()->routeIs('generate_proforma_invoices')|| request()->routeIs('bank-payments.index')|| request()->routeIs('invoices')|| request()->routeIs('proforma_invoices')|| request()->routeIs('emdadInvoices')|| request()->routeIs('supplier_payment_received'))  x-data="{ open: true } " @endif>
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

                                --}}{{-- for buyer --}}{{--
                                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('proforma_invoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('proforma_invoices') }}"><span class="mx-3 ">Proforma Invoices</span>
                                        </a>
                                    </li>

                                @endif

                                --}}{{-- for supplier --}}{{--
                                @if(auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('emdadInvoices') }}"><span class="mx-3 ">Emdad Invoices</span></a>
                                    </li>

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('supplier_payment_received') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('supplier_payment_received') }}"><span class="mx-3 ">Manual Payments</span></a>
                                    </li>

                                @endif

                            </ul>
                        </div>

                        --}}{{-- Single Category Routes --}}{{--
                        <div x-data="{ open: false } ">
                            <a @click="open = true" class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryPaymentIndex') ||request()->routeIs('singleCategoryGenerateProformaInvoiceView') || request()->routeIs('singleCategoryProformaInvoices') || request()->routeIs('singleCategoryInvoices') || request()->routeIs('singleCategoryBankPaymentIndex') || request()->routeIs('singleCategoryEmdadInvoicesIndex') || request()->routeIs('singleCategorySupplierPaymentsReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/></svg>
                                <span class="mx-3" >Single Category</span>
                                <span x-show="open == false" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"  style="margin-left: 1.3em;"  viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span x-show="open == true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4"  style="margin-left: 1.3em;"   viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </a>
                            <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('singleCategoryPaymentIndex') ||request()->routeIs('singleCategoryGenerateProformaInvoiceView') || request()->routeIs('singleCategoryProformaInvoices') || request()->routeIs('singleCategoryInvoices') || request()->routeIs('singleCategoryBankPaymentIndex') || request()->routeIs('singleCategoryEmdadInvoicesIndex') || request()->routeIs('singleCategorySupplierPaymentsReceived'))  x-data="{ open: true } " @endif>
                                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryPaymentIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('singleCategoryPaymentIndex') }}"><span class="mx-3 ">Generate Invoice</span></a>
                                    </li>

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryGenerateProformaInvoiceView') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('singleCategoryGenerateProformaInvoiceView') }}"><span class="mx-3 ">Generate Proforma Invoice</span>
                                        </a>
                                    </li>

                                @endif

                                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('singleCategoryInvoices') }}"><span class="mx-3 ">Invoices History</span>
                                        </a>
                                    </li>

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryBankPaymentIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('singleCategoryBankPaymentIndex') }}"><span class="mx-3 ">Unpaid Invoices</span>
                                        </a>
                                    </li>
                                @endif

                                --}}{{-- For buyer --}}{{--
                                @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryProformaInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('singleCategoryProformaInvoices') }}"><span class="mx-3 ">Proforma Invoices</span>
                                        </a>
                                    </li>

                                @endif

                                --}}{{-- For supplier --}}{{--
                                @if(auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryEmdadInvoicesIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('singleCategoryEmdadInvoicesIndex') }}"><span class="mx-3 ">Emdad Invoices</span></a>
                                    </li>

                                    <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategorySupplierPaymentsReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                        </svg>
                                        <a href="{{ route('singleCategorySupplierPaymentsReceived') }}"><span class="mx-3 ">Manual Payments</span></a>
                                    </li>

                                @endif
                            </ul>
                        </div>

                        --}}{{--@if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

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

                        --}}{{----}}{{-- for buyer --}}{{----}}{{--
                        @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)

                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('proforma_invoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('proforma_invoices') }}"><span class="mx-3 ">Proforma Invoices</span>
                            </a>
                        </li>

                        @endif

                        --}}{{----}}{{-- for supllier --}}{{----}}{{--
                        @if(auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('emdadInvoices') }}"><span class="mx-3 ">Emdad Invoices</span></a>
                        </li>

                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('supplier_payment_received') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('supplier_payment_received') }}"><span class="mx-3 ">Manual Payments</span></a>
                        </li>

                        @endif--}}{{--
                    </ul>
                </div>--}}
            @endif

            {{-- Buyer Shipments link --}}
            @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.index') || request()->routeIs('deliveredShipments') || request()->routeIs('ongoingShipment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             class="w-6 h-6"
                             viewBox="0 0 172 172"
                             style=" fill:#000000;">
                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none"
                               style="mix-blend-mode: normal">
                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                <g fill="currentColor">
                                    <path
                                        d="M24.72553,59.66303c-2.28438,0 -4.03125,1.74688 -4.03125,4.03125v80.625c0,2.28438 1.74687,4.03125 4.03125,4.03125h10.21197c0,0.5375 -0.13385,0.9401 -0.13385,1.4776c0,3.225 0.94115,6.3151 2.55365,8.86823h-13.1698c-2.28438,0 -4.03125,1.74687 -4.03125,4.03125c0,2.28438 1.74687,4.03125 4.03125,4.03125h113.41302c0.40312,0 0.94063,-0.13333 1.34375,-0.2677c8.6,-0.67187 15.45313,-7.92865 15.45313,-16.66302c0,-0.5375 0.00052,-0.9401 -0.13385,-1.4776h10.34583c2.28438,0 4.03125,-1.74687 4.03125,-4.03125v-47.03125v-0.27032v-0.5354c0,-0.13437 0.00052,-0.13595 -0.13385,-0.27032c0,-0.13437 -0.13385,-0.26718 -0.13385,-0.40155l-8.46667,-21.09845c-3.62813,-9.1375 -12.3625,-14.91457 -22.17187,-15.04895h-13.4375c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v76.59375h-54.82605c-1.075,-1.6125 -2.41665,-2.95625 -3.89478,-4.03125h50.79218c2.28438,0 4.03125,-1.74687 4.03125,-4.03125v-68.53125c0,-2.28437 -1.74687,-4.03125 -4.03125,-4.03125zM28.75678,67.59167h79.4151v47.03125h-79.4151zM128.46197,67.59167h5.375v22.84375c0,1.88125 1.21042,3.49165 3.09167,3.89478l23.78333,5.91302v39.91095h-9.13593c-3.09062,-4.43437 -8.06355,-7.25677 -13.84167,-7.25677c-3.35937,0 -6.5849,1.07447 -9.2724,2.82135zM141.89948,68.12708c4.8375,1.20937 8.7349,4.70313 10.61615,9.40625l5.50885,13.84167l-16.125,-4.03125zM28.89063,136.12292h12.89947c-1.47812,1.075 -2.8224,2.41875 -3.8974,4.03125h-9.00208zM51.60053,140.68958c3.225,0 6.17968,1.74792 7.79218,4.43542c0.13437,0.67188 0.40522,1.20833 0.80835,1.61145c0.26875,0.94063 0.5354,2.0172 0.5354,2.95782c0,4.43437 -3.225,8.06198 -7.39062,8.86823h-3.35937c-4.16563,-0.80625 -7.39062,-4.43385 -7.39062,-8.86823c0,-4.97188 4.03282,-9.0047 9.0047,-9.0047zM137.46667,140.68958c4.97188,0 9.00208,4.03282 9.00208,9.0047c0.26875,4.70313 -3.3599,8.46458 -7.92865,9.00208c-0.26875,-0.13438 -0.53645,-0.13385 -0.93958,-0.13385h-1.74792c-4.16563,-0.80625 -7.39063,-4.43385 -7.39063,-8.86823c0,-4.97188 4.03282,-9.0047 9.0047,-9.0047zM68.26355,148.21667h52.67395c0,0.5375 -0.13385,0.9401 -0.13385,1.4776c0,3.225 0.94115,6.3151 2.55365,8.86823h-57.51355c1.6125,-2.55312 2.55365,-5.64323 2.55365,-8.86823c0,-0.5375 0.00052,-0.9401 -0.13385,-1.4776zM6.71875,158.66223c-1.04141,0 -2.08229,0.3711 -2.82135,1.11017c-0.80625,0.67188 -1.2099,1.74635 -1.2099,2.82135c0,1.075 0.40365,2.14948 1.2099,2.82135c0.80625,0.80625 1.74635,1.2099 2.82135,1.2099c1.075,0 2.14948,-0.40365 2.82135,-1.2099c0.80625,-0.80625 1.2099,-1.74635 1.2099,-2.82135c0,-1.075 -0.40365,-2.14948 -1.2099,-2.82135c-0.73906,-0.73906 -1.77994,-1.11017 -2.82135,-1.11017z"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="mx-3 font-extrabold">{{__('sidebar.Shipments')}}</span>
                        <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 3.6em;" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                        <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 3.6em;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    </a>
                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('shipment.index') || request()->routeIs('deliveredShipments')|| request()->routeIs('ongoingShipment'))  x-data="{ open: true } " @endif--}}
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('ongoingShipment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('ongoingShipment') }}"><span class="mx-3 ">{{__('sidebar.Current Shipments')}}</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('deliveredShipments') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('deliveredShipments') }}"><span class="mx-3 ">{{__('sidebar.Delivered Shipments')}}</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipment.index') }}"><span class="mx-3 ">{{__('sidebar.Shipments Histroy')}}</span></a>
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Warehouse link --}}
            {{--           @if(auth()->user()->hasRole('CEO') && Auth::user()->status == 3)--}}
            @if(auth()->user()->hasRole('CEO') && Auth::user()->registration_type != null)
                <hr class="mt-4">
                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('businessWarehouse.create') || request()->routeIs('businessWarehouseShow')|| request()->routeIs('users.create') || request()->routeIs('vehicle.create')|| request()->routeIs('vehicle.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.121,9.88l-7.832-7.836c-0.155-0.158-0.428-0.155-0.584,0L1.842,9.913c-0.262,0.263-0.073,0.705,0.292,0.705h2.069v7.042c0,0.227,0.187,0.414,0.414,0.414h3.725c0.228,0,0.414-0.188,0.414-0.414v-3.313h2.483v3.313c0,0.227,0.187,0.414,0.413,0.414h3.726c0.229,0,0.414-0.188,0.414-0.414v-7.042h2.068h0.004C18.331,10.617,18.389,10.146,18.121,9.88 M14.963,17.245h-2.896v-3.313c0-0.229-0.186-0.415-0.414-0.415H8.342c-0.228,0-0.414,0.187-0.414,0.415v3.313H5.032v-6.628h9.931V17.245z M3.133,9.79l6.864-6.868l6.867,6.868H3.133z"></path>
                        </svg>
                        {{--                    <svg class="svg-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 20 20">--}}
                        {{--                        <path d="M18.121,9.88l-7.832-7.836c-0.155-0.158-0.428-0.155-0.584,0L1.842,9.913c-0.262,0.263-0.073,0.705,0.292,0.705h2.069v7.042c0,0.227,0.187,0.414,0.414,0.414h3.725c0.228,0,0.414-0.188,0.414-0.414v-3.313h2.483v3.313c0,0.227,0.187,0.414,0.413,0.414h3.726c0.229,0,0.414-0.188,0.414-0.414v-7.042h2.068h0.004C18.331,10.617,18.389,10.146,18.121,9.88 M14.963,17.245h-2.896v-3.313c0-0.229-0.186-0.415-0.414-0.415H8.342c-0.228,0-0.414,0.187-0.414,0.415v3.313H5.032v-6.628h9.931V17.245z M3.133,9.79l6.864-6.868l6.867,6.868H3.133z"></path>--}}
                        {{--                    </svg>--}}
                        <span class="mx-3 font-extrabold">{{ __('sidebar.Warehouse') }}</span>
                        <span x-show="open == false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 3.3em;" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
                        <span x-show="open == true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 3.3em;" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
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
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        @if(request()->routeIs('businessWarehouse.create') || request()->routeIs('businessWarehouseShow'))  x-data="{ open: false } " @endif --}}
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('businessWarehouse.create') || request()->routeIs('businessWarehouseShow') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            @if (isset($isBusinessWarehouseDataExist))
                                <a href="{{ route('businessWarehouseShow', $isBusinessWarehouseDataExist->business_id) }}"><span class="mx-3">{{ __('sidebar.Warehouse') }}</span></a>
                                {{--                            @if (isset($isBusinessWarehouseDataExist))--}}
                                {{--                                &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">--}}
                                {{--                            @endif--}}
                            @else
                                <a href="{{ route('businessWarehouse.create') }}"><span class="mx-3">{{ __('sidebar.Warehouse') }}</span></a>
                                {{--                            @if (isset($isBusinessWarehouseDataExist))--}}
                                {{--                                &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">--}}
                                {{--                            @endif--}}
                            @endif
                        </li>

                        @if (auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('users.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                </svg>
                                <a href="{{ route('users.create') }}"><span class="mx-3 ">{{ __('sidebar.Add Driver') }}</span></a>
                            </li>
                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('vehicle.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                </svg>
                                <a href="{{ route('vehicle.create') }}"><span class="mx-3 ">{{ __('sidebar.Add Vehicle') }}</span></a>
                            </li>
                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('vehicle.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                </svg>
                                <a href="{{ route('vehicle.index') }}"><span class="mx-3 ">{{ __('sidebar.List of Vehicles') }}</span></a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif

            {{-- CEO Users link --}}
            @if(auth()->user()->hasRole('CEO') && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('createSupplier') || request()->routeIs('createBuyer') || request()->routeIs('businessSuppliers')|| request()->routeIs('businessBuyers') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path>
                        </svg>
                        <span class="mx-3 font-extrabold">@if(auth()->user()->registration_type == "Supplier") {{__('sidebar.Buyers')}} @elseif(auth()->user()->registration_type == "Buyer") {{__('sidebar.Suppliers')}} @endif</span>
                        <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" @if(auth()->user()->registration_type == "Supplier") style="margin-left: 5.2em;" @else style="margin-left: 4em;" @endif  viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                        <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" @if(auth()->user()->registration_type == "Supplier") style="margin-left: 5.2em;" @else style="margin-left: 4em;" @endif viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    </a>
                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('createBuyer') || request()->routeIs('createSupplier')|| request()->routeIs('businessBuyers')|| request()->routeIs('businessSuppliers'))  x-data="{ open: true } " @endif--}}
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('createBuyer') || request()->routeIs('createSupplier') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            @if(auth()->user()->registration_type == "Supplier")
                                <a href="{{ route('createBuyer') }}"><span class="mx-3 ">{{__('sidebar.Add Buyer')}}</span></a>
                            @elseif(auth()->user()->registration_type == "Buyer")
                                <a href="{{ route('createSupplier') }}"><span class="mx-3 ">{{__('sidebar.Add Supplier')}}</span></a>
                            @endif
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('businessSuppliers') || request()->routeIs('businessBuyers') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                            @if(auth()->user()->registration_type == "Supplier")
                                <a href="{{ route('businessBuyers') }}"><span class="mx-3 ">{{__('sidebar.List of Buyers')}}</span></a>
                            @elseif(auth()->user()->registration_type == "Buyer")
                                <a href="{{ route('businessSuppliers') }}"><span class="mx-3 ">{{__('sidebar.List of Suppliers')}}</span></a>
                            @endif
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Buyer Ratings link --}}
            @if(auth()->user()->hasRole('CEO') && Auth::user()->status == 3)
                @if(auth()->user()->registration_type == "Buyer")
                    <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('buyerRatingView') || request()->routeIs('buyerDeliveryRatingListIndex') || request()->routeIs('buyerRatedToDeliveries') || request()->routeIs('buyerUnRatedDeliveries') || request()->routeIs('deliveriesListToRate') || request()->routeIs('rateDelivery') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="{{ route('buyerRatingView') }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="none"
                                  d="M16.85,7.275l-3.967-0.577l-1.773-3.593c-0.208-0.423-0.639-0.69-1.11-0.69s-0.902,0.267-1.11,0.69L7.116,6.699L3.148,7.275c-0.466,0.068-0.854,0.394-1,0.842c-0.145,0.448-0.023,0.941,0.314,1.27l2.871,2.799l-0.677,3.951c-0.08,0.464,0.112,0.934,0.493,1.211c0.217,0.156,0.472,0.236,0.728,0.236c0.197,0,0.396-0.048,0.577-0.143l3.547-1.864l3.548,1.864c0.18,0.095,0.381,0.143,0.576,0.143c0.256,0,0.512-0.08,0.729-0.236c0.381-0.277,0.572-0.747,0.492-1.211l-0.678-3.951l2.871-2.799c0.338-0.329,0.459-0.821,0.314-1.27C17.705,7.669,17.316,7.343,16.85,7.275z M13.336,11.754l0.787,4.591l-4.124-2.167l-4.124,2.167l0.788-4.591L3.326,8.5l4.612-0.67l2.062-4.177l2.062,4.177l4.613,0.67L13.336,11.754z"></path>
                        </svg>
                        <span class="mx-3">{{__('sidebar.Ratings')}}</span>
                    </a>
                @endif
                @if(auth()->user()->registration_type == "Supplier")
                    <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('supplierRatingView') || request()->routeIs('supplierDeliveryRatingListIndex') || request()->routeIs('supplierDeliveryRatingViewByID') || request()->routeIs('supplierRatedToDeliveries') || request()->routeIs('deliveriesListToRate') || request()->routeIs('supplierUnRatedDeliveries') || request()->routeIs('supplierDeliveriesListToRate') || request()->routeIs('rateDeliveryBySupplier') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="{{ route('supplierRatingView') }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="none"
                                  d="M16.85,7.275l-3.967-0.577l-1.773-3.593c-0.208-0.423-0.639-0.69-1.11-0.69s-0.902,0.267-1.11,0.69L7.116,6.699L3.148,7.275c-0.466,0.068-0.854,0.394-1,0.842c-0.145,0.448-0.023,0.941,0.314,1.27l2.871,2.799l-0.677,3.951c-0.08,0.464,0.112,0.934,0.493,1.211c0.217,0.156,0.472,0.236,0.728,0.236c0.197,0,0.396-0.048,0.577-0.143l3.547-1.864l3.548,1.864c0.18,0.095,0.381,0.143,0.576,0.143c0.256,0,0.512-0.08,0.729-0.236c0.381-0.277,0.572-0.747,0.492-1.211l-0.678-3.951l2.871-2.799c0.338-0.329,0.459-0.821,0.314-1.27C17.705,7.669,17.316,7.343,16.85,7.275z M13.336,11.754l0.787,4.591l-4.124-2.167l-4.124,2.167l0.788-4.591L3.326,8.5l4.612-0.67l2.062-4.177l2.062,4.177l4.613,0.67L13.336,11.754z"></path>
                        </svg>
                        <span class="mx-3">{{__('sidebar.Ratings')}}</span>
                    </a>
                @endif
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
                <a href="{{ route('dashboard') }}"
                   @if(auth()->user()->hasRole('SuperAdmin'))  title=" {{__('sidebar.Super Admin Virtual office')}}"
                   @elseif(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer') title="{{__('sidebar.Buyer Virtual office')}}"
                   @elseif(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier') title="{{__('sidebar.Supplier Virtual office')}}"
                   @else
                   @php $roleName = auth()->user()->roles()->pluck('name'); @endphp
                   title="{{$roleName[0]}} {{ __('sidebar.Virtual office') }}"
                    @endif
                >
                <span class="text-white text-2xl mx-2 font-semibold">
                    {{ __('sidebar.Virtual office') }}
                </span>
                </a>
            </div>
        </div>

        <nav class="mt-10">
            {{--<a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dashboard') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="{{ route('dashboard') }}">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                </svg>
                <span class="mx-3">اللوحة الرئيسية</span>
            </a>--}}

            @if(auth()->user()->logistic_solution == 0)
                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dashboard') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('dashboard') }}">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="transform: scaleX(-1);">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Home') }}</span>
                </a>
            @endif


            @if(auth()->user()->logistic_solution == 1)
                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('logistics.dashboard') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('logistics.dashboard') }}">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="transform: scaleX(-1);">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                    <span class="mx-3">Home</span>
                </a>

                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('logistics.setting') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('logistics.setting') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="mx-3">Setting</span>
                </a>
            @endif

            {{-- Roles & Permissions--}}
            @if(auth()->user()->can('all'))

                {{-- Roles --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('role.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('role.index') }}">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Roles') }}</span>
                </a>

                {{-- Permissions --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('permission.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('permission.index') }}">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6.625 2.655A9 9 0 0119 11a1 1 0 11-2 0 7 7 0 00-9.625-6.492 1 1 0 11-.75-1.853zM4.662 4.959A1 1 0 014.75 6.37 6.97 6.97 0 003 11a1 1 0 11-2 0 8.97 8.97 0 012.25-5.953 1 1 0 011.412-.088z" clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M5 11a5 5 0 1110 0 1 1 0 11-2 0 3 3 0 10-6 0c0 1.677-.345 3.276-.968 4.729a1 1 0 11-1.838-.789A9.964 9.964 0 005 11zm8.921 2.012a1 1 0 01.831 1.145 19.86 19.86 0 01-.545 2.436 1 1 0 11-1.92-.558c.207-.713.371-1.445.49-2.192a1 1 0 011.144-.83z"
                              clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M10 10a1 1 0 011 1c0 2.236-.46 4.368-1.29 6.304a1 1 0 01-1.838-.789A13.952 13.952 0 009 11a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Permissions') }}</span>
                </a>
            @endif

            {{-- Business link --}}
            @if(auth()->user()->can('all') || auth()->user()->hasRole('Sales Specialist') || auth()->user()->hasRole('Legal Approval Officer 1') || auth()->user()->hasRole('Finance Officer 1') || auth()->user()->hasRole('SC Supervisor') || auth()->user()->hasRole('SC Specialist') || auth()->user()->hasRole('IT Admin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('business.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('business.index') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none"
                              d="M16.852,5.051h-4.018c0.131-0.225,0.211-0.482,0.211-0.761V3.528c0-0.841-0.682-1.522-1.521-1.522H8.478c-0.841,0-1.523,0.682-1.523,1.522V4.29c0,0.279,0.081,0.537,0.211,0.761H3.148c-0.841,0-1.522,0.682-1.522,1.523v9.897c0,0.842,0.682,1.523,1.522,1.523h13.704c0.842,0,1.523-0.682,1.523-1.523V6.574C18.375,5.733,17.693,5.051,16.852,5.051zM7.716,3.528c0-0.42,0.341-0.761,0.762-0.761h3.045c0.42,0,0.762,0.341,0.762,0.761V4.29c0,0.421-0.342,0.761-0.762,0.761H8.478c-0.42,0-0.762-0.34-0.762-0.761V3.528z M17.615,16.471c0,0.422-0.342,0.762-0.764,0.762H3.148c-0.42,0-0.761-0.34-0.761-0.762V9.62h15.228V16.471z M17.615,8.858H2.387V6.574c0-0.421,0.341-0.761,0.761-0.761h13.704c0.422,0,0.764,0.34,0.764,0.761V8.858z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Businesses') }}</span>
                </a>
            @endif

            {{-- Business Certificates update link --}}
            @if(auth()->user()->hasRole('Sales Specialist') || auth()->user()->hasRole('Legal Approval Officer 1') || auth()->user()->hasRole('Finance Officer 1') || auth()->user()->hasRole('SC Supervisor') || auth()->user()->hasRole('IT Admin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('certificates') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('certificates') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none"
                              d="M16.852,5.051h-4.018c0.131-0.225,0.211-0.482,0.211-0.761V3.528c0-0.841-0.682-1.522-1.521-1.522H8.478c-0.841,0-1.523,0.682-1.523,1.522V4.29c0,0.279,0.081,0.537,0.211,0.761H3.148c-0.841,0-1.522,0.682-1.522,1.523v9.897c0,0.842,0.682,1.523,1.522,1.523h13.704c0.842,0,1.523-0.682,1.523-1.523V6.574C18.375,5.733,17.693,5.051,16.852,5.051zM7.716,3.528c0-0.42,0.341-0.761,0.762-0.761h3.045c0.42,0,0.762,0.341,0.762,0.761V4.29c0,0.421-0.342,0.761-0.762,0.761H8.478c-0.42,0-0.762-0.34-0.762-0.761V3.528z M17.615,16.471c0,0.422-0.342,0.762-0.764,0.762H3.148c-0.42,0-0.761-0.34-0.761-0.762V9.62h15.228V16.471z M17.615,8.858H2.387V6.574c0-0.421,0.341-0.761,0.761-0.761h13.704c0.422,0,0.764,0.34,0.764,0.761V8.858z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Businesses Certificates') }}</span>
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
                    <span class="mx-3">{{ __('sidebar.IREs') }}</span>
                </a>

                {{-- Incomplete Business link --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('incompleteBusiness') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('incompleteBusiness') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Incomplete Registration') }}</span>
                </a>

                {{-- Downloads link --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('adminDownload') || request()->routeIs('adminDownloadCreate')|| request()->routeIs('adminDownloadEdit') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('adminDownload') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.634,10.633c0.116,0.113,0.265,0.168,0.414,0.168c0.153,0,0.308-0.06,0.422-0.177l4.015-4.111c0.229-0.235,0.225-0.608-0.009-0.836c-0.232-0.229-0.606-0.222-0.836,0.009l-3.604,3.689L6.35,5.772C6.115,5.543,5.744,5.55,5.514,5.781C5.285,6.015,5.29,6.39,5.522,6.617L9.634,10.633z"></path>
                        <path d="M17.737,9.815c-0.327,0-0.592,0.265-0.592,0.591v2.903H2.855v-2.903c0-0.327-0.264-0.591-0.591-0.591c-0.327,0-0.591,0.265-0.591,0.591V13.9c0,0.328,0.264,0.592,0.591,0.592h15.473c0.327,0,0.591-0.264,0.591-0.592v-3.494C18.328,10.08,18.064,9.815,17.737,9.815z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Downloads') }}</span>
                </a>

                {{-- Commission percentage link --}}
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('adminPercentage') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('adminPercentage') }}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.319,8.257c-0.242,0-0.438,0.196-0.438,0.438c0,0.243,0.196,0.438,0.438,0.438c0.242,0,0.438-0.196,0.438-0.438C4.757,8.454,4.561,8.257,4.319,8.257 M7.599,10.396c0,0.08,0.017,0.148,0.05,0.204c0.034,0.056,0.076,0.104,0.129,0.144c0.051,0.04,0.112,0.072,0.182,0.097c0.041,0.015,0.068,0.028,0.098,0.04V9.918C7.925,9.927,7.832,9.958,7.747,10.02C7.648,10.095,7.599,10.22,7.599,10.396 M15.274,6.505H1.252c-0.484,0-0.876,0.392-0.876,0.876v7.887c0,0.484,0.392,0.876,0.876,0.876h14.022c0.483,0,0.876-0.392,0.876-0.876V7.381C16.15,6.897,15.758,6.505,15.274,6.505M1.69,7.381c0.242,0,0.438,0.196,0.438,0.438S1.932,8.257,1.69,8.257c-0.242,0-0.438-0.196-0.438-0.438S1.448,7.381,1.69,7.381M1.69,15.269c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438c0.242,0,0.438,0.195,0.438,0.438S1.932,15.269,1.69,15.269M14.836,15.269c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438s0.438,0.195,0.438,0.438S15.078,15.269,14.836,15.269M15.274,13.596c-0.138-0.049-0.283-0.08-0.438-0.08c-0.726,0-1.314,0.589-1.314,1.314c0,0.155,0.031,0.301,0.08,0.438H2.924c0.049-0.138,0.081-0.283,0.081-0.438c0-0.726-0.589-1.314-1.315-1.314c-0.155,0-0.3,0.031-0.438,0.08V9.053C1.39,9.103,1.535,9.134,1.69,9.134c0.726,0,1.315-0.588,1.315-1.314c0-0.155-0.032-0.301-0.081-0.438h10.678c-0.049,0.137-0.08,0.283-0.08,0.438c0,0.726,0.589,1.314,1.314,1.314c0.155,0,0.301-0.031,0.438-0.081V13.596z M14.836,8.257c-0.242,0-0.438-0.196-0.438-0.438s0.196-0.438,0.438-0.438s0.438,0.196,0.438,0.438S15.078,8.257,14.836,8.257 M12.207,13.516c-0.242,0-0.438,0.196-0.438,0.438s0.196,0.438,0.438,0.438s0.438-0.196,0.438-0.438S12.449,13.516,12.207,13.516 M8.812,11.746c-0.059-0.043-0.126-0.078-0.199-0.104c-0.047-0.017-0.081-0.031-0.117-0.047v1.12c0.137-0.021,0.237-0.064,0.336-0.143c0.116-0.09,0.174-0.235,0.174-0.435c0-0.092-0.018-0.17-0.053-0.233C8.918,11.842,8.87,11.788,8.812,11.746 M18.78,3.875H4.757c-0.484,0-0.876,0.392-0.876,0.876V5.19c0,0.242,0.196,0.438,0.438,0.438c0.242,0,0.438-0.196,0.438-0.438V4.752H18.78v7.888h-1.315c-0.242,0-0.438,0.196-0.438,0.438c0,0.243,0.195,0.438,0.438,0.438h1.315c0.483,0,0.876-0.393,0.876-0.876V4.752C19.656,4.268,19.264,3.875,18.78,3.875 M8.263,8.257c-1.694,0-3.067,1.374-3.067,3.067c0,1.695,1.373,3.068,3.067,3.068c1.695,0,3.067-1.373,3.067-3.068C11.33,9.631,9.958,8.257,8.263,8.257 M9.488,12.543c-0.062,0.137-0.147,0.251-0.255,0.342c-0.108,0.092-0.234,0.161-0.378,0.209c-0.123,0.041-0.229,0.063-0.359,0.075v0.347H8.058v-0.347c-0.143-0.009-0.258-0.032-0.388-0.078c-0.152-0.053-0.281-0.128-0.388-0.226c-0.108-0.098-0.191-0.217-0.25-0.359c-0.059-0.143-0.087-0.307-0.083-0.492h0.575c-0.004,0.219,0.046,0.391,0.146,0.518c0.088,0.109,0.207,0.165,0.388,0.185v-1.211c-0.102-0.031-0.189-0.067-0.3-0.109c-0.136-0.051-0.259-0.116-0.368-0.198c-0.109-0.082-0.198-0.183-0.265-0.306c-0.067-0.123-0.101-0.275-0.101-0.457c0-0.159,0.031-0.298,0.093-0.419c0.062-0.121,0.146-0.222,0.252-0.303S7.597,9.57,7.735,9.527C7.85,9.491,7.944,9.474,8.058,9.468V9.134h0.438v0.333c0.114,0.005,0.207,0.021,0.319,0.054c0.134,0.04,0.251,0.099,0.351,0.179c0.099,0.079,0.178,0.18,0.237,0.303c0.059,0.122,0.088,0.265,0.088,0.427H8.916c-0.007-0.169-0.051-0.297-0.134-0.387C8.712,9.968,8.626,9.932,8.496,9.919v1.059c0.116,0.035,0.213,0.074,0.333,0.118c0.145,0.053,0.272,0.121,0.383,0.203c0.111,0.083,0.2,0.186,0.268,0.308c0.067,0.123,0.101,0.273,0.101,0.453C9.581,12.244,9.549,12.406,9.488,12.543"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Commission percentage') }}</span>
                </a>

            @endif

            {{-- Super Admin Ratings link --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('ratingView') || request()->routeIs('ratingListIndex') || request()->routeIs('ratingViewByID') || request()->routeIs('emdadRated') || request()->routeIs('emdadRatedViewByID') || request()->routeIs('emdadUnRated') || request()->routeIs('buyerRated') || request()->routeIs('supplierRated') || request()->routeIs('buyerList') || request()->routeIs('rateBuyer') || request()->routeIs('supplierList') || request()->routeIs('rateSupplier') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('ratingView') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none"
                              d="M16.85,7.275l-3.967-0.577l-1.773-3.593c-0.208-0.423-0.639-0.69-1.11-0.69s-0.902,0.267-1.11,0.69L7.116,6.699L3.148,7.275c-0.466,0.068-0.854,0.394-1,0.842c-0.145,0.448-0.023,0.941,0.314,1.27l2.871,2.799l-0.677,3.951c-0.08,0.464,0.112,0.934,0.493,1.211c0.217,0.156,0.472,0.236,0.728,0.236c0.197,0,0.396-0.048,0.577-0.143l3.547-1.864l3.548,1.864c0.18,0.095,0.381,0.143,0.576,0.143c0.256,0,0.512-0.08,0.729-0.236c0.381-0.277,0.572-0.747,0.492-1.211l-0.678-3.951l2.871-2.799c0.338-0.329,0.459-0.821,0.314-1.27C17.705,7.669,17.316,7.343,16.85,7.275z M13.336,11.754l0.787,4.591l-4.124-2.167l-4.124,2.167l0.788-4.591L3.326,8.5l4.612-0.67l2.062-4.177l2.062,4.177l4.613,0.67L13.336,11.754z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Ratings') }}</span>
                </a>
            @endif

            {{-- RFQs link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))

                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{route('smsMessages.index')}}">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.SMS') }}</span>
                </a>

                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.RFQs') }}</span>
                </a>
            @endif

            {{-- RFQs link for Buyer --}}
            @if(auth()->user()->can('Buyer Create New RFQ') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer' && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('rfqView') || request()->routeIs('RFQ.create')|| request()->routeIs('RFQCart.index')|| request()->routeIs('PlacedRFQ.index')|| request()->routeIs('create_single_rfq')|| request()->routeIs('single_cart_index')|| request()->routeIs('single_category_rfq_index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('rfqView') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        {{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
                    </svg>
                    <span class="mx-3">{{ __('sidebar.RFQs') }}</span>
                </a>

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

            {{-- Qoutations link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3 font-extrabold">{{ __('sidebar.Quotations') }}</span>
                </a>
            @endif

            {{-- Qoutations (Supplier) link --}}
            @if(auth()->user()->can('Supplier View New RFQs')|| auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true" class="flex items-center mt-4 py-2 px-6
                            {{ request()->routeIs('viewRFQs') || request()->routeIs('singleCategoryRFQs') || request()->routeIs('singleCategoryQuotedRFQQuoted')||
                            request()->routeIs('singleCategoryQuotedRFQRejected')|| request()->routeIs('singleCategoryQuotedRFQModificationNeeded')||
                            request()->routeIs('singleCategoryQuotedRFQPendingConfirmation') || request()->routeIs('singleCategoryQuotedModifiedRFQ') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}
                        hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.627,7.885C8.499,8.388,7.873,8.101,8.13,8.177L4.12,7.143c-0.218-0.057-0.351-0.28-0.293-0.498c0.057-0.218,0.279-0.351,0.497-0.294l4.011,1.037C8.552,7.444,8.685,7.667,8.627,7.885 M8.334,10.123L4.323,9.086C4.105,9.031,3.883,9.162,3.826,9.38C3.769,9.598,3.901,9.82,4.12,9.877l4.01,1.037c-0.262-0.062,0.373,0.192,0.497-0.294C8.685,10.401,8.552,10.18,8.334,10.123 M7.131,12.507L4.323,11.78c-0.218-0.057-0.44,0.076-0.497,0.295c-0.057,0.218,0.075,0.439,0.293,0.495l2.809,0.726c-0.265-0.062,0.37,0.193,0.495-0.293C7.48,12.784,7.35,12.562,7.131,12.507M18.159,3.677v10.701c0,0.186-0.126,0.348-0.306,0.393l-7.755,1.948c-0.07,0.016-0.134,0.016-0.204,0l-7.748-1.948c-0.179-0.045-0.306-0.207-0.306-0.393V3.677c0-0.267,0.249-0.461,0.509-0.396l7.646,1.921l7.654-1.921C17.91,3.216,18.159,3.41,18.159,3.677 M9.589,5.939L2.656,4.203v9.857l6.933,1.737V5.939z M17.344,4.203l-6.939,1.736v9.859l6.939-1.737V4.203z M16.168,6.645c-0.058-0.218-0.279-0.351-0.498-0.294l-4.011,1.037c-0.218,0.057-0.351,0.28-0.293,0.498c0.128,0.503,0.755,0.216,0.498,0.292l4.009-1.034C16.092,7.085,16.225,6.863,16.168,6.645 M16.168,9.38c-0.058-0.218-0.279-0.349-0.498-0.294l-4.011,1.036c-0.218,0.057-0.351,0.279-0.293,0.498c0.124,0.486,0.759,0.232,0.498,0.294l4.009-1.037C16.092,9.82,16.225,9.598,16.168,9.38 M14.963,12.385c-0.055-0.219-0.276-0.35-0.495-0.294l-2.809,0.726c-0.218,0.056-0.351,0.279-0.293,0.496c0.127,0.506,0.755,0.218,0.498,0.293l2.807-0.723C14.89,12.825,15.021,12.603,14.963,12.385"></path>
                        </svg>
                        <span class="mx-3 font-extrabold">{{ __('sidebar.Quotations') }}</span>
                        <span x-show="open == false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 1.3em;" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                        </span>
                        <span x-show="open == true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 1.3em;" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    </a>

                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('viewRFQs') || request()->routeIs('singleCategoryRFQs') || request()->routeIs('singleCategoryQuotedRFQQuoted') || request()->routeIs('singleCategoryQuotedRFQRejected') || request()->routeIs('singleCategoryQuotedRFQModificationNeeded') || request()->routeIs('singleCategoryQuotedRFQPendingConfirmation') || request()->routeIs('singleCategoryQuotedModifiedRFQ') )  x-data="{ open: true } " @endif--}}
                    >
                        @php
                            $business_cate = \App\Models\BusinessCategory::where('business_id', auth()->user()->business_id)->get();
                            if ($business_cate->isNotEmpty()) {
                                foreach ($business_cate as $item) {
                                    $business_categories[] = (int)$item->category_number;
                                }
                            }
                            sort($business_categories);
                            // Counting NEW RFQs for multiple categories for supplier
                            $multiEOrderItems = \App\Models\EOrderItems::where(['status' => 'pending', 'rfq_type' => 1])->where('bypass', 0)->whereDate('quotation_time', '>=', \Carbon\Carbon::now())->whereIn('item_code', $business_categories)->get();
                            $noMultiCategoryQuotationPresent = array();
                            foreach ($multiEOrderItems as $multiEOrderItem)
                                {
                                    $quotes = \App\Models\Qoute::where(['e_order_items_id' => $multiEOrderItem->id, 'supplier_business_id' => auth()->user()->business_id])->first();
                                        if (!($quotes))
                                            {
                                                $noMultiCategoryQuotationPresent[] = $multiEOrderItem->id;
                                            }
                                }
                            // Counting NEW RFQs for single category for supplier
                            $eOrderItems = \App\Models\EOrderItems::where(['status' => 'pending', 'rfq_type' => 0])
                                                                            ->where('bypass', 0)
                                                                            ->whereDate('quotation_time', '>=', \Carbon\Carbon::now())
                                                                            ->whereIn('item_code', $business_categories)
                                                                            ->get();
                            $eOrders = array();
                            foreach ($eOrderItems as $eOrderItem)
                            {
                                $eOrderPresent[] = \App\Models\EOrders::where(['id' => $eOrderItem->e_order_id])->first();
                                $eOrders = $eOrderPresent;
                            }
                            $quotesNotPresent = array(); /* For saving and counting eOrders having no Quotes */
                            if (count($eOrders) > 0)
                            {
                                foreach($eOrders as $eOrder)
                                    {
                                        $quotes = \App\Models\Qoute::where(['e_order_id' => $eOrder->id, 'supplier_business_id' => auth()->user()->business_id])->first();
                                        if (!($quotes))
                                            {
                                                $quotesNotPresent[] = $eOrder->id;
                                            }
                                    }
                            }
                        @endphp
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('viewRFQs') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('viewRFQs') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('viewRFQs') ? 'text-white' : 'text-gray-500' }}">{{ __('sidebar.Multi categories') }} ({{count($noMultiCategoryQuotationPresent)}})</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryRFQs') ||request()->routeIs('singleCategoryQuotedRFQQuoted') ||request()->routeIs('singleCategoryQuotedRFQRejected') ||request()->routeIs('singleCategoryQuotedRFQModificationNeeded') ||request()->routeIs('singleCategoryQuotedRFQPendingConfirmation') ||request()->routeIs('singleCategoryQuotedModifiedRFQ') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('singleCategoryRFQs') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('singleCategoryRFQs') ? 'text-white' : 'text-gray-500' }}">{{ __('sidebar.Single category') }} @if(count($eOrders) > 0 && count($quotesNotPresent) > 0) ({{count(array_unique($quotesNotPresent))}}) @else (0) @endif </span></a>
                        </li>
                    </ul>
                </div>
            @endif

            {{-- Qoutations (Buyer) link --}}
            @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Buyer' && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('QoutationsBuyerReceived') || request()->routeIs('singleCategoryBuyerRFQs') || request()->routeIs('singleCategoryRFQItems') || request()->routeIs('singleCategoryRFQQuotationsBuyerReceived') || request()->routeIs('singleCategoryRFQQuotationsBuyerRejected') || request()->routeIs('singleCategoryRFQQuotationsModificationNeeded') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.627,7.885C8.499,8.388,7.873,8.101,8.13,8.177L4.12,7.143c-0.218-0.057-0.351-0.28-0.293-0.498c0.057-0.218,0.279-0.351,0.497-0.294l4.011,1.037C8.552,7.444,8.685,7.667,8.627,7.885 M8.334,10.123L4.323,9.086C4.105,9.031,3.883,9.162,3.826,9.38C3.769,9.598,3.901,9.82,4.12,9.877l4.01,1.037c-0.262-0.062,0.373,0.192,0.497-0.294C8.685,10.401,8.552,10.18,8.334,10.123 M7.131,12.507L4.323,11.78c-0.218-0.057-0.44,0.076-0.497,0.295c-0.057,0.218,0.075,0.439,0.293,0.495l2.809,0.726c-0.265-0.062,0.37,0.193,0.495-0.293C7.48,12.784,7.35,12.562,7.131,12.507M18.159,3.677v10.701c0,0.186-0.126,0.348-0.306,0.393l-7.755,1.948c-0.07,0.016-0.134,0.016-0.204,0l-7.748-1.948c-0.179-0.045-0.306-0.207-0.306-0.393V3.677c0-0.267,0.249-0.461,0.509-0.396l7.646,1.921l7.654-1.921C17.91,3.216,18.159,3.41,18.159,3.677 M9.589,5.939L2.656,4.203v9.857l6.933,1.737V5.939z M17.344,4.203l-6.939,1.736v9.859l6.939-1.737V4.203z M16.168,6.645c-0.058-0.218-0.279-0.351-0.498-0.294l-4.011,1.037c-0.218,0.057-0.351,0.28-0.293,0.498c0.128,0.503,0.755,0.216,0.498,0.292l4.009-1.034C16.092,7.085,16.225,6.863,16.168,6.645 M16.168,9.38c-0.058-0.218-0.279-0.349-0.498-0.294l-4.011,1.036c-0.218,0.057-0.351,0.279-0.293,0.498c0.124,0.486,0.759,0.232,0.498,0.294l4.009-1.037C16.092,9.82,16.225,9.598,16.168,9.38 M14.963,12.385c-0.055-0.219-0.276-0.35-0.495-0.294l-2.809,0.726c-0.218,0.056-0.351,0.279-0.293,0.496c0.127,0.506,0.755,0.218,0.498,0.293l2.807-0.723C14.89,12.825,15.021,12.603,14.963,12.385"></path>
                        </svg>
                        <span class="mx-3 font-extrabold">{{__('sidebar.Quotations')}}</span>
                        <span x-show="open == false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 1.3em;" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                        </span>
                        <span x-show="open == true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 1.3em;" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    </a>

                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('QoutationsBuyerReceived') || request()->routeIs('singleCategoryBuyerRFQs') || request()->routeIs('singleCategoryRFQItems') || request()->routeIs('singleCategoryRFQQuotationsBuyerReceived') || request()->routeIs('singleCategoryRFQQuotationsBuyerRejected') || request()->routeIs('singleCategoryRFQQuotationsModificationNeeded'))  x-data="{ open: true } " @endif--}}
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('QoutationsBuyerReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            @php
                                $multiPlacedRFQ = \App\Models\Qoute::where(['business_id' => auth()->user()->business_id, 'status' => 'pending' ,'rfq_type' => 1])->count();
                            @endphp
                            <a href="{{ route('QoutationsBuyerReceived') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('QoutationsBuyerReceived') ? 'text-white' : 'text-gray-500' }}">{{ __('sidebar.Multi categories') }} ({{$multiPlacedRFQ}})</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryBuyerRFQs') || request()->routeIs('singleCategoryRFQItems') || request()->routeIs('singleCategoryRFQQuotationsBuyerReceived') || request()->routeIs('singleCategoryRFQQuotationsBuyerRejected') || request()->routeIs('singleCategoryRFQQuotationsModificationNeeded') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            @php
                                $singlePlacedRFQ = \App\Models\Qoute::where(['business_id' => auth()->user()->business_id, 'status' => 'pending' ,'rfq_type' => 0])->get();
                            @endphp
                            <a href="{{ route('singleCategoryBuyerRFQs') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('singleCategoryBuyerRFQs') ? 'text-white' : 'text-gray-500' }}">{{ __('sidebar.Single category') }} ({{count($singlePlacedRFQ->unique('e_order_id'))}})</span></a>
                        </li>
                    </ul>
                </div>
            @endif

            {{-- Purchase Order for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Purchase Order') }}</span>
                </a>
            @endif

            {{-- Purchase Order link --}}
            @if(auth()->user()->can('Buyer DPO Approval') || auth()->user()->can('Buyer View Purchase Orders') || auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('purchaseOrderView') ||request()->routeIs('dpo.index') ||request()->routeIs('singleCategoryDPOIndex') ||request()->routeIs('singleCategoryIndex') ||request()->routeIs('singleCategoryPO') || request()->routeIs('po.po') || request()->routeIs('singleCategoryPO') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('purchaseOrderView') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="transform: scaleX(-1);">
                        <path fill="none"
                              d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                        <path fill="none"
                              d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                        <path fill="none"
                              d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Purchase Order') }}</span>
                </a>
            @endif

            {{-- Delivery link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Delivery Note') }}</span>
                </a>
            @endif

            {{-- Delivery link --}}
            @if(auth()->user()->hasRole('CEO')  && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('deliveryView') ||request()->routeIs('deliveryNote.index') ||request()->routeIs('notes') ||request()->routeIs('singleCategoryIndex') ||request()->routeIs('singleCategoryNotes') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('deliveryView') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.638,6.181h-3.844C13.581,4.273,11.963,2.786,10,2.786c-1.962,0-3.581,1.487-3.793,3.395H2.362c-0.233,0-0.424,0.191-0.424,0.424v10.184c0,0.232,0.191,0.424,0.424,0.424h15.276c0.234,0,0.425-0.191,0.425-0.424V6.605C18.062,6.372,17.872,6.181,17.638,6.181 M13.395,9.151c0.234,0,0.425,0.191,0.425,0.424S13.629,10,13.395,10c-0.232,0-0.424-0.191-0.424-0.424S13.162,9.151,13.395,9.151 M10,3.635c1.493,0,2.729,1.109,2.936,2.546H7.064C7.271,4.744,8.506,3.635,10,3.635 M6.605,9.151c0.233,0,0.424,0.191,0.424,0.424S6.838,10,6.605,10c-0.233,0-0.424-0.191-0.424-0.424S6.372,9.151,6.605,9.151 M17.214,16.365H2.786V7.029h3.395v1.347C5.687,8.552,5.332,9.021,5.332,9.575c0,0.703,0.571,1.273,1.273,1.273c0.702,0,1.273-0.57,1.273-1.273c0-0.554-0.354-1.023-0.849-1.199V7.029h5.941v1.347c-0.495,0.176-0.849,0.645-0.849,1.199c0,0.703,0.57,1.273,1.272,1.273s1.273-0.57,1.273-1.273c0-0.554-0.354-1.023-0.849-1.199V7.029h3.395V16.365z"></path>
                    </svg>
                    <span class="mx-3">{{ __('sidebar.Delivery Note') }}</span>
                </a>

            @endif

            {{-- Shipments link for SuperAdmin --}}
            @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('#') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}   hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="javascript:void(0)">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="mx-3 font-extrabold">{{__('sidebar.Shipments')}}</span>
                </a>
            @endif

            {{-- Supplier Shipments link --}}
            @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Supplier" && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.create') || request()->routeIs('shipment.index')|| request()->routeIs('shipmentCart.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             class="w-6 h-6"
                             viewBox="0 0 172 172"
                             style=" fill:#000000;transform: scaleX(-1);">
                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none"
                               style="mix-blend-mode: normal">
                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                <g fill="currentColor">
                                    <path
                                        d="M24.72553,59.66303c-2.28438,0 -4.03125,1.74688 -4.03125,4.03125v80.625c0,2.28438 1.74687,4.03125 4.03125,4.03125h10.21197c0,0.5375 -0.13385,0.9401 -0.13385,1.4776c0,3.225 0.94115,6.3151 2.55365,8.86823h-13.1698c-2.28438,0 -4.03125,1.74687 -4.03125,4.03125c0,2.28438 1.74687,4.03125 4.03125,4.03125h113.41302c0.40312,0 0.94063,-0.13333 1.34375,-0.2677c8.6,-0.67187 15.45313,-7.92865 15.45313,-16.66302c0,-0.5375 0.00052,-0.9401 -0.13385,-1.4776h10.34583c2.28438,0 4.03125,-1.74687 4.03125,-4.03125v-47.03125v-0.27032v-0.5354c0,-0.13437 0.00052,-0.13595 -0.13385,-0.27032c0,-0.13437 -0.13385,-0.26718 -0.13385,-0.40155l-8.46667,-21.09845c-3.62813,-9.1375 -12.3625,-14.91457 -22.17187,-15.04895h-13.4375c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v76.59375h-54.82605c-1.075,-1.6125 -2.41665,-2.95625 -3.89478,-4.03125h50.79218c2.28438,0 4.03125,-1.74687 4.03125,-4.03125v-68.53125c0,-2.28437 -1.74687,-4.03125 -4.03125,-4.03125zM28.75678,67.59167h79.4151v47.03125h-79.4151zM128.46197,67.59167h5.375v22.84375c0,1.88125 1.21042,3.49165 3.09167,3.89478l23.78333,5.91302v39.91095h-9.13593c-3.09062,-4.43437 -8.06355,-7.25677 -13.84167,-7.25677c-3.35937,0 -6.5849,1.07447 -9.2724,2.82135zM141.89948,68.12708c4.8375,1.20937 8.7349,4.70313 10.61615,9.40625l5.50885,13.84167l-16.125,-4.03125zM28.89063,136.12292h12.89947c-1.47812,1.075 -2.8224,2.41875 -3.8974,4.03125h-9.00208zM51.60053,140.68958c3.225,0 6.17968,1.74792 7.79218,4.43542c0.13437,0.67188 0.40522,1.20833 0.80835,1.61145c0.26875,0.94063 0.5354,2.0172 0.5354,2.95782c0,4.43437 -3.225,8.06198 -7.39062,8.86823h-3.35937c-4.16563,-0.80625 -7.39062,-4.43385 -7.39062,-8.86823c0,-4.97188 4.03282,-9.0047 9.0047,-9.0047zM137.46667,140.68958c4.97188,0 9.00208,4.03282 9.00208,9.0047c0.26875,4.70313 -3.3599,8.46458 -7.92865,9.00208c-0.26875,-0.13438 -0.53645,-0.13385 -0.93958,-0.13385h-1.74792c-4.16563,-0.80625 -7.39063,-4.43385 -7.39063,-8.86823c0,-4.97188 4.03282,-9.0047 9.0047,-9.0047zM68.26355,148.21667h52.67395c0,0.5375 -0.13385,0.9401 -0.13385,1.4776c0,3.225 0.94115,6.3151 2.55365,8.86823h-57.51355c1.6125,-2.55312 2.55365,-5.64323 2.55365,-8.86823c0,-0.5375 0.00052,-0.9401 -0.13385,-1.4776zM6.71875,158.66223c-1.04141,0 -2.08229,0.3711 -2.82135,1.11017c-0.80625,0.67188 -1.2099,1.74635 -1.2099,2.82135c0,1.075 0.40365,2.14948 1.2099,2.82135c0.80625,0.80625 1.74635,1.2099 2.82135,1.2099c1.075,0 2.14948,-0.40365 2.82135,-1.2099c0.80625,-0.80625 1.2099,-1.74635 1.2099,-2.82135c0,-1.075 -0.40365,-2.14948 -1.2099,-2.82135c-0.73906,-0.73906 -1.77994,-1.11017 -2.82135,-1.11017z"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="mx-3 font-extrabold">{{__('sidebar.Shipments')}}</span>
                        <span x-show="open == false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 3.6em;" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                        </span>
                        <span x-show="open == true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 3.6em;" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    </a>
                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('shipment.create') || request()->routeIs('shipmentCart.index')|| request()->routeIs('shipment.index'))  x-data="{ open: true } " @endif--}}
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipment.create') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('shipment.create') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Generate') }}</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipmentCart.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipmentCart.index') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('shipmentCart.index') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Cart')}}
                                    @if (\App\Models\ShipmentCart::where('supplier_business_id', auth()->user()->business_id)
                                    ->count())
                                        ({{ \App\Models\ShipmentCart::where('supplier_business_id', auth()->user()->business_id)->count() }})
                                    @endif</span>
                            </a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipment.index') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('shipment.index') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Placed Shipments')}}</span></a>
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Payments link for SuperAdmin && Finance Officer --}}
            @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('Finance Officer 1'))
                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdad_payments') || request()->routeIs('supplier_payment') || request()->routeIs('emdadInvoices') || request()->routeIs('singleCategoryPayments') || request()->routeIs('singleCategorySupplierPayment') || request()->routeIs('singleCategoryEmdadInvoicesIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="none"
                                  d="M5.229,6.531H4.362c-0.239,0-0.434,0.193-0.434,0.434c0,0.239,0.194,0.434,0.434,0.434h0.868c0.24,0,0.434-0.194,0.434-0.434C5.663,6.724,5.469,6.531,5.229,6.531 M10,6.531c-1.916,0-3.47,1.554-3.47,3.47c0,1.916,1.554,3.47,3.47,3.47c1.916,0,3.47-1.555,3.47-3.47C13.47,8.084,11.916,6.531,10,6.531 M11.4,11.447c-0.071,0.164-0.169,0.299-0.294,0.406c-0.124,0.109-0.27,0.191-0.437,0.248c-0.167,0.057-0.298,0.09-0.492,0.098v0.402h-0.35v-0.402c-0.21-0.004-0.352-0.039-0.527-0.1c-0.175-0.064-0.324-0.154-0.449-0.27c-0.124-0.115-0.221-0.258-0.288-0.428c-0.068-0.17-0.1-0.363-0.096-0.583h0.664c-0.004,0.259,0.052,0.464,0.169,0.613c0.116,0.15,0.259,0.229,0.527,0.236v-1.427c-0.159-0.043-0.268-0.095-0.425-0.156c-0.157-0.061-0.299-0.139-0.425-0.235C8.852,9.752,8.75,9.631,8.672,9.486C8.594,9.34,8.556,9.16,8.556,8.944c0-0.189,0.036-0.355,0.108-0.498c0.072-0.144,0.169-0.264,0.292-0.36c0.122-0.097,0.263-0.17,0.422-0.221c0.159-0.052,0.277-0.077,0.451-0.077V7.401h0.35v0.387c0.174,0,0.29,0.023,0.445,0.071c0.155,0.047,0.29,0.118,0.404,0.212c0.115,0.095,0.206,0.215,0.274,0.359c0.067,0.146,0.103,0.315,0.103,0.508H10.74c-0.007-0.201-0.06-0.354-0.154-0.46c-0.096-0.106-0.199-0.159-0.408-0.159v1.244c0.174,0.047,0.296,0.102,0.462,0.165c0.167,0.063,0.314,0.144,0.443,0.241c0.128,0.099,0.23,0.221,0.309,0.366c0.077,0.146,0.116,0.324,0.116,0.536C11.509,11.092,11.473,11.283,11.4,11.447 M18.675,4.795H1.326c-0.479,0-0.868,0.389-0.868,0.868v8.674c0,0.479,0.389,0.867,0.868,0.867h17.349c0.479,0,0.867-0.389,0.867-0.867V5.664C19.542,5.184,19.153,4.795,18.675,4.795M1.76,5.664c0.24,0,0.434,0.193,0.434,0.434C2.193,6.336,2,6.531,1.76,6.531S1.326,6.336,1.326,6.097C1.326,5.857,1.52,5.664,1.76,5.664 M1.76,14.338c-0.24,0-0.434-0.195-0.434-0.434c0-0.24,0.194-0.434,0.434-0.434s0.434,0.193,0.434,0.434C2.193,14.143,2,14.338,1.76,14.338 M18.241,14.338c-0.24,0-0.435-0.195-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,14.143,18.48,14.338,18.241,14.338 M18.675,12.682c-0.137-0.049-0.281-0.08-0.434-0.08c-0.719,0-1.302,0.584-1.302,1.303c0,0.152,0.031,0.297,0.08,0.434H2.981c0.048-0.137,0.08-0.281,0.08-0.434c0-0.719-0.583-1.303-1.301-1.303c-0.153,0-0.297,0.031-0.434,0.08V7.318c0.136,0.049,0.28,0.08,0.434,0.08c0.718,0,1.301-0.583,1.301-1.301c0-0.153-0.032-0.298-0.08-0.434H17.02c-0.049,0.136-0.08,0.28-0.08,0.434c0,0.718,0.583,1.301,1.302,1.301c0.152,0,0.297-0.031,0.434-0.08V12.682z M18.241,6.531c-0.24,0-0.435-0.194-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,6.336,18.48,6.531,18.241,6.531 M9.22,8.896c0,0.095,0.019,0.175,0.058,0.242c0.039,0.066,0.088,0.124,0.148,0.171c0.061,0.047,0.13,0.086,0.21,0.115c0.079,0.028,0.11,0.055,0.192,0.073V8.319c-0.21,0-0.322,0.044-0.437,0.132C9.277,8.54,9.22,8.688,9.22,8.896 M15.639,12.602h-0.868c-0.239,0-0.434,0.195-0.434,0.434c0,0.24,0.194,0.436,0.434,0.436h0.868c0.24,0,0.434-0.195,0.434-0.436C16.072,12.797,15.879,12.602,15.639,12.602 M10.621,10.5c-0.068-0.052-0.145-0.093-0.23-0.124c-0.086-0.031-0.123-0.06-0.212-0.082v1.374c0.209-0.016,0.332-0.076,0.465-0.186c0.134-0.107,0.201-0.281,0.201-0.516c0-0.11-0.02-0.202-0.062-0.277C10.743,10.615,10.688,10.551,10.621,10.5"></path>
                        </svg>
                        <span class="mx-3">{{__('sidebar.Payments')}}</span>
                        <span x-show="open == false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 4em;" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                        </span>
                        <span x-show="open == true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 4em;" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    </a>
                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('emdad_payments') || request()->routeIs('supplier_payment') || request()->routeIs('emdadInvoices') || request()->routeIs('singleCategoryPayments') || request()->routeIs('singleCategorySupplierPayment') || request()->routeIs('singleCategoryEmdadInvoicesIndex'))  x-data="{ open: true } " @endif--}}
                    >
                        {{-- Multi Categories Routes --}}
                        <div x-data="{ open: false } ">
                            <a @click="open = true"
                               class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdad_payments') || request()->routeIs('supplier_payment')|| request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                               href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: scaleX(-1);;" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/>
                                </svg>
                                <span class="mx-3">{{__('sidebar.Multi categories')}}</span>
                                <span x-show="open == false">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                </span>
                                <span x-show="open == true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            </a>
                            <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('emdad_payments') || request()->routeIs('supplier_payment')|| request()->routeIs('emdadInvoices'))  x-data="{ open: true } " @endif>
                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdad_payments') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('emdad_payments') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('emdad_payments') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Manual Payments')}}</span></a>
                                </li>

                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('supplier_payment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('supplier_payment') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('supplier_payment') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Payments to supplier')}}</span></a>
                                </li>

                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('emdadInvoices') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('emdadInvoices') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('emdadInvoices') ? 'text-white' : 'text-gray-500' }}">{{ __('sidebar.Emdad Invoices') }}</span></a>
                                </li>
                            </ul>
                        </div>

                        {{-- Single Category Routes --}}
                        <div x-data="{ open: false } ">
                            <a @click="open = true"
                               class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryPayments') || request()->routeIs('singleCategorySupplierPayment') || request()->routeIs('singleCategoryEmdadInvoicesIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                               href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: scaleX(-1);;" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path d="M19 15l-6 6l-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z" fill="currentColor"/>
                                </svg>
                                <span class="mx-3">{{__('sidebar.Single category')}}</span>
                                <span x-show="open == false">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                </span>
                                <span x-show="open == true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 1.2em;" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            </a>
                            <ul x-show.transition.in.duration.50ms.out.duration.100ms="open" @if(request()->routeIs('singleCategoryPayments') || request()->routeIs('singleCategorySupplierPayment') || request()->routeIs('singleCategoryEmdadInvoicesIndex'))  x-data="{ open: true } " @endif>
                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryPayments') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('singleCategoryPayments') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('singleCategoryPayments') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Manual Payments')}}</span></a>
                                </li>

                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategorySupplierPayment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('singleCategorySupplierPayment') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('singleCategorySupplierPayment') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Payments to supplier')}}</span></a>
                                </li>

                                <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('singleCategoryEmdadInvoicesIndex') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                    </svg>
                                    <a href="{{ route('singleCategoryEmdadInvoicesIndex') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('singleCategoryEmdadInvoicesIndex') ? 'text-white' : 'text-gray-500' }}">{{ __('sidebar.Emdad Invoices') }}</span></a>
                                </li>
                            </ul>
                        </div>

                    </ul>
                </div>
            @endif

            {{-- Payments link --}}
            @if(auth()->user()->hasRole('CEO')  && Auth::user()->status == 3)

                <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('paymentView') ||request()->routeIs('payment.index') || request()->routeIs('generate_proforma_invoices')|| request()->routeIs('invoices')|| request()->routeIs('bank-payments.index')|| request()->routeIs('proforma_invoices')|| request()->routeIs('emdadInvoices')|| request()->routeIs('supplier_payment_received') || request()->routeIs('singleCategoryPaymentIndex') || request()->routeIs('singleCategoryGenerateProformaInvoiceView')|| request()->routeIs('singleCategoryInvoices')|| request()->routeIs('singleCategoryBankPaymentIndex')|| request()->routeIs('singleCategoryProformaInvoices')|| request()->routeIs('singleCategoryEmdadInvoicesIndex')|| request()->routeIs('singleCategorySupplierPaymentsReceived') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                   href="{{ route('paymentView') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none"
                              d="M5.229,6.531H4.362c-0.239,0-0.434,0.193-0.434,0.434c0,0.239,0.194,0.434,0.434,0.434h0.868c0.24,0,0.434-0.194,0.434-0.434C5.663,6.724,5.469,6.531,5.229,6.531 M10,6.531c-1.916,0-3.47,1.554-3.47,3.47c0,1.916,1.554,3.47,3.47,3.47c1.916,0,3.47-1.555,3.47-3.47C13.47,8.084,11.916,6.531,10,6.531 M11.4,11.447c-0.071,0.164-0.169,0.299-0.294,0.406c-0.124,0.109-0.27,0.191-0.437,0.248c-0.167,0.057-0.298,0.09-0.492,0.098v0.402h-0.35v-0.402c-0.21-0.004-0.352-0.039-0.527-0.1c-0.175-0.064-0.324-0.154-0.449-0.27c-0.124-0.115-0.221-0.258-0.288-0.428c-0.068-0.17-0.1-0.363-0.096-0.583h0.664c-0.004,0.259,0.052,0.464,0.169,0.613c0.116,0.15,0.259,0.229,0.527,0.236v-1.427c-0.159-0.043-0.268-0.095-0.425-0.156c-0.157-0.061-0.299-0.139-0.425-0.235C8.852,9.752,8.75,9.631,8.672,9.486C8.594,9.34,8.556,9.16,8.556,8.944c0-0.189,0.036-0.355,0.108-0.498c0.072-0.144,0.169-0.264,0.292-0.36c0.122-0.097,0.263-0.17,0.422-0.221c0.159-0.052,0.277-0.077,0.451-0.077V7.401h0.35v0.387c0.174,0,0.29,0.023,0.445,0.071c0.155,0.047,0.29,0.118,0.404,0.212c0.115,0.095,0.206,0.215,0.274,0.359c0.067,0.146,0.103,0.315,0.103,0.508H10.74c-0.007-0.201-0.06-0.354-0.154-0.46c-0.096-0.106-0.199-0.159-0.408-0.159v1.244c0.174,0.047,0.296,0.102,0.462,0.165c0.167,0.063,0.314,0.144,0.443,0.241c0.128,0.099,0.23,0.221,0.309,0.366c0.077,0.146,0.116,0.324,0.116,0.536C11.509,11.092,11.473,11.283,11.4,11.447 M18.675,4.795H1.326c-0.479,0-0.868,0.389-0.868,0.868v8.674c0,0.479,0.389,0.867,0.868,0.867h17.349c0.479,0,0.867-0.389,0.867-0.867V5.664C19.542,5.184,19.153,4.795,18.675,4.795M1.76,5.664c0.24,0,0.434,0.193,0.434,0.434C2.193,6.336,2,6.531,1.76,6.531S1.326,6.336,1.326,6.097C1.326,5.857,1.52,5.664,1.76,5.664 M1.76,14.338c-0.24,0-0.434-0.195-0.434-0.434c0-0.24,0.194-0.434,0.434-0.434s0.434,0.193,0.434,0.434C2.193,14.143,2,14.338,1.76,14.338 M18.241,14.338c-0.24,0-0.435-0.195-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,14.143,18.48,14.338,18.241,14.338 M18.675,12.682c-0.137-0.049-0.281-0.08-0.434-0.08c-0.719,0-1.302,0.584-1.302,1.303c0,0.152,0.031,0.297,0.08,0.434H2.981c0.048-0.137,0.08-0.281,0.08-0.434c0-0.719-0.583-1.303-1.301-1.303c-0.153,0-0.297,0.031-0.434,0.08V7.318c0.136,0.049,0.28,0.08,0.434,0.08c0.718,0,1.301-0.583,1.301-1.301c0-0.153-0.032-0.298-0.08-0.434H17.02c-0.049,0.136-0.08,0.28-0.08,0.434c0,0.718,0.583,1.301,1.302,1.301c0.152,0,0.297-0.031,0.434-0.08V12.682z M18.241,6.531c-0.24,0-0.435-0.194-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,6.336,18.48,6.531,18.241,6.531 M9.22,8.896c0,0.095,0.019,0.175,0.058,0.242c0.039,0.066,0.088,0.124,0.148,0.171c0.061,0.047,0.13,0.086,0.21,0.115c0.079,0.028,0.11,0.055,0.192,0.073V8.319c-0.21,0-0.322,0.044-0.437,0.132C9.277,8.54,9.22,8.688,9.22,8.896 M15.639,12.602h-0.868c-0.239,0-0.434,0.195-0.434,0.434c0,0.24,0.194,0.436,0.434,0.436h0.868c0.24,0,0.434-0.195,0.434-0.436C16.072,12.797,15.879,12.602,15.639,12.602 M10.621,10.5c-0.068-0.052-0.145-0.093-0.23-0.124c-0.086-0.031-0.123-0.06-0.212-0.082v1.374c0.209-0.016,0.332-0.076,0.465-0.186c0.134-0.107,0.201-0.281,0.201-0.516c0-0.11-0.02-0.202-0.062-0.277C10.743,10.615,10.688,10.551,10.621,10.5"></path>
                    </svg>
                    <span class="mx-3">{{__('sidebar.Payments')}}</span>
                </a>

            @endif

            {{-- Buyer Shipments link --}}
            @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == "Buyer" && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.index') || request()->routeIs('deliveredShipments') || request()->routeIs('ongoingShipment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             class="w-6 h-6"
                             viewBox="0 0 172 172"
                             style=" fill:#000000;transform: scaleX(-1);">
                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none"
                               style="mix-blend-mode: normal">
                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                <g fill="currentColor">
                                    <path
                                        d="M24.72553,59.66303c-2.28438,0 -4.03125,1.74688 -4.03125,4.03125v80.625c0,2.28438 1.74687,4.03125 4.03125,4.03125h10.21197c0,0.5375 -0.13385,0.9401 -0.13385,1.4776c0,3.225 0.94115,6.3151 2.55365,8.86823h-13.1698c-2.28438,0 -4.03125,1.74687 -4.03125,4.03125c0,2.28438 1.74687,4.03125 4.03125,4.03125h113.41302c0.40312,0 0.94063,-0.13333 1.34375,-0.2677c8.6,-0.67187 15.45313,-7.92865 15.45313,-16.66302c0,-0.5375 0.00052,-0.9401 -0.13385,-1.4776h10.34583c2.28438,0 4.03125,-1.74687 4.03125,-4.03125v-47.03125v-0.27032v-0.5354c0,-0.13437 0.00052,-0.13595 -0.13385,-0.27032c0,-0.13437 -0.13385,-0.26718 -0.13385,-0.40155l-8.46667,-21.09845c-3.62813,-9.1375 -12.3625,-14.91457 -22.17187,-15.04895h-13.4375c-2.28437,0 -4.03125,1.74688 -4.03125,4.03125v76.59375h-54.82605c-1.075,-1.6125 -2.41665,-2.95625 -3.89478,-4.03125h50.79218c2.28438,0 4.03125,-1.74687 4.03125,-4.03125v-68.53125c0,-2.28437 -1.74687,-4.03125 -4.03125,-4.03125zM28.75678,67.59167h79.4151v47.03125h-79.4151zM128.46197,67.59167h5.375v22.84375c0,1.88125 1.21042,3.49165 3.09167,3.89478l23.78333,5.91302v39.91095h-9.13593c-3.09062,-4.43437 -8.06355,-7.25677 -13.84167,-7.25677c-3.35937,0 -6.5849,1.07447 -9.2724,2.82135zM141.89948,68.12708c4.8375,1.20937 8.7349,4.70313 10.61615,9.40625l5.50885,13.84167l-16.125,-4.03125zM28.89063,136.12292h12.89947c-1.47812,1.075 -2.8224,2.41875 -3.8974,4.03125h-9.00208zM51.60053,140.68958c3.225,0 6.17968,1.74792 7.79218,4.43542c0.13437,0.67188 0.40522,1.20833 0.80835,1.61145c0.26875,0.94063 0.5354,2.0172 0.5354,2.95782c0,4.43437 -3.225,8.06198 -7.39062,8.86823h-3.35937c-4.16563,-0.80625 -7.39062,-4.43385 -7.39062,-8.86823c0,-4.97188 4.03282,-9.0047 9.0047,-9.0047zM137.46667,140.68958c4.97188,0 9.00208,4.03282 9.00208,9.0047c0.26875,4.70313 -3.3599,8.46458 -7.92865,9.00208c-0.26875,-0.13438 -0.53645,-0.13385 -0.93958,-0.13385h-1.74792c-4.16563,-0.80625 -7.39063,-4.43385 -7.39063,-8.86823c0,-4.97188 4.03282,-9.0047 9.0047,-9.0047zM68.26355,148.21667h52.67395c0,0.5375 -0.13385,0.9401 -0.13385,1.4776c0,3.225 0.94115,6.3151 2.55365,8.86823h-57.51355c1.6125,-2.55312 2.55365,-5.64323 2.55365,-8.86823c0,-0.5375 0.00052,-0.9401 -0.13385,-1.4776zM6.71875,158.66223c-1.04141,0 -2.08229,0.3711 -2.82135,1.11017c-0.80625,0.67188 -1.2099,1.74635 -1.2099,2.82135c0,1.075 0.40365,2.14948 1.2099,2.82135c0.80625,0.80625 1.74635,1.2099 2.82135,1.2099c1.075,0 2.14948,-0.40365 2.82135,-1.2099c0.80625,-0.80625 1.2099,-1.74635 1.2099,-2.82135c0,-1.075 -0.40365,-2.14948 -1.2099,-2.82135c-0.73906,-0.73906 -1.77994,-1.11017 -2.82135,-1.11017z"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="mx-3 font-extrabold">{{__('sidebar.Shipments')}}</span>
                        <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 3.6em;" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                    </span>
                        <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 3.6em;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    </a>
                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('shipment.index') || request()->routeIs('deliveredShipments')|| request()->routeIs('ongoingShipment'))  x-data="{ open: true } " @endif--}}
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('ongoingShipment') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('ongoingShipment') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('ongoingShipment') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Current Shipments')}}</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('deliveredShipments') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('deliveredShipments') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('deliveredShipments') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Delivered Shipments')}}</span></a>
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('shipment.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            <a href="{{ route('shipment.index') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('shipment.index') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Shipments Histroy')}}</span></a>
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Warehouse link --}}
            @if(auth()->user()->hasRole('CEO') && Auth::user()->registration_type != null)
                <hr class="mt-4">
                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('businessWarehouse.create') || request()->routeIs('businessWarehouseShow')|| request()->routeIs('users.create') || request()->routeIs('vehicle.create')|| request()->routeIs('vehicle.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.121,9.88l-7.832-7.836c-0.155-0.158-0.428-0.155-0.584,0L1.842,9.913c-0.262,0.263-0.073,0.705,0.292,0.705h2.069v7.042c0,0.227,0.187,0.414,0.414,0.414h3.725c0.228,0,0.414-0.188,0.414-0.414v-3.313h2.483v3.313c0,0.227,0.187,0.414,0.413,0.414h3.726c0.229,0,0.414-0.188,0.414-0.414v-7.042h2.068h0.004C18.331,10.617,18.389,10.146,18.121,9.88 M14.963,17.245h-2.896v-3.313c0-0.229-0.186-0.415-0.414-0.415H8.342c-0.228,0-0.414,0.187-0.414,0.415v3.313H5.032v-6.628h9.931V17.245z M3.133,9.79l6.864-6.868l6.867,6.868H3.133z"></path>
                        </svg>
                        <span class="mx-3 font-extrabold">{{ __('sidebar.Warehouse') }}</span>
                        <span x-show="open == false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="margin-left: 3.3em;" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                        </svg>
                    </span>
                        <span x-show="open == true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" style="margin-left: 3.3em;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
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
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        @if(request()->routeIs('businessWarehouse.create') || request()->routeIs('businessWarehouseShow'))  x-data="{ open: false } " @endif --}}
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('businessWarehouse.create') || request()->routeIs('businessWarehouseShow') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            @if (isset($isBusinessWarehouseDataExist))
                                <a href="{{ route('businessWarehouseShow', $isBusinessWarehouseDataExist->business_id) }}" class="hover:text-white {{ request()->routeIs('businessWarehouseShow') ? 'text-white' : 'text-gray-500' }}"><span class="mx-3">{{ __('sidebar.Warehouse') }}</span></a>
                            @else
                                <a href="{{ route('businessWarehouse.create') }}" class="hover:text-white {{ request()->routeIs('businessWarehouse.create') ? 'text-white' : 'text-gray-500' }}"><span class="mx-3">{{ __('sidebar.Warehouse') }}</span></a>
                            @endif
                        </li>

                        @if (auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('vehicle.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                </svg>
                                <a href="{{ route('users.create') }}" class="hover:text-white {{ request()->routeIs('users.create') ? 'text-white' : 'text-gray-500' }}"><span class="mx-3 ">{{ __('sidebar.Add Driver') }}</span></a>
                            </li>
                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('vehicle.create') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                </svg>
                                <a href="{{ route('vehicle.create') }}" class="hover:text-white {{ request()->routeIs('vehicle.create') ? 'text-white' : 'text-gray-500' }}"><span class="mx-3 ">{{ __('sidebar.Add Vehicle') }}</span></a>
                            </li>
                            <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('vehicle.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                                </svg>
                                <a href="{{ route('vehicle.index') }}" class="hover:text-white {{ request()->routeIs('vehicle.index') ? 'text-white' : 'text-gray-500' }}"><span class="mx-3 ">{{ __('sidebar.List of Vehicles') }}</span></a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif

            {{-- CEO Users link --}}
            @if(auth()->user()->hasRole('CEO') && Auth::user()->status == 3)

                <div x-data="{ open: false } ">
                    <a @click="open = true"
                       class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('createSupplier') || request()->routeIs('createBuyer') || request()->routeIs('businessSuppliers')|| request()->routeIs('businessBuyers') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="javascript:void(0);">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="transform: scaleX(-1);">
                            <path
                                d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path>
                        </svg>
                        <span class="mx-3 font-extrabold">@if(auth()->user()->registration_type == "Supplier") {{__('sidebar.Buyers')}} @elseif(auth()->user()->registration_type == "Buyer") {{__('sidebar.Suppliers')}} @endif</span>
                        <span x-show="open == false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" @if(auth()->user()->registration_type == "Supplier") style="margin-left: 5.2em;" @else style="margin-left: 4em;" @endif  viewBox="0 0 20 20" fill="currentColor">
                              <path
                                  d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                            </svg>
                        </span>
                        <span x-show="open == true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-12 w-4 h-4" @if(auth()->user()->registration_type == "Supplier") style="margin-left: 5.2em;" @else style="margin-left: 4em;" @endif viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    </a>
                    <ul
                        x-show="open"
                        x-show.transition.in.duration.50ms.out.duration.100ms="open"
                        x-show.transition.in="open"
                        x-show.transition.out="open"
                        @click.away="open = false"
{{--                        x-show.transition.in.duration.50ms.out.duration.100ms="open"--}}
{{--                        @if(request()->routeIs('createBuyer') || request()->routeIs('createSupplier')|| request()->routeIs('businessBuyers')|| request()->routeIs('businessSuppliers'))  x-data="{ open: true } " @endif--}}
                    >
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('createBuyer') || request()->routeIs('createSupplier') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            @if(auth()->user()->registration_type == "Supplier")
                                <a href="{{ route('createBuyer') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('createBuyer') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Add Buyer')}}</span></a>
                            @elseif(auth()->user()->registration_type == "Buyer")
                                <a href="{{ route('createSupplier') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('createSupplier') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.Add Supplier')}}</span></a>
                            @endif
                        </li>
                        <li class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('businessSuppliers') || request()->routeIs('businessBuyers') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                            @if(auth()->user()->registration_type == "Supplier")
                                <a href="{{ route('businessBuyers') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('businessBuyers') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.List of Buyers')}}</span></a>
                            @elseif(auth()->user()->registration_type == "Buyer")
                                <a href="{{ route('businessSuppliers') }}"><span class="mx-3 hover:text-white {{ request()->routeIs('businessSuppliers') ? 'text-white' : 'text-gray-500' }}">{{__('sidebar.List of Suppliers')}}</span></a>
                            @endif
                        </li>

                    </ul>
                </div>
            @endif

            {{-- Buyer Ratings link --}}
            @if(auth()->user()->hasRole('CEO') && Auth::user()->status == 3)
                @if(auth()->user()->registration_type == "Buyer")
                    <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('buyerRatingView') || request()->routeIs('buyerDeliveryRatingListIndex') || request()->routeIs('buyerRatedToDeliveries') || request()->routeIs('buyerUnRatedDeliveries') || request()->routeIs('deliveriesListToRate') || request()->routeIs('rateDelivery') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="{{ route('buyerRatingView') }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="none"
                                  d="M16.85,7.275l-3.967-0.577l-1.773-3.593c-0.208-0.423-0.639-0.69-1.11-0.69s-0.902,0.267-1.11,0.69L7.116,6.699L3.148,7.275c-0.466,0.068-0.854,0.394-1,0.842c-0.145,0.448-0.023,0.941,0.314,1.27l2.871,2.799l-0.677,3.951c-0.08,0.464,0.112,0.934,0.493,1.211c0.217,0.156,0.472,0.236,0.728,0.236c0.197,0,0.396-0.048,0.577-0.143l3.547-1.864l3.548,1.864c0.18,0.095,0.381,0.143,0.576,0.143c0.256,0,0.512-0.08,0.729-0.236c0.381-0.277,0.572-0.747,0.492-1.211l-0.678-3.951l2.871-2.799c0.338-0.329,0.459-0.821,0.314-1.27C17.705,7.669,17.316,7.343,16.85,7.275z M13.336,11.754l0.787,4.591l-4.124-2.167l-4.124,2.167l0.788-4.591L3.326,8.5l4.612-0.67l2.062-4.177l2.062,4.177l4.613,0.67L13.336,11.754z"></path>
                        </svg>
                        <span class="mx-3">{{__('sidebar.Ratings')}}</span>
                    </a>
                @endif
                @if(auth()->user()->registration_type == "Supplier")
                    <a class="flex items-center mt-4 py-2 px-6  {{ request()->routeIs('supplierRatingView') || request()->routeIs('supplierDeliveryRatingListIndex') || request()->routeIs('supplierDeliveryRatingViewByID') || request()->routeIs('supplierRatedToDeliveries') || request()->routeIs('deliveriesListToRate') || request()->routeIs('supplierUnRatedDeliveries') || request()->routeIs('supplierDeliveriesListToRate') || request()->routeIs('rateDeliveryBySupplier') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                       href="{{ route('supplierRatingView') }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="none"
                                  d="M16.85,7.275l-3.967-0.577l-1.773-3.593c-0.208-0.423-0.639-0.69-1.11-0.69s-0.902,0.267-1.11,0.69L7.116,6.699L3.148,7.275c-0.466,0.068-0.854,0.394-1,0.842c-0.145,0.448-0.023,0.941,0.314,1.27l2.871,2.799l-0.677,3.951c-0.08,0.464,0.112,0.934,0.493,1.211c0.217,0.156,0.472,0.236,0.728,0.236c0.197,0,0.396-0.048,0.577-0.143l3.547-1.864l3.548,1.864c0.18,0.095,0.381,0.143,0.576,0.143c0.256,0,0.512-0.08,0.729-0.236c0.381-0.277,0.572-0.747,0.492-1.211l-0.678-3.951l2.871-2.799c0.338-0.329,0.459-0.821,0.314-1.27C17.705,7.669,17.316,7.343,16.85,7.275z M13.336,11.754l0.787,4.591l-4.124-2.167l-4.124,2.167l0.788-4.591L3.326,8.5l4.612-0.67l2.062-4.177l2.062,4.177l4.613,0.67L13.336,11.754z"></path>
                        </svg>
                        <span class="mx-3">{{__('sidebar.Ratings')}}</span>
                    </a>
                @endif
            @endif

        </nav>
    </div>
@endif

