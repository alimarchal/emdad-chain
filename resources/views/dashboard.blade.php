<x-app-layout>
    @if (session()->has('error'))
        <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
            @if(auth()->user()->rtl == 0)
                <strong class="mr-1">{{ session('error') }}</strong>
            @else
                <strong class="mr-3">{{ session('error') }}</strong>
            @endif
            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
            </button>
        </div>

    @elseif (session()->has('message'))
        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
            @if(auth()->user()->rtl == 0)
                <strong class="mr-1">{{ session('message') }}</strong>
            @else
                <strong class="mr-3">{{ session('message') }}</strong>
            @endif
            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('dashboard.Dashboard') }} - Welcome {{ auth()->user()->gender == "Male" ?'Mr. ' . Auth::user()->name: 'Mrs.'. Auth::user()->name}}

            <span class="float-right text-red-900 font-bold">{{(isset(Auth::user()->status) == 1)?'Under process':'InComplete'}}</span>
            <span class=" float-right text-black-600 font-bold">Account Status:&nbsp;&nbsp;</span>

        </h2>
    </x-slot>

@role('SuperAdmin')
    <div class="mt-4">
        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700"><a href="{{route('users.index')}}">{{number_format(\App\Models\User::all()->count())}}</a></h4>
                        <div class="text-gray-500">{{ __('dashboard.Total User')}}</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-orange-600 bg-opacity-75">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{\App\Models\Business::all()->count()}}</h4>
                        <div class="text-gray-500">{{ __('dashboard.Total Business')}}</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{\App\Models\BusinessCategory::where('business_id',auth()->user()->business_id)->count() }}  </h4>
                        <div class="text-gray-500">{{ __('dashboard.Received RFQ')}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endrole

    @if(Auth::user()->status == 3 && (Auth::user()->registration_type == "Buyer" || auth()->user()->can('Buyer View Quotations') || auth()->user()->can('Buyer View Quotations') || auth()->user()->can('Buyer DPO Approval') || auth()->user()->can('Buyer View Purchase Orders')) && auth()->user()->business->status == 3)

        <div class="mt-4">
            <div class="flex flex-wrap -mx-6">

                <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-opacity-75">
                            <img src="{{url('requisitions.jpeg')}}" style="height: 40px;width:40px;">
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700" @if(auth()->user()->rtl == 1) style=" font-family: sans-serif;" @endif> {{number_format(\App\Models\EOrders::where(['business_id' => auth()->user()->business_id])->count())}}</h4>
                            <div class="text-gray-500">{{ __('dashboard.Total RFQs')}}</div>
                        </div>
                    </div>
                </div>

                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-opacity-75">
                            <img src="{{url('quotations.jpeg')}}" style="height: 40px;width:40px;">
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700" @if(auth()->user()->rtl == 1) style=" font-family: sans-serif;" @endif>{{number_format(\App\Models\Qoute::where(['business_id' => auth()->user()->business_id])->count())}}</h4>
                            <div class="text-gray-500">{{ __('dashboard.Total Quotation(s)')}}</div>
                        </div>
                    </div>
                </div>

                <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-opacity-75">
                            <img src="{{url('purchaseOrders.jpeg')}}" style="height: 40px;width:40px;">
                        </div>

                        <div class="mx-5">
                            @php
                                $draftPurchaseOrders = \App\Models\DraftPurchaseOrder::where(['business_id' => auth()->user()->business_id])
                                                                                                        ->where('status', '!=', 'pending')
                                                                                                        ->get();
                                    $multiCategory = array();
                                    $singleCategory = array();
                                    foreach ($draftPurchaseOrders as $draftPurchaseOrder)
                                    {
                                        if ($draftPurchaseOrder['rfq_type'] == 1)
                                        {
                                            $multiCategory[] = $draftPurchaseOrder;
                                        }
                                        if ($draftPurchaseOrder['rfq_type'] == 0)
                                        {
                                            $singleCategory[] = $draftPurchaseOrder;
                                        }
                                    }
                                    $multiCategoryCollection = collect($multiCategory);
                                    $singleCategoryCollection = collect($singleCategory);
                                    $singleCategoryInvoices = $singleCategoryCollection->unique('rfq_no');
                                    $dpos = $multiCategoryCollection->merge($singleCategoryInvoices);
                            @endphp
                            <h4 class="text-2xl font-semibold text-gray-700" @if(auth()->user()->rtl == 1) style=" font-family: sans-serif;" @endif>{{count($dpos) }}
                            </h4>
                            <div class="text-gray-500">{{ __('dashboard.Total Purchase Order(s)') }}</div>
                        </div>
                    </div>
                </div>

                <div class="w-full mt-6 px-6 pt-3 sm:w-1/2 xl:w-1/3 xl:mt-0">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                        <div class="p-3 rounded-full bg-opacity-75">
                            @if(auth()->user()->rtl == 0)
                                <img src="{{url('shipmentDelivered.jpeg')}}" style="height: 40px;width:40px;">
                            @else
                                <img src="{{url('shipmentDelivered.jpeg')}}" style="height: 40px;width:40px;">
                            @endif
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700" @if(auth()->user()->rtl == 1) style=" font-family: sans-serif;" @endif>{{\App\Models\Shipment::where(['buyer_business_id' => auth()->user()->business_id , 'status' => 1])->count() }}
                            </h4>
                            <div class="text-gray-500">{{ __('dashboard.Total Shipments Delivered') }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    @elseif(Auth::user()->status == 3 && Auth::user()->registration_type == "Supplier" && auth()->user()->business->status == 3)

            <div class="mt-4">
                <div class="flex flex-wrap -mx-6">

                    <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                            <div class="p-3 rounded-full bg-opacity-75">
                                <img src="{{url('quotations.jpeg')}}" style="height: 40px;width:40px;">
                            </div>

                            <div class="mx-5">
                                @php
                                    $totalQuotes = \App\Models\Qoute::where(['supplier_business_id' => auth()->user()->business_id])
                                                                                                            ->get();
                                        $multiCategory = array();
                                        $singleCategory = array();
                                        foreach ($totalQuotes as $quote)
                                        {
                                            if ($quote['rfq_type'] == 1)
                                            {
                                                $multiCategory[] = $quote;
                                            }
                                            if ($quote['rfq_type'] == 0)
                                            {
                                                $singleCategory[] = $quote;
                                            }
                                        }
                                        $multiCategoryCollection = collect($multiCategory);
                                        $singleCategoryCollection = collect($singleCategory);
                                        $singleCategoryInvoices = $singleCategoryCollection->unique('e_order_id');
                                        $totalQuotes = $multiCategoryCollection->merge($singleCategoryInvoices);
                                @endphp
                                <h4 class="text-2xl font-semibold text-gray-700" @if(auth()->user()->rtl == 1) style=" font-family: sans-serif;" @endif>{{count($totalQuotes)}}</h4>
                                <div class="text-gray-500">{{ __('dashboard.Total Quotation(s)')}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                            <div class="p-3 rounded-full bg-opacity-75">
                                <img src="{{url('canceledQuotations.png')}}" style="height: 40px;width:40px;">
                            </div>

                            <div class="mx-5">
                                @php
                                    $quotes = \App\Models\Qoute::where(['supplier_business_id' => auth()->user()->business_id])->where('qoute_status_updated' , 'Rejected')->get();

                                    $multiCategory = array();
                                    $singleCategory = array();
                                    foreach ($quotes as $quote)
                                    {
                                        if ($quote['rfq_type'] == 1)
                                        {
                                            $multiCategory[] = $quote;
                                        }
                                        if ($quote['rfq_type'] == 0)
                                        {
                                            $singleCategory[] = $quote;
                                        }
                                    }
                                    $multiCategoryCollection = collect($multiCategory);
                                    $singleCategoryCollection = collect($singleCategory);
                                    $singleCategoryInvoices = $singleCategoryCollection->unique('e_order_id');
                                    $rejectedQuotes = $multiCategoryCollection->merge($singleCategoryInvoices);
                                @endphp
                                <h4 class="text-2xl font-semibold text-gray-700" @if(auth()->user()->rtl == 1) style=" font-family: sans-serif;" @endif>{{ count($rejectedQuotes) }}
                                </h4>
                                <div class="text-gray-500">{{ __('dashboard.Quotation(s) Rejected') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                            <div class="p-3 rounded-full bg-opacity-75">
                                <img src="{{url('purchaseOrders.jpeg')}}" style="height: 40px;width:40px;">
                            </div>

                            <div class="mx-5">
                                @php
                                    $purchaseOrders = \App\Models\DraftPurchaseOrder::where(['supplier_business_id' => auth()->user()->business_id])
                                                                                                            ->where('status', '!=', 'pending')
                                                                                                            ->where('status', '!=', 'cancel')
                                                                                                            ->get();
                                        $multiCategory = array();
                                        $singleCategory = array();
                                        foreach ($purchaseOrders as $purchaseOrder)
                                        {
                                            if ($purchaseOrder['rfq_type'] == 1)
                                            {
                                                $multiCategory[] = $purchaseOrder;
                                            }
                                            if ($purchaseOrder['rfq_type'] == 0)
                                            {
                                                $singleCategory[] = $purchaseOrder;
                                            }
                                        }
                                        $multiCategoryCollection = collect($multiCategory);
                                        $singleCategoryCollection = collect($singleCategory);
                                        $singleCategoryInvoices = $singleCategoryCollection->unique('rfq_no');
                                        $pos = $multiCategoryCollection->merge($singleCategoryInvoices);
                                @endphp
                                <h4 class="text-2xl font-semibold text-gray-700" @if(auth()->user()->rtl == 1) style=" font-family: sans-serif;" @endif>{{number_format(count($pos))}}</h4>
                                <div class="text-gray-500">{{ __('dashboard.Total Purchase Order(s)')}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mt-6 px-6 pt-3 sm:w-1/2 xl:w-1/3 xl:mt-0">
                        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                            <div class="p-3 rounded-full bg-opacity-75">
                                @if(auth()->user()->rtl == 0)
                                    <img src="{{url('shipmentDelivered.jpeg')}}" style="height: 40px;width:40px;">
                                @else
                                    <img src="{{url('shipmentDelivered.jpeg')}}" style="height: 40px;width:40px;">
                                @endif
                            </div>

                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700" @if(auth()->user()->rtl == 1) style=" font-family: sans-serif;" @endif>{{\App\Models\Shipment::where(['supplier_business_id' => auth()->user()->business_id , 'status' => 1])->count() }}
                                </h4>
                                <div class="text-gray-500">{{ __('dashboard.Total Shipments Delivered') }}</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <x-jet-welcome />
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
