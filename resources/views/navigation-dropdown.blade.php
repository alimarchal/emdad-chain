@include('_layouts.header')

@if (auth()->user()->rtl == 0)

    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center lg:hidden">
                        <a href="{{ route('dashboard') }}">
                            <!-- <x-jet-application-mark class="block h-9 w-auto"/> -->
                            <img src="{{ url('logo.png') }}" alt="EMDAD CHAIN LOGO" class="block h-9 w-auto"/>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                        {{--                    @role('SuperAdmin|CEO')--}}
                        @role('SuperAdmin')
                        @if (auth()->user()->status == 3)
                            <x-jet-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                                <svg class="h-6 w-6" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                                    <path d="M16 11l2 2l4 -4"/>
                                </svg>
                                &nbsp;
                                @if(auth()->user()->hasRole('SuperAdmin'))
                                    {{ __('navigation-dropdown.Users Admin') }}
                                @else
                                    {{ __('navigation-dropdown.Users') }}
                                @endif
                            </x-jet-nav-link>
                        @endif

                        @endrole
                        @role('SuperAdmin')
                        <x-jet-nav-link href="{{ route('category.create') }}" :active="request()->routeIs('category.*')">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            &nbsp;
                            {{ __('navigation-dropdown.Categories Admin') }}
                        </x-jet-nav-link>

                        <x-jet-nav-link href="{{ route('contact.index') }}" :active="request()->routeIs('contact.*')">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            &nbsp;
                            {{ __('navigation-dropdown.Support Requests') }}
                        </x-jet-nav-link>
                        @endrole

                        @role('SC Specialist')
                        <x-jet-nav-link href="{{ route('showAllCategory') }}" :active="request()->routeIs('showAllCategory')">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            &nbsp;
                            {{ __('navigation-dropdown.Categories with sub-categories') }}
                        </x-jet-nav-link>
                        @endrole

                        @if(auth()->user()->can('all') || auth()->user()->registration_type == "Buyer" && auth()->user()->status == 3)
                            {{--                        <x-jet-nav-link href="{{ route('RFQCart.index') }}" :active="request()->routeIs('RFQCart.index')">
                                                        @include('RFQ.RFQICON') &nbsp;RFQ Items
                                                        @if (\App\Models\ECart::where('user_id', auth()->user()->id)
                                                            ->where('business_id', auth()->user()->business_id)
                                                            ->count())
                                                            ({{ \App\Models\ECart::where('user_id', auth()->user()->id)->where('business_id', auth()->user()->business_id)->count() }})
                                                        @endif

                                                    </x-jet-nav-link>--}}
                        @endif

                        {{--                    @if (auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('CEO') && auth()->user()->status == 3)--}}
                        @if (auth()->user()->hasRole('SuperAdmin'))
                            <x-jet-nav-link href="{{ route('packages.index') }}" :active="request()->routeIs('subscription')">
                                {{ __('navigation-dropdown.Subscription') }}
                            </x-jet-nav-link>
                        @endif

                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @role('SC Specialist')
                    @php $rfqs = \App\Models\EOrderItems::with('qoutes')->doesntHave('qoutes')->count(); @endphp
                    <span title="Number of RFQs which received no quotations">RFQs with no Quotations: &nbsp;<a href="{{route('RFQsWithNoQuotations')}}" style="padding-right: 10px;"><span class="text-blue-600 hover:underline">{{$rfqs}}</span></a></span>
                    @endrole

                    @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                        @php
                            $business_cate = \App\Models\BusinessCategory::where('business_id', auth()->user()->business_id)->get();
                            if ($business_cate->isNotEmpty()) {
                                foreach ($business_cate as $item) {
                                    $business_categories[] = (int)$item->category_number;
                                }
                            }
                            sort($business_categories);
                            // Counting NEW RFQs for multiple categories for supplier
                            $rfqCount = \App\Models\EOrderItems::where(['status' => 'pending', 'rfq_type' => 1])->where('bypass', 0)->whereDate('quotation_time', '>=', \Carbon\Carbon::now())->whereIn('item_code', $business_categories)->count();
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
                            if (count($eOrders) > 0)
                            {
                                $quote = \App\Models\Qoute::where(['e_order_id' => $eOrders[0]->id, 'supplier_business_id' => auth()->user()->business_id])->first();
                            }
                        @endphp
                        <span title="{{__('navigation-dropdown.Number of New Requisitions(s) received against multiple categories')}}">{{ __('navigation-dropdown.Multiple Categories RFQ')}}: &nbsp;<a href="{{route('viewRFQs')}}" style="padding-right: 10px;"><span @if($rfqCount > 0) class="text-green-600 hover:underline"
                                                                                                                                                                                                     @else class="text-red-600 hover:underline" @endif>{{$rfqCount}}</span></a></span>
                        <span title="{{__('navigation-dropdown.Number of New Requisitions(s) received against single category')}}">{{ __('navigation-dropdown.Single Category RFQ')}}: &nbsp;<a href="{{route('singleCategoryRFQs')}}" style="padding-right: 10px;"><span @if(count($eOrders) > 0 && !isset($quote)) class="text-green-600 hover:underline"
                                                                                                                                                                                                         @else class="text-red-600 hover:underline" @endif>@if(count($eOrders) > 0 && !isset($quote)) {{count(array_unique($eOrders))}} @else 0 @endif</span></a></span>
                    @endif

                    @if(auth()->user()->hasRole('CEO|Buyer Create New RFQ') && auth()->user()->registration_type == 'Buyer' && auth()->user()->status == 3)
                        @php
                            $multiPlacedRFQ = \App\Models\Qoute::where(['business_id' => auth()->user()->business_id, 'status' => 'pending' ,'rfq_type' => 1])->count();
                            $singlePlacedRFQ = \App\Models\Qoute::where(['business_id' => auth()->user()->business_id, 'status' => 'pending' ,'rfq_type' => 0])->get();
                        @endphp
                        <span title="{{__('navigation-dropdown.Number of New Quotation(s) received against multiple categories')}}">{{ __('navigation-dropdown.Multiple Categories Quotations')}}: &nbsp;<a href="{{route('QoutationsBuyerReceived')}}" style="padding-right: 10px;"><span @if($multiPlacedRFQ > 0) class="text-green-600 hover:underline"
                                                                                                                                                                                                                                 @else class="text-red-600 hover:underline" @endif>{{$multiPlacedRFQ}}</span></a></span>
                        <span title="{{__('navigation-dropdown.Number of New Quotation(s) received against single category')}}">{{ __('navigation-dropdown.Single Category Quotations')}}: &nbsp;<a href="{{route('singleCategoryBuyerRFQs')}}" style="padding-right: 10px;"><span @if(count($singlePlacedRFQ) > 0) class="text-green-600 hover:underline"
                                                                                                                                                                                                                           @else class="text-red-600 hover:underline" @endif>{{count($singlePlacedRFQ->unique('e_order_id'))}}</span></a></span>
                    @endif

