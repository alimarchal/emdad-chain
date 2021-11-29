@if (auth()->user()->rtl == 0)
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
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-{{ $draftPurchaseOrder->id }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @php
                                        $record = \App\Models\Category::where('id',$draftPurchaseOrder->item_code)->first();
                                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                    @endphp
                                    {{ $record->name }} , {{ $parent->name }}
{{--                                    {{ $draftPurchaseOrder->item_name }}--}}
                                <br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->created_at }}<br>
                                <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $draftPurchaseOrder->qoute_no }}<br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $draftPurchaseOrder->rfq_item_no }}<br>
                                <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @if($draftPurchaseOrder->payment_term == 'Cash') {{__('portal.Cash')}}
                                    @elseif($draftPurchaseOrder->payment_term == 'Credit') {{__('portal.Credit')}}
                                    @elseif($draftPurchaseOrder->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($draftPurchaseOrder->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($draftPurchaseOrder->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($draftPurchaseOrder->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
                                {{--                                {{ $draftPurchaseOrder->payment_term }}--}}
                                <br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $supplierBusiness = \App\Models\Business::where('id', $draftPurchaseOrder->supplier_business_id)->first();
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
                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                            <tr>
                                <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                    1
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                    {{ strip_tags($draftPurchaseOrder->eOrderItem->description) }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                    {{ $draftPurchaseOrder->uom }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                    {{ $draftPurchaseOrder->quantity }}
                                </td>
                            </tr>

                            </tbody>
                        </table>


                        <br>
                        <br>
                        @if ($draftPurchaseOrder->payment_term == 'Cash')
                            {{--                        @php $proformaPresent = \App\Models\ProformaInvoice::where('draft_purchase_order_id',$draftPurchaseOrder->id)->first(); @endphp--}}
                            @php $proforma = \App\Models\Invoice::where('draft_purchase_order_id',$draftPurchaseOrder->id)->where('invoice_type', 1)->first();@endphp
                            @if (isset($proforma) && $proforma->invoice_status == 3)
                                <h2 class="text-2xl text-center font-bold">{{__('portal.Prepare Delivery Note')}}</h2>
                                <form action="{{ route('deliveryNote.store') }}" method="post">
                                    @csrf
                                    <div class="grid grid-cols-12 gap-6">

                                        <div class="col-span-12">
                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                                {{__('portal.Delivery Address')}}
                                            </label>
                                            {{--                                <textarea name="delivery_address" id="delivery_address" class="form-textarea w-full">{{ strip_tags($draftPurchaseOrder->buyer_business->address) . ' - City: ' . $draftPurchaseOrder->buyer_business->city . ' - Phone #: ' . $draftPurchaseOrder->buyer_business->phone }}</textarea>--}}
                                            @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse_id)->first(); @endphp
                                            <textarea class="form-textarea w-full" disabled>{{$delivery->address}}</textarea>
                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                                {{__('portal.City')}}
                                            </label>
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" value="{{ $delivery->city }}" disabled="disabled">
                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                                {{__('portal.Warranty')}}
                                            </label>
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" name="warranty">

                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                                {{__('portal.Terms and Conditions')}}
                                            </label>
                                            <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-textarea w-full"></textarea>
                                            <input type="hidden" value="{{ auth()->user()->id }}" name="update_user_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->user_id }}" name="user_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->business_id }}" name="business_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->supplier_user_id }}" name="supplier_user_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->supplier_business_id }}" name="supplier_business_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->rfq_no }}" name="rfq_no">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->shipment_cost }}" name="shipment_cost">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->quantity }}" name="quantity">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->unit_price }}" name="unit_price">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->otp_mobile_number }}" name="otp_mobile_number">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->vat }}" name="vat">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->total_cost }}" name="total_cost">
                                            <input type="hidden" value="{{ $delivery->address }}" name="delivery_address">
                                            <input type="hidden" value="{{ $delivery->city }}" name="city">
                                        </div>
                                    </div>

                                    <div class="mt-5">
                                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                            {{__('portal.Create Delivery Note')}}
                                        </button>
                                    </div>
                                </form>
                            @elseif(isset($proforma))
                                <h2 class="text-2xl text-center font-bold">{{__('portal.Proforma invoice Generated')}}</h2>

                                <a  class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-red active:bg-yellow-600 transition ease-in-out duration-150">
                                    {{__('portal.Note')}}: {{__('portal.Waiting for payment by buyer')}}
                                </a>
                            @else
                                <a href="{{route('generateProforma', $draftPurchaseOrder->id)}}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-red active:bg-green-600 transition ease-in-out duration-150">
                                    {{__('portal.Click here to generate proforma invoice')}}
                                </a>

                            @endif
                        @else
                            <h2 class="text-2xl text-center font-bold">{{__('portal.Prepare Delivery Note')}}</h2>
                            <form action="{{ route('deliveryNote.store') }}" method="post">
                                @csrf
                                <div class="grid grid-cols-12 gap-6">

                                    <div class="col-span-12">
                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                            {{__('portal.Delivery Address')}}
                                        </label>
                                        {{--                                <textarea name="delivery_address" id="delivery_address" class="form-textarea w-full">{{ strip_tags($draftPurchaseOrder->buyer_business->address) . ' - City: ' . $draftPurchaseOrder->buyer_business->city . ' - Phone #: ' . $draftPurchaseOrder->buyer_business->phone }}</textarea>--}}
                                        @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse_id)->first(); @endphp
                                        <textarea class="form-textarea w-full" disabled>{{$delivery->address}}</textarea>
                                        {{--                                <textarea class="form-textarea w-full" disabled>{{$draftPurchaseOrder->buyer_business->address}}</textarea>--}}

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                            {{__('portal.City')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" value="{{ $delivery->city }}" disabled="disabled">


                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                            {{__('portal.Warranty')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" name="warranty">

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                            {{__('portal.Terms and Conditions')}}
                                        </label>
                                        <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-textarea w-full"></textarea>
                                        <input type="hidden" value="{{ auth()->user()->id }}" name="update_user_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->user_id }}" name="user_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->business_id }}" name="business_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->supplier_user_id }}" name="supplier_user_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->supplier_business_id }}" name="supplier_business_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->rfq_no }}" name="rfq_no">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->shipment_cost }}" name="shipment_cost">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->quantity }}" name="quantity">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->unit_price }}" name="unit_price">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->otp_mobile_number }}" name="otp_mobile_number">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->vat }}" name="vat">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->total_cost }}" name="total_cost">
                                        <input type="hidden" value="{{ $delivery->address }}" name="delivery_address">
                                        <input type="hidden" value="{{ $delivery->city }}" name="city">
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
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
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-<span style="font-family: sans-serif">{{ $draftPurchaseOrder->id }}</span> <br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$draftPurchaseOrder->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                {{ $record->name_ar }} , {{ $parent->name_ar }}
                                <br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $draftPurchaseOrder->created_at }}</span> <br>
                                <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-<span style="font-family: sans-serif">{{ $draftPurchaseOrder->qoute_no }}</span> <br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;</strong>{{__('portal.RFQ')}}-<span style="font-family: sans-serif">{{ $draftPurchaseOrder->rfq_item_no }}</span> <br>
                                <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @if($draftPurchaseOrder->payment_term == 'Cash') {{__('portal.Cash')}}
                                    @elseif($draftPurchaseOrder->payment_term == 'Credit') {{__('portal.Credit')}}
                                    @elseif($draftPurchaseOrder->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($draftPurchaseOrder->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($draftPurchaseOrder->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($draftPurchaseOrder->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
                                <br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $supplierBusiness = \App\Models\Business::where('id', $draftPurchaseOrder->supplier_business_id)->first();
                                @endphp
                                <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
{{--                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">--}}
{{--                            </div>--}}
                        </div>

                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Description')}}
                                    </th>

                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.UOM')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                        {{__('portal.Quantity')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black" style="font-family: sans-serif">
                                        1
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black" style="font-family: sans-serif">
                                        {{ strip_tags($draftPurchaseOrder->eOrderItem->description) }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                        @php $UOM = \App\Models\UnitMeasurement::where('uom_en', $draftPurchaseOrder->uom)->pluck('uom_ar')->first() @endphp
                                        {{ $UOM }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black" style="font-family: sans-serif">
                                        {{ $draftPurchaseOrder->quantity }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>


                        <br>
                        <br>
                        @if ($draftPurchaseOrder->payment_term == 'Cash')
                            {{--                        @php $proformaPresent = \App\Models\ProformaInvoice::where('draft_purchase_order_id',$draftPurchaseOrder->id)->first(); @endphp--}}
                            @php $proforma = \App\Models\Invoice::where('draft_purchase_order_id',$draftPurchaseOrder->id)->where('invoice_type', 1)->first();@endphp
                            @if (isset($proforma) && $proforma->invoice_status == 3)
                                <h2 class="text-2xl text-center font-bold">{{__('portal.Prepare Delivery Note')}}</h2>
                                <form action="{{ route('deliveryNote.store') }}" method="post">
                                    @csrf
                                    <div class="grid grid-cols-12 gap-6">

                                        <div class="col-span-12">
                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                                {{__('portal.Delivery Address')}}
                                            </label>
                                            @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse_id)->first(); @endphp
                                            <textarea class="form-textarea w-full" style="font-family: sans-serif" disabled>{{$delivery->address}}</textarea>
                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                                {{__('portal.City')}}
                                            </label>
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" style="font-family: sans-serif" value="{{ $delivery->city }}" disabled="disabled">
                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                                {{__('portal.Warranty')}}
                                            </label>
                                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" name="warranty">

                                            <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                                {{__('portal.Terms and Conditions')}}
                                            </label>
                                            <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-textarea w-full" style="font-family: sans-serif"></textarea>
                                            <input type="hidden" value="{{ auth()->user()->id }}" name="update_user_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->user_id }}" name="user_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->business_id }}" name="business_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->supplier_user_id }}" name="supplier_user_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->supplier_business_id }}" name="supplier_business_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->rfq_no }}" name="rfq_no">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->shipment_cost }}" name="shipment_cost">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->quantity }}" name="quantity">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->unit_price }}" name="unit_price">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->otp_mobile_number }}" name="otp_mobile_number">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->vat }}" name="vat">
                                            <input type="hidden" value="{{ $draftPurchaseOrder->total_cost }}" name="total_cost">
                                            <input type="hidden" value="{{ $delivery->address }}" name="delivery_address">
                                            <input type="hidden" value="{{ $delivery->city }}" name="city">
                                        </div>
                                    </div>

                                    <div class="mt-5">
                                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                            {{__('portal.Create Delivery Note')}}
                                        </button>
                                    </div>
                                </form>
                            @elseif(isset($proforma))
                                <h2 class="text-2xl text-center font-bold">{{__('portal.Proforma invoice Generated')}}</h2>

                                <a  class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white focus:outline-none focus:border-yellow-700 focus:shadow-outline-red active:bg-yellow-600 transition ease-in-out duration-150">
                                    {{__('portal.Note')}}: {{__('portal.Waiting for payment by buyer')}}
                                </a>
                            @else
                                <a href="{{route('generateProforma', $draftPurchaseOrder->id)}}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-green-700 focus:shadow-outline-red active:bg-green-600 transition ease-in-out duration-150">
                                    {{__('portal.Click here to generate proforma invoice')}}
                                </a>

                            @endif
                        @else
                            <h2 class="text-2xl text-center font-bold">{{__('portal.Prepare Delivery Note')}}</h2>
                            <form action="{{ route('deliveryNote.store') }}" method="post">
                                @csrf
                                <div class="grid grid-cols-12 gap-6">

                                    <div class="col-span-12">
                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                            {{__('portal.Delivery Address')}}
                                        </label>
                                        @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse_id)->first(); @endphp
                                        <textarea class="form-textarea w-full" disabled style="font-family: sans-serif">{{$delivery->address}}</textarea>

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                            {{__('portal.City')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" style="font-family: sans-serif" value="{{ $delivery->city }}" disabled="disabled">


                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                            {{__('portal.Warranty')}}
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" style="font-family: sans-serif" type="text" name="warranty">

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                            {{__('portal.Terms and Conditions')}}
                                        </label>
                                        <textarea name="terms_and_conditions" id="terms_and_conditions" style="font-family: sans-serif" class="form-textarea w-full"></textarea>
                                        <input type="hidden" value="{{ auth()->user()->id }}" name="update_user_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->user_id }}" name="user_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->business_id }}" name="business_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->supplier_user_id }}" name="supplier_user_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->supplier_business_id }}" name="supplier_business_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->rfq_no }}" name="rfq_no">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->shipment_cost }}" name="shipment_cost">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->quantity }}" name="quantity">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->unit_price }}" name="unit_price">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->otp_mobile_number }}" name="otp_mobile_number">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->vat }}" name="vat">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->total_cost }}" name="total_cost">
                                        <input type="hidden" value="{{ $delivery->address }}" name="delivery_address">
                                        <input type="hidden" value="{{ $delivery->city }}" name="city">
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
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
