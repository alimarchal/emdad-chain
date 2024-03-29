@include('ire.arabic.layout.header')

    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        @php
            $poCount = 0;

                $businessCount = \App\Models\IreCommission::where('type', '!=', 0)->where(['ire_no' => \auth()->guard('ire')->user()->ire_no],['status' => 1])->get();

                if (isset($businessCount) && count($businessCount) > 0 )
                {
                    foreach ($businessCount as $business)
                    {
                        $userPoCount = \App\Models\DraftPurchaseOrder::where(['user_id' => $business->user_id],['status' => 'approved'])->first();

                        if (isset($userPoCount))
                        {
                            $poCount += 1;
                        }
                    }
                }
        @endphp
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center lg:hidden">
                        <a href="{{ route('ireArabicDashboard') }}">
                            <!-- <x-jet-application-mark class="block h-9 w-auto"/> -->
                            <img src="{{ url('logo.png') }}" alt="EMDAD CHAIN LOGO" class="block h-9 w-auto" />
                        </a>
                    </div>

                    @if(auth()->guard('ire')->user()->type == 0) {{-- type == 0 is for non-employee--}}
                        <!-- Days Remaining -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            @php
                                $userCreatedAt = \Carbon\Carbon::parse(auth()->guard('ire')->user()->created_at);
                                $remainingDays = $userCreatedAt->addDays(30);
                            @endphp
                            <x-jet-nav-link href="javascript:void(0)" title="الأيام المتبقية؛ عدد الأيام المتبقي ليتمكن الآخرون من استخدام الرقم المرجعي الخاص بك">
                                الأيام المتبقية:   &nbsp;<div class="text-gray-500" data-countdown="{{$remainingDays}}"></div>
                            </x-jet-nav-link>
                        </div>
                    @endif

                    <!-- Remaining Business -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        @php
                            if ($poCount >= 0 && $poCount <=5)
                            {
                                $remainingBusiness = 5 - $poCount;
                            }
                            else{
                                $remainingBusiness = 0;
                            }
                        @endphp
                        <x-jet-nav-link href="javascript:void(0)" title="العمليات المتبقية؛ المتبقي من العدد المطلوب للشركات المسجلة وعمليات الشراء لكلٍ منها">
                            {{ __('العمليات المتبقية:') }}  &nbsp;{{$remainingBusiness}}
                        </x-jet-nav-link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('arabic.policyProcedure.ire') }}" target="_blank" :active="request()->routeIs('policyProcedure.eula')">
                            {{ __('الشروط والأحكام') }}  &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                        </x-jet-nav-link>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <a onclick="language(0)" class="get-started-btn scrollto" style="cursor: pointer; font-family: Nunito,system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top: -4px;">English</a>

                    <div x-data="{ notificationOpen: false }" class="relative">
                        <button @click="notificationOpen = ! notificationOpen" class="flex mx-4 text-gray-600 focus:outline-none">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div x-show="notificationOpen" @click="notificationOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                        <div x-show="notificationOpen" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10" style="width:20rem;">
                        </div>
                    </div>
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div style="font-family: Nunito,system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;">{{ auth()->guard('ire')->user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('إدارة الحساب') }}
                                </div>
                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('ireArabicProfile') }}">
                                    {{ __('الملف الشخصي') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{route('ireChangePassword')}}">
                                    {{ __('تغيير كلمة المرور') }}
                                </x-jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('تسجيل خروج') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                 </div>
                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('ireArabicDashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('لوحة القيادة') }}
                </x-jet-responsive-nav-link>

            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
{{--                        <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />--}}
                    </div>

                    <div class="ml-3">
{{--                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>--}}
{{--                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>--}}
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-jet-responsive-nav-link href="{{ route('ireArabicProfile') }}" :active="request()->routeIs('ireArabicProfile')">
                        {{ __('الملف الشخصي') }}
                    </x-jet-responsive-nav-link>


                    <x-jet-dropdown-link href="{{route('ireChangePassword')}}"  :active="request()->routeIs('ireChangePassword')">
                        {{ __('تغيير كلمة المرور') }}
                    </x-jet-dropdown-link>


                <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('تسجيل خروج') }}
                        </x-jet-responsive-nav-link>
                    </form>

                </div>
            </div>
        </div>
    </nav>

<script>
    function language(rtl_value) {
        $.ajax({
            url: "{{route('ireLanguageChange')}}",
            method: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                rtl_value: rtl_value,
            },
            success: function(){
                window.location.reload();
            },
            // error: function(result){
            //     console.log('error');
            // }
        });
    }
</script>