{{--                    @can('all')--}}
                        {{--                    Uncomment below line when arabic version is ready and delete comming soon line--}}
                        {{--                <x-jet-button onclick="language(1)">--}}
{{--                        <x-jet-button>--}}
{{--                                <a onclick="language(1, 'en')" class="get-started-btn scrollto"><img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;margin-top:-4px;" id="lan">العربية</a>--}}
                    {{-- Added below if condition because of POST method being used and POST is not able to redirect --}}
                    @if(request()->routeIs('invoicePayment.stepOne'))
                        <a href="{{route('languageChangeForPayment', ['lang' => 'ar', 'rtl_value' => 1])}}" class="inline-flex items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"><img alt="" src="{{url('sa.png')}}" style="margin-right: -18px;margin-top:-28px;" id="lan">العربية</a>
                    @elseif(request()->routeIs('businessPackage.stepOne'))
                        <a href="{{route('languageChangeForPackagePayment', ['lang' => 'ar', 'rtl_value' => 1])}}" class="inline-flex items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"><img alt="" src="{{url('sa.png')}}" style="margin-right: -18px;margin-top:-28px;" id="lan">العربية</a>
                    @else
                        <a href="{{route('languageChange', ['lang' => 'ar', 'rtl_value' => 1])}}" class="inline-flex items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"><img alt="" src="{{url('sa.png')}}" style="margin-right: -18px;margin-top:-28px;" id="lan">العربية</a>
                    @endif
                        {{-- <a class="get-started-btn scrollto"><img alt="" src="{{url('sa.png')}}" style="margin-right: 2px;margin-top:-4px;">قريباً</a>
                        </x-jet-button>
                        @endcan --}}
                    <div x-data="{ notificationOpen: false }" class="relative">
                        <button @click="notificationOpen = ! notificationOpen" class="flex mx-4 text-gray-600 focus:outline-none">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <div x-show="notificationOpen" @click="notificationOpen = false" class="fixed inset-0 h-full w-full z-10"></div>


                    </div>
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                                </button>

                            @else
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('navigation-dropdown.Business Info Management') }}
                            </div>
                            <div class="border-t border-gray-100"></div>
                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('navigation-dropdown.Profile') }}
                            </x-jet-dropdown-link>


                            @can('all')
                                <div class="border-t border-gray-100"></div>
                                <x-jet-responsive-nav-link href="{{ route('log.viewer') }}" :active="request()->routeIs('log.viewer')">
                                    {{ __('navigation-dropdown.Log Viewer') }}
                                </x-jet-responsive-nav-link>

                                <div class="border-t border-gray-100"></div>
                                <x-jet-responsive-nav-link href="{{ route('user_logs') }}" :active="request()->routeIs('user_logs')">
                                    {{ __('navigation-dropdown.User Logs') }}
                                </x-jet-responsive-nav-link>
                            @endcan

                            @can('all')
                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('downloads') }}">
                                    {{ __('navigation-dropdown.Downloads') }}
                                </x-jet-dropdown-link>
                            @endcan

                            @php
                                $isBusinessDataExist = \App\Models\Business::where('user_id', Auth::user()->id)->first();
                                if ($isBusinessDataExist) {
                                    $isBusinessPOIExist = \App\Models\POInfo::where('business_id', $isBusinessDataExist->id)->first();
                                }
                            @endphp
                            @if (auth()->user()->hasRole('CEO') && Auth::user()->registration_type != null)
                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('business.create') }}">
                                    @if(isset(auth()->user()->business->business_name))
                                        {{ auth()->user()->business->business_name . ' ' . __('navigation-dropdown.Info') }}
                                    @else
                                        {{ __('navigation-dropdown.Business') }}
                                    @endif
                                </x-jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>
                                @if($isBusinessDataExist)
                                    <x-jet-dropdown-link href="{{ route('certificateView') }}">
                                        {{ __('navigation-dropdown.Update Certificates') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>
                                @if (isset($isBusinessPOIExist))
                                    <x-jet-dropdown-link href="{{ route('purchaseOrderInfo.show', $isBusinessPOIExist->id) }}">
                                        {{ __('navigation-dropdown.P.O. Info') }}
                                    </x-jet-dropdown-link>
                                @else
                                    <x-jet-dropdown-link href="{{ route('purchaseOrderInfo.create') }}">
                                        {{ __('navigation-dropdown.P.O. Info') }}
                                    </x-jet-dropdown-link>
                                @endif
                            @endif

                            @if (auth()->user()->status == 3 && auth()->user()->hasRole('CEO|SuperAdmin'))

                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('packages.index') }}">
                                    {{ __('navigation-dropdown.Subscription') }}
                                </x-jet-dropdown-link>

                                {{--<div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('users.create') }}">
                                    {{ __('navigation-dropdown.Create Users') }}
                                </x-jet-dropdown-link>--}}

                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('users.index') }}">
                                    {{ __('navigation-dropdown.Current Users') }}
                                </x-jet-dropdown-link>

                                @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('CEO') && auth()->user()->status == 3 || auth()->user()->hasRole('CEO') && auth()->user()->status == null)

                                    @if (auth()->user()->business_id)
                                        <div class="border-t border-gray-100"></div>
                                        <x-jet-dropdown-link href="{{ route('users.create') }}">
                                            {{ __('navigation-dropdown.Add User') }}
                                        </x-jet-dropdown-link>
                                    @endif
                                @endif
                            @endif

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('navigation-dropdown.API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Management -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('navigation-dropdown.Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('navigation-dropdown.Team Settings') }}
                                </x-jet-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                        {{ __('navigation-dropdown.Create New Team') }}
                                    </x-jet-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('navigation-dropdown.Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-jet-switchable-team :team="$team"/>
                                @endforeach

                                <div class="border-t border-gray-100"></div>
                            @endif

                            @if (auth()->user()->usertype != 'CEO')
                                <x-jet-dropdown-link href="{{ route('policyProcedure.eula') }}" target="_blank" :active="request()->routeIs('policyProcedure.eula')">
                                    {{ __('navigation-dropdown.Policy and Procedure') }}
                                </x-jet-dropdown-link>
                            @endif

                            @if (auth()->user()->usertype == 'CEO')
                                @if(auth()->user()->registration_type == 'Buyer')
                                    <x-jet-dropdown-link href="{{ route('policyProcedure.buyer') }}" target="_blank" :active="request()->routeIs('policyProcedure.buyer')">
                                        {{ __('navigation-dropdown.Policy and Procedure') }}
                                    </x-jet-dropdown-link>
                                @elseif(auth()->user()->registration_type == 'Supplier')
                                    <x-jet-dropdown-link href="{{ route('policyProcedure.supplier') }}" target="_blank" :active="request()->routeIs('policyProcedure.supplier')">
                                        {{ __('navigation-dropdown.Policy and Procedure') }}
                                    </x-jet-dropdown-link>
                            @endif
                        @endif

                        <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('navigation-dropdown.Logout') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
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
                    {{ __('navigation-dropdown.Dashboard') }}
                </x-jet-responsive-nav-link>

                @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                    <a @if($rfqCount > 0) class="block pl-3 pr-4 py-2 border-l-4 border-green-400 text-base font-medium text-green-700 bg-green-50 focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out"
                       @else class="block pl-3 pr-4 py-2 border-l-4 border-red-400 text-base font-medium text-red-700 bg-red-50 focus:outline-none focus:text-red-800 focus:bg-red-100 focus:border-red-700 transition duration-150 ease-in-out" @endif href="{{ route('viewRFQs') }}">
                        {{ __('navigation-dropdown.Multiple Categories RFQ')}}: &nbsp; {{ $rfqCount }}
                    </a>
                    <a @if(count($eOrders) > 0 && !isset($quote)) class="block pl-3 pr-4 py-2 border-l-4 border-green-400 text-base font-medium text-green-700 bg-green-50 focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out"
                       @else class="block pl-3 pr-4 py-2 border-l-4 border-red-400 text-base font-medium text-red-700 bg-red-50 focus:outline-none focus:text-red-800 focus:bg-red-100 focus:border-red-700 transition duration-150 ease-in-out" @endif href="{{ route('singleCategoryRFQs') }}">
                        {{ __('navigation-dropdown.Single Category RFQ')}}: &nbsp; @if(count($eOrders) > 0 && !isset($quote)) {{count(array_unique($eOrders))}} @else 0 @endif
                    </a>
                @endif

                @if(auth()->user()->hasRole('CEO|Buyer Create New RFQ') && auth()->user()->registration_type == 'Buyer' && auth()->user()->status == 3)
                    <a @if($multiPlacedRFQ > 0) class="block pl-3 pr-4 py-2 border-l-4 border-green-400 text-base font-medium text-green-700 bg-green-50 focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out"
                       @else class="block pl-3 pr-4 py-2 border-l-4 border-red-400 text-base font-medium text-red-700 bg-red-50 focus:outline-none focus:text-red-800 focus:bg-red-100 focus:border-red-700 transition duration-150 ease-in-out" @endif href="{{ route('QoutationsBuyerReceived') }}">
                        {{ __('navigation-dropdown.Multiple Categories Quotations')}}: &nbsp; {{ $multiPlacedRFQ }}
                    </a>
                    <a @if(count($singlePlacedRFQ) > 0) class="block pl-3 pr-4 py-2 border-l-4 border-green-400 text-base font-medium text-green-700 bg-green-50 focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out"
                       @else class="block pl-3 pr-4 py-2 border-l-4 border-red-400 text-base font-medium text-red-700 bg-red-50 focus:outline-none focus:text-red-800 focus:bg-red-100 focus:border-red-700 transition duration-150 ease-in-out" @endif href="{{ route('singleCategoryBuyerRFQs') }}">
                        {{ __('navigation-dropdown.Single Category Quotations')}}: &nbsp; {{ count($singlePlacedRFQ->unique('e_order_id')) }}
                    </a>
                @endif
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
                        {{ __('navigation-dropdown.Profile') }}
                    </x-jet-responsive-nav-link>

                    @can('all')
                        <x-jet-responsive-nav-link href="{{ route('log.viewer') }}" :active="request()->routeIs('log.viewer')">
                            {{ __('navigation-dropdown.Log Viewer') }}
                        </x-jet-responsive-nav-link>

                        <div class="border-t border-gray-100"></div>
                        <x-jet-responsive-nav-link href="{{ route('user_logs') }}" :active="request()->routeIs('user_logs')">
                            {{ __('navigation-dropdown.User Logs') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    @if (auth()->user()->hasRole('CEO') && Auth::user()->registration_type != null)
                        <div class="border-t border-gray-100"></div>
                        <x-jet-dropdown-link href="{{ route('business.create') }}">
                            @if(isset(auth()->user()->business->business_name))
                                {{ auth()->user()->business->business_name . ' ' . __('navigation-dropdown.Info') }}
                            @else
                                {{ __('navigation-dropdown.Business') }}
                            @endif
                        </x-jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>
                        @if($isBusinessDataExist)
                            <x-jet-dropdown-link href="{{ route('certificateView') }}">
                                {{ __('navigation-dropdown.Update Certificates') }}
                            </x-jet-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>
                        @if (isset($isBusinessPOIExist))
                            <x-jet-dropdown-link href="{{ route('purchaseOrderInfo.show', $isBusinessPOIExist->id) }}">
                                {{ __('navigation-dropdown.P.O. Info') }}
                            </x-jet-dropdown-link>
                        @else
                            <x-jet-dropdown-link href="{{ route('purchaseOrderInfo.create') }}">
                                {{ __('navigation-dropdown.P.O. Info') }}
                            </x-jet-dropdown-link>
                        @endif
                    @endif

                    @if (auth()->user()->status == 3 && auth()->user()->hasRole('CEO|SuperAdmin'))
                        <div class="border-t border-gray-100"></div>
                        <x-jet-dropdown-link href="{{ route('packages.index') }}">
                            {{ __('navigation-dropdown.Subscription') }}
                        </x-jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>
                        <x-jet-dropdown-link href="{{ route('users.index') }}">
                            {{ __('navigation-dropdown.Current Users') }}
                        </x-jet-dropdown-link>

                        @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('CEO') && auth()->user()->status == 3 || auth()->user()->hasRole('CEO') && auth()->user()->status == null)

                            @if (auth()->user()->business_id)
                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('users.create') }}">
                                    {{ __('navigation-dropdown.Add User') }}
                                </x-jet-dropdown-link>
                            @endif
                        @endif
                    @endif


                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('navigation-dropdown.API Tokens') }}
                        </x-jet-responsive-nav-link>
                    @endif

                    @if (auth()->user()->usertype != 'CEO')
                        <x-jet-dropdown-link href="{{ route('policyProcedure.eula') }}" target="_blank" :active="request()->routeIs('policyProcedure.eula')">
                            {{ __('navigation-dropdown.Policy and Procedure') }}
                        </x-jet-dropdown-link>
                    @endif

                    @if (auth()->user()->usertype == 'CEO')
                        @if(auth()->user()->registration_type == 'Buyer')
                            <x-jet-dropdown-link href="{{ route('policyProcedure.buyer') }}" target="_blank" :active="request()->routeIs('policyProcedure.buyer')">
                                {{ __('navigation-dropdown.Policy and Procedure') }}
                            </x-jet-dropdown-link>
                        @elseif(auth()->user()->registration_type == 'Supplier')
                            <x-jet-dropdown-link href="{{ route('policyProcedure.supplier') }}" target="_blank" :active="request()->routeIs('policyProcedure.supplier')">
                                {{ __('navigation-dropdown.Policy and Procedure') }}
                            </x-jet-dropdown-link>
                        @endif
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('navigation-dropdown.Logout') }}
                        </x-jet-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('navigation-dropdown.Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                            {{ __('navigation-dropdown.Team Settings') }}
                        </x-jet-responsive-nav-link>

                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('navigation-dropdown.Create New Team') }}
                        </x-jet-responsive-nav-link>

                        <div class="border-t border-gray-200"></div>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('navigation-dropdown.Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link"/>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </nav>
@elseif (auth()->user()->rtl == 1 )

    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center lg:hidden">
                        <a href="{{ route('dashboard') }}">
                            <!-- <x-jet-application-mark class="block h-9 w-auto"/> -->
                            <img src="{{ url('logo.png') }}" alt="EMDAD CHAIN LOGO" class="block h-9 w-auto"/>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex" style="direction: rtl">

                        @role('SuperAdmin')
                        @if (auth()->user()->status == 3)
                            <x-jet-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                                <svg class="h-6 w-6" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                                    <path d="M16 11l2 2l4 -4"/>
                                </svg>
                                &nbsp;
                                @if(auth()->user()->hasRole('SuperAdmin'))
                                    {{ __('navigation-dropdown.Users Admin') }}
                                @else
                                    {{ __('navigation-dropdown.Users') }}
                                @endif
                            </x-jet-nav-link>
                        @endif
                        @endrole
                        @role('SuperAdmin')
                        <x-jet-nav-link href="{{ route('category.create') }}" :active="request()->routeIs('category.*')">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            &nbsp;
                            {{ __('navigation-dropdown.Categories Admin') }}
                        </x-jet-nav-link>

                        <x-jet-nav-link href="{{ route('contact.index') }}" :active="request()->routeIs('contact.*')">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            &nbsp;
                            {{ __('navigation-dropdown.Support Requests') }}
                        </x-jet-nav-link>
                        @endrole

                        @role('SC Specialist')
                        <x-jet-nav-link href="{{ route('showAllCategory') }}" :active="request()->routeIs('showAllCategory')">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            &nbsp;
                            {{ __('navigation-dropdown.Categories with sub-categories') }}
                        </x-jet-nav-link>
                        @endrole

                       {{-- @if(auth()->user()->can('all') || auth()->user()->hasRole('CEO') && auth()->user()->status == 3)
                            <x-jet-nav-link href="{{ route('RFQCart.index') }}" :active="request()->routeIs('RFQCart.index')">
                                @include('RFQ.RFQICON') &nbsp;طلبات أسعار المنتجات
                                @if (\App\Models\ECart::where('user_id', auth()->user()->id)
                                    ->where('business_id', auth()->user()->business_id)
                                    ->count())
                                    ({{ \App\Models\ECart::where('user_id', auth()->user()->id)->where('business_id', auth()->user()->business_id)->count() }})
                                @endif

                            </x-jet-nav-link>
                        @endif

                        @if (auth()->user()->usertype != 'CEO')
                            <x-jet-nav-link href="{{ route('policyProcedure.eula') }}" target="_blank" :active="request()->routeIs('policyProcedure.eula')">
                                {{ __('navigation-dropdown.Policy and Procedure') }} &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                            </x-jet-nav-link>
                        @endif

                        @if (auth()->user()->usertype == 'CEO')
                            @if(auth()->user()->registration_type == 'Buyer')
                                <x-jet-nav-link href="{{ route('policyProcedure.buyer') }}" target="_blank" :active="request()->routeIs('policyProcedure.buyer')">
                                    {{ __('navigation-dropdown.Policy and Procedure') }} &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                                </x-jet-nav-link>
                            @elseif(auth()->user()->registration_type == 'Supplier')
                                <x-jet-nav-link href="{{ route('policyProcedure.supplier') }}" target="_blank" :active="request()->routeIs('policyProcedure.supplier')">
                                    {{ __('navigation-dropdown.Policy and Procedure') }} &nbsp;<img src="{{ url('complete_check.jpg') }}" class="w-4 inline">
                                </x-jet-nav-link>
                            @endif
                        @endif--}}

                        @if (auth()->user()->hasRole('SuperAdmin'))
                            <x-jet-nav-link href="{{ route('packages.index') }}" :active="request()->routeIs('subscription')">
                                {{ __('navigation-dropdown.Subscription') }}
                            </x-jet-nav-link>
                        @endif
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @role('SC Specialist')
                    @php $rfqs = \App\Models\EOrderItems::with('qoutes')->doesntHave('qoutes')->count(); @endphp
                    <span title="Number of RFQs which received no quotations">RFQs with no Quotations: &nbsp;<a href="{{route('RFQsWithNoQuotations')}}" style="padding-right: 10px;"><span class="text-blue-600 hover:underline">{{$rfqs}}</span></a></span>
                    @endrole

                    @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                        @php
                            $business_cate = \App\Models\BusinessCategory::where('business_id', auth()->user()->business_id)->get();
                            if ($business_cate->isNotEmpty()) {
                                foreach ($business_cate as $item) {
                                    $business_categories[] = (int)$item->category_number;
                                }
                            }
                            sort($business_categories);
                            // Counting NEW RFQs for multiple categories for supplier
                            $rfqCount = \App\Models\EOrderItems::where(['status' => 'pending', 'rfq_type' => 1])->where('bypass', 0)->whereDate('quotation_time', '>=', \Carbon\Carbon::now())->whereIn('item_code', $business_categories)->count();
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
                            if (count($eOrders) > 0)
                            {
                                $quote = \App\Models\Qoute::where(['e_order_id' => $eOrders[0]->id, 'supplier_business_id' => auth()->user()->business_id])->first();
                            }
                        @endphp
                        <span title="{{__('navigation-dropdown.Number of New Requisitions(s) received against multiple categories')}}">{{ __('navigation-dropdown.Multiple Categories RFQ')}}: &nbsp;<a href="{{route('viewRFQs')}}"><span style="padding-left: 7px;" @if($rfqCount > 0) class="text-green-600 hover:underline"
                                                                                                                                                                                                  @else class="text-red-600 hover:underline" @endif>{{$rfqCount}}</span></a></span>
                        <span title="{{__('navigation-dropdown.Number of New Requisitions(s) received against single category')}}">{{ __('navigation-dropdown.Single Category RFQ')}}: &nbsp;<a href="{{route('singleCategoryRFQs')}}"><span style="padding-left: 7px;" @if(count($eOrders) > 0 && !isset($quote)) class="text-green-600 hover:underline"
                                                                                                                                                                                                    @else class="text-red-600 hover:underline" @endif>@if(count($eOrders) > 0 && !isset($quote)) {{count(array_unique($eOrders))}} @else 0 @endif</span></a></span>
                    @endif

                    @if(auth()->user()->hasRole('CEO|Buyer Create New RFQ') && auth()->user()->registration_type == 'Buyer' && auth()->user()->status == 3)
                        @php
                            $multiPlacedRFQ = \App\Models\Qoute::where(['business_id' => auth()->user()->business_id, 'status' => 'pending' ,'rfq_type' => 1])->count();
                            $singlePlacedRFQ = \App\Models\Qoute::where(['business_id' => auth()->user()->business_id, 'status' => 'pending' ,'rfq_type' => 0])->get();
                        @endphp
                        <span title="{{__('navigation-dropdown.Number of New Quotation(s) received against multiple categories')}}">{{ __('navigation-dropdown.Multiple Categories Quotations')}}: &nbsp;<a href="{{route('QoutationsBuyerReceived')}}"><span style="padding-left: 7px;" @if($multiPlacedRFQ > 0) class="text-green-600 hover:underline"
                                                                                                                                                                                                                              @else class="text-red-600 hover:underline" @endif>{{$multiPlacedRFQ}}</span></a></span>
                        <span title="{{__('navigation-dropdown.Number of New Quotation(s) received against single category')}}">{{ __('navigation-dropdown.Single Category Quotations')}}: &nbsp;<a href="{{route('singleCategoryBuyerRFQs')}}"><span style="padding-left: 7px;" @if(count($singlePlacedRFQ) > 0) class="text-green-600 hover:underline"
                                                                                                                                                                                                                      @else class="text-red-600 hover:underline" @endif>{{count($singlePlacedRFQ->unique('e_order_id'))}}</span></a></span>
                    @endif
{{--                    @cannot('all')--}}
{{--                        <a onclick="language(0, 'en')" class="get-started-btn scrollto" style="cursor: pointer"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top: -4px;">English</a>--}}
                    {{-- Added below if condition because of POST method being used and POST is not able to redirect --}}
                    @if(request()->routeIs('invoicePayment.stepOne'))
                        <a href="{{route('languageChangeForPayment', ['lang' => 'en', 'rtl_value' => 0])}}" class="get-started-btn scrollto" style="cursor: pointer"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top: -4px;">English</a>
                    @elseif(request()->routeIs('businessPackage.stepOne'))
                        <a href="{{route('languageChangeForPackagePayment', ['lang' => 'en', 'rtl_value' => 0])}}" class="get-started-btn scrollto" style="cursor: pointer"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top: -4px;">English</a>
                    @else
                        <a href="{{route('languageChange', ['lang' => 'en', 'rtl_value' => 0])}}" class="get-started-btn scrollto" style="cursor: pointer"><img alt="" src="{{url('us.png')}}" style="margin-right: 2px;margin-top: -4px;">English</a>
                    @endif
{{--                    @endcannot--}}
                    <div x-data="{ notificationOpen: false }" class="relative">
                        <button @click="notificationOpen = ! notificationOpen" class="flex mx-4 text-gray-600 focus:outline-none">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <div x-show="notificationOpen" @click="notificationOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                        <div x-show="notificationOpen" class="absolute left-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10" style="width:20rem;">
                            {{--                            <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">--}}
                            {{--                                <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">--}}
                            {{--                                <p class="text-sm mx-2">--}}
                            {{--                                    <span class="font-bold" href="#">Sara Salah</span> replied on the <span class="font-bold text-indigo-400" href="#">Upload Image</span> artical . 2m--}}
                            {{--                                </p>--}}
                            {{--                            </a>--}}
                            {{--                            <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">--}}
                            {{--                                <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80" alt="avatar">--}}
                            {{--                                <p class="text-sm mx-2">--}}
                            {{--                                    <span class="font-bold" href="#">Slick Net</span> start following you . 45m--}}
                            {{--                                </p>--}}
                            {{--                            </a>--}}
                            {{--                            <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">--}}
                            {{--                                <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1450297350677-623de575f31c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">--}}
                            {{--                                <p class="text-sm mx-2">--}}
                            {{--                                    <span class="font-bold" href="#">Jane Doe</span> Like Your reply on <span class="font-bold text-indigo-400" href="#">Test with TDD</span> artical . 1h--}}
                            {{--                                </p>--}}
                            {{--                            </a>--}}
                            {{--                            <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">--}}
                            {{--                                <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=398&q=80" alt="avatar">--}}
                            {{--                                <p class="text-sm mx-2">--}}
                            {{--                                    <span class="font-bold" href="#">Abigail Bennett</span> start following you . 3h--}}
                            {{--                                </p>--}}
                            {{--                            </a>--}}
                        </div>
                    </div>
                    <x-jet-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                                </button>

                            @else
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('navigation-dropdown.Business Info Management') }}
                            </div>
                            <div class="border-t border-gray-100"></div>
                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('navigation-dropdown.Profile') }}
                            </x-jet-dropdown-link>


                            @can('all')
                                <div class="border-t border-gray-100"></div>
                                <x-jet-responsive-nav-link href="{{ route('log.viewer') }}" :active="request()->routeIs('log.viewer')">
                                    {{ __('navigation-dropdown.Log Viewer') }}
                                </x-jet-responsive-nav-link>

                                <div class="border-t border-gray-100"></div>
                                <x-jet-responsive-nav-link href="{{ route('user_logs') }}" :active="request()->routeIs('user_logs')">
                                    {{ __('navigation-dropdown.User Logs') }}
                                </x-jet-responsive-nav-link>
                            @endcan

                            @can('all')
                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('downloads') }}">
                                    {{ __('navigation-dropdown.Downloads') }}
                                </x-jet-dropdown-link>
                            @endcan

                            @php
                                $isBusinessDataExist = \App\Models\Business::where('user_id', Auth::user()->id)->first();
                                if ($isBusinessDataExist) {
                                    $isBusinessPOIExist = \App\Models\POInfo::where('business_id', $isBusinessDataExist->id)->first();
                                }
                            @endphp
                            @if (auth()->user()->hasRole('CEO') && Auth::user()->registration_type != null)
                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('business.create') }}">
                                    @if(isset(auth()->user()->business->business_name))
                                        {{ auth()->user()->business->business_name . ' ' . __('navigation-dropdown.Info') }}
                                    @else
                                        {{ __('navigation-dropdown.Business') }}
                                    @endif
                                </x-jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>
                                @if($isBusinessDataExist)
                                    <x-jet-dropdown-link href="{{ route('certificateView') }}">
                                        {{ __('navigation-dropdown.Update Certificates') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>
                                @if (isset($isBusinessPOIExist))
                                    <x-jet-dropdown-link href="{{ route('purchaseOrderInfo.show', $isBusinessPOIExist->id) }}">
                                        {{ __('navigation-dropdown.P.O. Info') }}
                                    </x-jet-dropdown-link>
                                @else
                                    <x-jet-dropdown-link href="{{ route('purchaseOrderInfo.create') }}">
                                        {{ __('navigation-dropdown.P.O. Info') }}
                                    </x-jet-dropdown-link>
                                @endif
                            @endif

                            @if (auth()->user()->status == 3 && auth()->user()->hasRole('CEO|SuperAdmin'))

                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('packages.index') }}">
                                    {{ __('navigation-dropdown.Subscription') }}
                                </x-jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('users.index') }}">
                                    {{ __('navigation-dropdown.Current Users') }}
                                </x-jet-dropdown-link>

                                @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('CEO') && auth()->user()->status == 3 || auth()->user()->hasRole('CEO') && auth()->user()->status == null)

                                    @if (auth()->user()->business_id)
                                        <div class="border-t border-gray-100"></div>
                                        <x-jet-dropdown-link href="{{ route('users.create') }}">
                                            {{ __('navigation-dropdown.Add User') }}
                                        </x-jet-dropdown-link>
                                    @endif
                                @endif
                            @endif

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('navigation-dropdown.API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Management -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('navigation-dropdown.Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('navigation-dropdown.Team Settings') }}
                                </x-jet-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                        {{ __('navigation-dropdown.Create New Team') }}
                                    </x-jet-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('navigation-dropdown.Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-jet-switchable-team :team="$team"/>
                                @endforeach

                                <div class="border-t border-gray-100"></div>
                            @endif
                            @if (auth()->user()->usertype != 'CEO')
                                <x-jet-dropdown-link href="{{ route('arabic.policyProcedure.eula') }}" target="_blank" :active="request()->routeIs('policyProcedure.eula')">
                                    {{ __('navigation-dropdown.Policy and Procedure') }}
                                </x-jet-dropdown-link>
                            @endif

                            @if (auth()->user()->usertype == 'CEO')
                                @if(auth()->user()->registration_type == 'Buyer')
                                    <x-jet-dropdown-link href="{{ route('arabic.policyProcedure.buyer') }}" target="_blank" :active="request()->routeIs('policyProcedure.buyer')">
                                        {{ __('navigation-dropdown.Policy and Procedure') }}
                                    </x-jet-dropdown-link>
                                @elseif(auth()->user()->registration_type == 'Supplier')
                                    <x-jet-dropdown-link href="{{ route('arabic.policyProcedure.supplier') }}" target="_blank" :active="request()->routeIs('policyProcedure.supplier')">
                                        {{ __('navigation-dropdown.Policy and Procedure') }}
                                    </x-jet-dropdown-link>
                                @endif
                            @endif

                        <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('navigation-dropdown.Logout') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
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
                    {{ __('navigation-dropdown.Dashboard') }}
                </x-jet-responsive-nav-link>

                @if(auth()->user()->hasRole('CEO') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                    <a @if($rfqCount > 0) class="block pl-3 pr-4 py-2 border-l-4 border-green-400 text-base font-medium text-green-700 bg-green-50 focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out"
                       @else class="block pl-3 pr-4 py-2 border-l-4 border-red-400 text-base font-medium text-red-700 bg-red-50 focus:outline-none focus:text-red-800 focus:bg-red-100 focus:border-red-700 transition duration-150 ease-in-out" @endif href="{{ route('viewRFQs') }}">
                        {{ __('navigation-dropdown.Multiple Categories RFQ')}}: &nbsp; {{ $rfqCount }}
                    </a>
                    <a @if(count($eOrders) > 0 && !isset($quote)) class="block pl-3 pr-4 py-2 border-l-4 border-green-400 text-base font-medium text-green-700 bg-green-50 focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out"
                       @else class="block pl-3 pr-4 py-2 border-l-4 border-red-400 text-base font-medium text-red-700 bg-red-50 focus:outline-none focus:text-red-800 focus:bg-red-100 focus:border-red-700 transition duration-150 ease-in-out" @endif href="{{ route('singleCategoryRFQs') }}">
                        {{ __('navigation-dropdown.Single Category RFQ')}}: &nbsp; @if(count($eOrders) > 0 && !isset($quote)) {{count(array_unique($eOrders))}} @else 0 @endif
                    </a>
                @endif

                @if(auth()->user()->hasRole('CEO|Buyer Create New RFQ') && auth()->user()->registration_type == 'Buyer' && auth()->user()->status == 3)
                    <a @if($multiPlacedRFQ > 0) class="block pl-3 pr-4 py-2 border-l-4 border-green-400 text-base font-medium text-green-700 bg-green-50 focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out"
                       @else class="block pl-3 pr-4 py-2 border-l-4 border-red-400 text-base font-medium text-red-700 bg-red-50 focus:outline-none focus:text-red-800 focus:bg-red-100 focus:border-red-700 transition duration-150 ease-in-out" @endif href="{{ route('QoutationsBuyerReceived') }}">
                        {{ __('navigation-dropdown.Multiple Categories Quotations')}}: &nbsp; {{ $multiPlacedRFQ }}
                    </a>
                    <a @if(count($singlePlacedRFQ) > 0) class="block pl-3 pr-4 py-2 border-l-4 border-green-400 text-base font-medium text-green-700 bg-green-50 focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out"
                       @else class="block pl-3 pr-4 py-2 border-l-4 border-red-400 text-base font-medium text-red-700 bg-red-50 focus:outline-none focus:text-red-800 focus:bg-red-100 focus:border-red-700 transition duration-150 ease-in-out" @endif href="{{ route('singleCategoryBuyerRFQs') }}">
                        {{ __('navigation-dropdown.Single Category Quotations')}}: &nbsp; {{ count($singlePlacedRFQ->unique('e_order_id')) }}
                    </a>
                @endif

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
                        {{ __('navigation-dropdown.Profile') }}
                    </x-jet-responsive-nav-link>

                    @can('all')
                        <x-jet-responsive-nav-link href="{{ route('log.viewer') }}" :active="request()->routeIs('log.viewer')">
                            {{ __('navigation-dropdown.Log Viewer') }}
                        </x-jet-responsive-nav-link>

                        <div class="border-t border-gray-100"></div>
                        <x-jet-responsive-nav-link href="{{ route('user_logs') }}" :active="request()->routeIs('user_logs')">
                            {{ __('navigation-dropdown.User Logs') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    @if (auth()->user()->hasRole('CEO') && Auth::user()->registration_type != null)
                        <div class="border-t border-gray-100"></div>
                        <x-jet-dropdown-link href="{{ route('business.create') }}">
                            @if(isset(auth()->user()->business->business_name))
                                {{ auth()->user()->business->business_name . ' ' . __('navigation-dropdown.Info') }}
                            @else
                                {{ __('navigation-dropdown.Business') }}
                            @endif
                        </x-jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>
                        @if($isBusinessDataExist)
                            <x-jet-dropdown-link href="{{ route('certificateView') }}">
                                {{ __('navigation-dropdown.Update Certificates') }}
                            </x-jet-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>
                        @if (isset($isBusinessPOIExist))
                            <x-jet-dropdown-link href="{{ route('purchaseOrderInfo.show', $isBusinessPOIExist->id) }}">
                                {{ __('navigation-dropdown.P.O. Info') }}
                            </x-jet-dropdown-link>
                        @else
                            <x-jet-dropdown-link href="{{ route('purchaseOrderInfo.create') }}">
                                {{ __('navigation-dropdown.P.O. Info') }}
                            </x-jet-dropdown-link>
                        @endif
                    @endif

                    @if (auth()->user()->status == 3 && auth()->user()->hasRole('CEO|SuperAdmin'))
                        <div class="border-t border-gray-100"></div>
                        <x-jet-dropdown-link href="{{ route('packages.index') }}">
                            {{ __('navigation-dropdown.Subscription') }}
                        </x-jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>
                        <x-jet-dropdown-link href="{{ route('users.index') }}">
                            {{ __('navigation-dropdown.Current Users') }}
                        </x-jet-dropdown-link>

                        @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('CEO') && auth()->user()->status == 3 || auth()->user()->hasRole('CEO') && auth()->user()->status == null)

                            @if (auth()->user()->business_id)
                                <div class="border-t border-gray-100"></div>
                                <x-jet-dropdown-link href="{{ route('users.create') }}">
                                    {{ __('navigation-dropdown.Add User') }}
                                </x-jet-dropdown-link>
                            @endif
                        @endif
                    @endif

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('navigation-dropdown.API Tokens') }}
                        </x-jet-responsive-nav-link>
                    @endif

                    @if (auth()->user()->usertype != 'CEO')
                        <x-jet-dropdown-link href="{{ route('arabic.policyProcedure.eula') }}" target="_blank" :active="request()->routeIs('policyProcedure.eula')">
                            {{ __('navigation-dropdown.Policy and Procedure') }}
                        </x-jet-dropdown-link>
                    @endif

                    @if (auth()->user()->usertype == 'CEO')
                        @if(auth()->user()->registration_type == 'Buyer')
                            <x-jet-dropdown-link href="{{ route('arabic.policyProcedure.buyer') }}" target="_blank" :active="request()->routeIs('policyProcedure.buyer')">
                                {{ __('navigation-dropdown.Policy and Procedure') }}
                            </x-jet-dropdown-link>
                        @elseif(auth()->user()->registration_type == 'Supplier')
                            <x-jet-dropdown-link href="{{ route('arabic.policyProcedure.supplier') }}" target="_blank" :active="request()->routeIs('policyProcedure.supplier')">
                                {{ __('navigation-dropdown.Policy and Procedure') }}
                            </x-jet-dropdown-link>
                        @endif
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('navigation-dropdown.Logout') }}
                        </x-jet-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('navigation-dropdown.Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                            {{ __('navigation-dropdown.Team Settings') }}
                        </x-jet-responsive-nav-link>

                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('navigation-dropdown.Create New Team') }}
                        </x-jet-responsive-nav-link>

                        <div class="border-t border-gray-200"></div>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('navigation-dropdown.Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link"/>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </nav>
@endif

{{--<script>
    function language(rtl_value, lang) {
        $.ajax({
--}}{{--            url: "{{route('languageChange')}}",--}}{{--
            method: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                rtl_value: rtl_value,
                lang: lang,
            },
            success: function () {
                window.location.reload();
            },
            // error: function(result){
            //     console.log('error');
            // }
        });
    }
</script>--}}
