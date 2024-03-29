@role('CEO')
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

        {{-- Message Before and After Resistration --}}
        @if(Auth::user()->status == 0 || Auth::user()->status == null )
            <div class="text-black text-2xl">

                @if (auth()->user()->rtl == 0)
                    <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto mb-4 m-auto"/>
                @else
                    <img src="{{url('registration_step/2.png')}}" alt="User Registration" class="block w-auto mb-4 m-auto"/>
                @endif
                    {{__('portal.Thank you for signing up! Your email address has been verified.')}}
                <livewire:sendsms />

                @if(auth()->user()->mobile_verify == 1)
                    @php
                        $isBusinessDataExist = \App\Models\Business::where('user_id', Auth::user()->id)->first();
                        if ($isBusinessDataExist) {
                            $isBusinessWarehouseDataExist = \App\Models\BusinessWarehouse::where('business_id', $isBusinessDataExist->id)->first();
                            $isBusinessPOIExist = \App\Models\POInfo::where('business_id', $isBusinessDataExist->id)->first();
                        }
                    @endphp
                    <br>{{__('portal.Now you need to fill up the')}}
                        @if(is_null($isBusinessDataExist))
                            {{__('portal.business')}} {{__('portal.registration form before adding any user/s.')}}
                        @elseif(is_null($isBusinessWarehouseDataExist))
                            {{__('portal.warehouse')}} {{__('portal.registration form.')}}
                        @elseif(is_null($isBusinessPOIExist))
                            {{__('portal.P.O. Info')}} {{__('portal.registration form.')}}
                        @endif
                @endif
                {{--@else
                    <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto mb-4 m-auto"/>
                    نشكرك لتسجيلك معنا
                    !
                    تم تفعيل بريدك الإلكتروني بنجاح. <br>
                    بإمكانك الآن تعبئة بيانات استمارة نشاطك التجاري قبل إضافة أي من المستخدمين.
                @endif--}}
            </div>
        @elseif(Auth::user()->status == 1 && Auth::user()->registration_type == "Buyer")

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">

                @if (auth()->user()->rtl == 0)

                {{__('portal.Welcome')}} {{ auth()->user()->gender == "Male" ? __('portal.Mr.') . ' ' .Auth::user()->name: __('portal.Mrs.'). ' ' .Auth::user()->name}}

                    <span class="float-right text-red-900 font-bold">{{(isset(Auth::user()->status) == 1)?'Under process':'Incomplete'}}</span>
                    <span class=" float-right text-black-600 font-bold">{{__('portal.Account Status')}}:&nbsp;&nbsp;</span>
                    <img src="{{url('registration_step/E-3.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
                @else
                    {{__('portal.Welcome')}} {{ auth()->user()->gender == "Male" ? __('portal.Mr.') . ' ' .Auth::user()->name: __('portal.Mrs.'). ' ' .Auth::user()->name}}

                    <span class="float-left text-red-900 font-bold">{{(isset(Auth::user()->status) == 1)?'قيد الإنشاء':'غير مكتمل'}}</span>
                    <span class=" float-left text-black-600 font-bold">{{__('portal.Account Status')}}:&nbsp;&nbsp;</span>

                    <img src="{{url('registration_step/3.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
                @endif

            </h2>
            <div class="mt-6 text-black text-2xl">

                    <div class="text-2xl text-center font-bold">
                        {{__('portal.business')}}: {{ Auth::user()->business->business_name }}<br>
                    </div>
                    <p class="m-2 font-bold">{{__('portal.Welcome to Emdad platform')}}! </p>
                    <p class="font-bold m-2 text-justify">{{__('portal.Thank you for choosing our digital platform for your procurement & supply chain solution.')}}</p>
                    <p class="text-blue-900 font-bold m-2 text-justify">{{__('portal.At the moment your application is under review. You will receive a reply from us within a few hours to a maximum of 10 working days, depending upon our workload.')}}</p>
                    <p class="m-2">{{__('portal.Hopefully, soon we will be sharing with you our expertise in procurement & supply chain management which could')}}:</p>
                    <ol class="list-decimal ml-12 text-indigo-900 font-bold">
                        <li>{{__('portal.Save you a huge amount depending on the size of your purchases.')}}</li>
                        <li>{{__('portal.Help to solve the bottlenecks involved in the supply chain.')}}</li>
                        <li>{{__('portal.Streamline the return system (for defective or unwanted products).')}}</li>
                    </ol>

            </div>

        @elseif(Auth::user()->status == 1 && Auth::user()->registration_type == "Supplier")
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @if (auth()->user()->rtl == 0)
                    {{__('portal.Welcome')}} {{ auth()->user()->gender == "Male" ? __('portal.Mr.') . ' ' .Auth::user()->name: __('portal.Mrs.'). ' ' .Auth::user()->name}}

                    <span class="float-right text-red-900 font-bold">{{(isset(Auth::user()->status) == 1)?'Under process':'Incomplete'}}</span>
                    <span class=" float-right text-black-600 font-bold">{{__('portal.Account Status')}}:&nbsp;&nbsp;</span>
                    <img src="{{url('registration_step/E-3.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
                @else
                    {{__('portal.Welcome')}} {{ auth()->user()->gender == "Male" ? __('portal.Mr.') . ' ' .Auth::user()->name: __('portal.Mrs.'). ' ' .Auth::user()->name}}

                    <span class="float-left text-red-900 font-bold">{{(isset(Auth::user()->status) == 1)?'قيد الإنشاء':'غير مكتمل'}}</span>
                    <span class=" float-left text-black-600 font-bold">{{__('portal.Account Status')}}:&nbsp;&nbsp;</span>
                    <img src="{{url('registration_step/3.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
                @endif
            </h2>
            <div class="mt-6 text-black text-2xl">
                <div class="text-2xl text-center font-bold">
                    {{__('portal.business')}}: {{ Auth::user()->business->business_name }}<br>
                </div>
                <p class="m-2 font-bold">{{__('portal.Welcome to Emdad platform')}}! </p>
                <p class="font-bold m-2 text-justify">{{__('portal.Thank you for choosing our digital platform for your sales & supply chain solution.')}}</p>
                <p class="text-blue-900 font-bold m-2 text-justify">{{__('portal.At the moment your application is under review. You will receive a reply from us within a few hours to a maximum of 10 working days, depending upon our workload.')}}</p>
                <p class="m-2">{{__('portal.Hopefully, soon we will be sharing with you our expertise in sales & supply chain management which could')}}:</p>
                <ol class="list-decimal ml-12 text-indigo-900 font-bold">
                    <li>{{__('portal.Bring you more business volume.')}}</li>
                    <li>{{__('portal.Streamline your suppliers as well.')}}</li>
                    <li>{{__('portal.Bring down cost of production and time.')}}</li>
                    <li>{{__('portal.Help to solve the bottlenecks involved in the supply chain.')}}</li>
                </ol>
            </div>
        @elseif (Auth::user()->status == 'Approved')
            <h1>{{__('portal.Business is Approved')}}</h1>
        @elseif (Auth::user()->status == 'Rejected')
            <h1>{{__('portal.Your Business is rejected')}}</h1>
        @endif

    </div>
@endrole
