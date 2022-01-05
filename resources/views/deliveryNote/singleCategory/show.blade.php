@if(auth()->user()->rtl == 0)
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h3 class="text-2xl text-center"><strong>{{__('portal.Delivery Note')}}</strong></h3>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.P.O.')}} -{{ $draftPurchaseOrders[0]->id }}<br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $draftPurchaseOrders[0]->rfq_no }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                {{ $record->name }} , {{ $parent->name }}
                                <br>
                                <strong>{{__('portal.Quote')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                                <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @if($draftPurchaseOrders[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                @elseif($draftPurchaseOrders[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                @elseif($draftPurchaseOrders[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                @elseif($draftPurchaseOrders[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                @elseif($draftPurchaseOrders[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                @elseif($draftPurchaseOrders[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                @endif
                                <br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $supplierBusiness = \App\Models\Business::where('id', $draftPurchaseOrders[0]->supplier_business_id)->first();
                                @endphp
                                <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                            {{--<div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            </div>--}}
                        </div>

                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Description')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.UOM')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Quantity')}}
                                    </th>
                                </tr>
                            </thead>
                            @foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="px-2 py-2 text-center text-sm text-black border border-black">
                                            {{ $draftPurchaseOrder->eOrderItem->description }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{ $draftPurchaseOrder->uom }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                            {{ $draftPurchaseOrder->quantity }}
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>

                        <br>
                        <br>
                        @if ($draftPurchaseOrders[0]->payment_term == 'Cash')

                            @php $proforma = \App\Models\Invoice::where('draft_purchase_order_id',$draftPurchaseOrder->id)->where('invoice_type', 1)->first();@endphp

                            @if (isset($proforma) && $proforma->invoice_status == 3)
                                <h2 class="text-2xl text-center font-bold">{{__('portal.Prepare Delivery Note')}}</h2>
                                <form action="{{ route('singleCategoryDeliveryNoteStore', $draftPurchaseOrders[0]->rfq_no) }}" method="post">
                                    @csrf
                                    <div class="grid grid-cols-12 gap-6">
                                        <div class="col-span-12">
                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                                {{__('portal.Delivery Address')}}
                                            </label>
                                            @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrders[0]->warehouse_id)->first(); @endphp

                                            <textarea class="form-textarea w-full" disabled>{{$delivery->address}}</textarea>

                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="city">{{__('portal.City')}}</label>
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" value="{{ $delivery->city }}" disabled="disabled">

                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="city">{{__('portal.Warranty')}}</label>
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" name="warranty">

                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">{{__('portal.Terms and Conditions')}}</label>
                                            <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-textarea w-full"></textarea>

                                            <input type="hidden" value="{{ $delivery->address }}" name="delivery_address">
                                            <input type="hidden" value="{{ $delivery->city }}" name="city">
                                        </div>
                                    </div>

                                    <div class="mt-5">
                                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                            {{__('portal.Create Delivery Note')}}
                                        </button>
                                    </div>
                                </form>
                            @elseif(isset($proforma))
                                <h2 class="text-2xl text-center font-bold">{{__('portal.Proforma invoice Generated')}}</h2>


                                    @if($proforma->invoice_status == 1)
                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-600 transition ease-in-out duration-150">
                                            {{__('portal.Note')}}: {{__('portal.Emdad verification pending')}}
                                        </a>
                                    @elseif($proforma->invoice_status == 2)
                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                            {{__('portal.Manual payment rejected')}}
                                        </a>
                                    @elseif($proforma->invoice_status == 3)
                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-red active:bg-green-600 transition ease-in-out duration-150">
                                            {{__('portal.Manual payment accepted')}}
                                        </a>
                                    @else
                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-600 transition ease-in-out duration-150">
                                            {{__('portal.Note')}}: {{__('portal.Waiting for payment by buyer')}}
                                        </a>
                                    @endif
                            @else
                                <a href="{{route('singleCategoryGenerateProformaInvoice', $draftPurchaseOrders[0]->rfq_no)}}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                    {{__('portal.Click here to generate proforma invoice')}}
                                </a>
                            @endif

                        @else
                            <h2 class="text-2xl text-center font-bold">{{__('portal.Prepare Delivery Note')}}</h2>
                            <form action="{{ route('singleCategoryDeliveryNoteStore', $draftPurchaseOrders[0]->rfq_no) }}" method="post">
                                @csrf
                                <div class="grid grid-cols-12 gap-6">

                                    <div class="col-span-12">
                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">{{__('portal.Delivery Address')}}</label>

                                        @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrders[0]->warehouse_id)->first(); @endphp

                                        <textarea class="form-textarea w-full" disabled>{{$delivery->address}}</textarea>

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="city">{{__('portal.City')}}</label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" value="{{ $delivery->city }}" disabled="disabled">

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="warranty">{{__('portal.Warranty')}}</label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="warranty" type="text" name="warranty">

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="terms_and_conditions">{{__('portal.Terms and Conditions')}}</label>
                                        <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-textarea w-full"></textarea>

                                        <input type="hidden" value="{{ $delivery->address }}" name="delivery_address">
                                        <input type="hidden" value="{{ $delivery->city }}" name="city">
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                        {{__('portal.Create Delivery Note')}}
                                    </button>
                                </div>
                            </form>
                        @endif

                        <div class="flex justify-between px-2 py-2 mt-2 h-15">
                            <div></div>
                            <div class="mt-3">{{__('portal.Thank you for using Emdad platform for your business.')}}</div>
                            <div></div>
                        </div>
                        <div class="flex justify-end px-2 py-2 h-15">
                            <div class="mt-2">{{__('portal.Copied to Emdad records')}}</div>
                            <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" style="margin-left: auto; margin-right: auto;"/></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </x-app-layout>
@else
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h3 class="text-2xl text-center"><strong>{{__('portal.Delivery Note')}}</strong></h3>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.P.O.')}}-<span style="font-family: sans-serif">{{ $draftPurchaseOrders[0]->id }}</span> <br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $draftPurchaseOrders[0]->created_at }}</span> <br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-<span style="font-family: sans-serif">{{ $draftPurchaseOrders[0]->rfq_no }}</span> <br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                {{ $record->name_ar }}@if(isset($parent)), {{ $parent->name_ar }} @endif
                                <br>
                                <strong>{{__('portal.Quote')}} #: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-<span style="font-family: sans-serif">{{ $draftPurchaseOrders[0]->qoute_no }}</span> <br>
                                <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @if($draftPurchaseOrders[0]->payment_term == 'Cash') {{__('portal.Cash')}}
                                @elseif($draftPurchaseOrders[0]->payment_term == 'Credit') {{__('portal.Credit')}}
                                @elseif($draftPurchaseOrders[0]->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                @elseif($draftPurchaseOrders[0]->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                @elseif($draftPurchaseOrders[0]->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                @elseif($draftPurchaseOrders[0]->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                @endif
                                <br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $supplierBusiness = \App\Models\Business::where('id', $draftPurchaseOrders[0]->supplier_business_id)->first();
                                @endphp
                                <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                            {{--<div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            </div>--}}
                        </div>

                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                            <tr>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                    #
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                    {{__('portal.Description')}}
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                    {{__('portal.UOM')}}
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                    {{__('portal.Quantity')}}
                                </th>
                            </tr>
                            </thead>
                            @foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                <tbody class="bg-white divide-y divide-black border-1 border-black">
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black" style="font-family: sans-serif">
                                        {{$loop->iteration}}
                                    </td>
                                    <td class="px-2 py-2 text-center text-sm text-black border border-black" style="font-family: sans-serif">
                                        {{ $draftPurchaseOrder->eOrderItem->description }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                        @php $UOM = \App\Models\UnitMeasurement::where('uom_en', $draftPurchaseOrder->uom)->pluck('uom_ar')->first(); @endphp
                                        {{ $UOM }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black" style="font-family: sans-serif">
                                        {{ $draftPurchaseOrder->quantity }}
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>


                        <br>
                        <br>
                        @if ($draftPurchaseOrders[0]->payment_term == 'Cash')

                            @php $proforma = \App\Models\Invoice::where('draft_purchase_order_id',$draftPurchaseOrder->id)->where('invoice_type', 1)->first();@endphp

                            @if (isset($proforma) && $proforma->invoice_status == 3)
                                <h2 class="text-2xl text-center font-bold">{{__('portal.Prepare Delivery Note')}}</h2>
                                <form action="{{ route('singleCategoryDeliveryNoteStore', $draftPurchaseOrders[0]->rfq_no) }}" method="post">
                                    @csrf
                                    <div class="grid grid-cols-12 gap-6">
                                        <div class="col-span-12">
                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                                {{__('portal.Delivery Address')}}
                                            </label>
                                            @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrders[0]->warehouse_id)->first(); @endphp

                                            <textarea class="form-textarea w-full" disabled style="font-family: sans-serif">{{$delivery->address}}</textarea>

                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="city">{{__('portal.City')}}</label>
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" style="font-family: sans-serif" value="{{ $delivery->city }}" disabled="disabled">

                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="city">{{__('portal.Warranty')}}</label>
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" style="font-family: sans-serif" name="warranty">

                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">{{__('portal.Terms and Conditions')}}</label>
                                            <textarea name="terms_and_conditions" id="terms_and_conditions" style="font-family: sans-serif" class="form-textarea w-full"></textarea>

                                            <input type="hidden" value="{{ $delivery->address }}" name="delivery_address">
                                            <input type="hidden" value="{{ $delivery->city }}" name="city">
                                        </div>
                                    </div>

                                    <div class="mt-5">
                                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                            {{__('portal.Create Delivery Note')}}
                                        </button>
                                    </div>
                                </form>
                            @elseif(isset($proforma))
                                <h2 class="text-2xl text-center font-bold">{{__('portal.Proforma invoice Generated')}}</h2>

                                    @if($proforma->invoice_status == 1)
                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-600 transition ease-in-out duration-150">
                                            {{__('portal.Note')}}: {{__('portal.Emdad verification pending')}}
                                        </a>
                                    @elseif($proforma->invoice_status == 2)
                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                            {{__('portal.Manual payment rejected')}}
                                        </a>
                                    @elseif($proforma->invoice_status == 3)
                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-green-700 focus:shadow-outline-red active:bg-green-600 transition ease-in-out duration-150">
                                            {{__('portal.Manual payment accepted')}}
                                        </a>
                                    @else
                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-600 transition ease-in-out duration-150">
                                            {{__('portal.Note')}}: {{__('portal.Waiting for payment by buyer')}}
                                        </a>
                                    @endif
                            @else
                                <a href="{{route('singleCategoryGenerateProformaInvoice', $draftPurchaseOrders[0]->rfq_no)}}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                    {{__('portal.Click here to generate proforma invoice')}}
                                </a>
                            @endif

                        @else
                            <h2 class="text-2xl text-center font-bold">{{__('portal.Prepare Delivery Note')}}</h2>
                            <form action="{{ route('singleCategoryDeliveryNoteStore', $draftPurchaseOrders[0]->rfq_no) }}" method="post">
                                @csrf
                                <div class="grid grid-cols-12 gap-6">

                                    <div class="col-span-12">
                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">{{__('portal.Delivery Address')}}</label>

                                        @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrders[0]->warehouse_id)->first(); @endphp

                                        <textarea class="form-textarea w-full" disabled style="font-family: sans-serif">{{$delivery->address}}</textarea>

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="city">{{__('portal.City')}}</label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" style="font-family: sans-serif" value="{{ $delivery->city }}" disabled="disabled">

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="warranty">{{__('portal.Warranty')}}</label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="warranty" style="font-family: sans-serif" type="text" name="warranty">

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="terms_and_conditions">{{__('portal.Terms and Conditions')}}</label>
                                        <textarea name="terms_and_conditions" id="terms_and_conditions" style="font-family: sans-serif" class="form-textarea w-full"></textarea>

                                        <input type="hidden" value="{{ $delivery->address }}" name="delivery_address">
                                        <input type="hidden" value="{{ $delivery->city }}" name="city">
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                        {{__('portal.Create Delivery Note')}}
                                    </button>
                                </div>
                            </form>
                        @endif

                        <div class="flex justify-between px-2 py-2 mt-2 h-15">
                            <div></div>
                            <div class="mt-3">{{__('portal.Thank you for using Emdad platform for your business.')}}</div>
                            <div></div>
                        </div>
                        <div class="flex justify-end px-2 py-2 h-15">
                            <div class="mt-2">{{__('portal.Copied to Emdad records')}}</div>
                            <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" style="margin-left: auto; margin-right: auto;"/></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </x-app-layout>
@endif
