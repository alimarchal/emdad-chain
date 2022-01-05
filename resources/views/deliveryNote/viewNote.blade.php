@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <div class="py-12">
            <div class="mt-5" style=" margin-left: 8px; margin-bottom: 10px ">
                <a href="{{ route('generateDeliveryNotePDF', $deliveryNote) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Create PDF')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl">
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
                                <strong>{{__('portal.Delivery Note')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.D.N.')}}-{{ $deliveryNote->id }}<br>
                                @if ($deliveryNote->status == 'completed')
                                <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}}-{{ $deliveryNote->delivery->invoice_id }}<br>
                                @endif
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;</strong>{{__('portal.PO')}}-{{ $deliveryNote->purchase_order->id }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @php
                                        $record = \App\Models\Category::where('id',$deliveryNote->purchase_order->item_code)->first();
                                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                    @endphp
                                    <span class="text-blue-600"> {{ $record->name }} , {{ $parent->name }} </span>
                                    <br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNote->purchase_order->created_at }}<br>
                                <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $deliveryNote->purchase_order->qoute_no }}<br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $deliveryNote->purchase_order->rfq_item_no }}<br>
                                <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;</strong>
                                    @if($deliveryNote->purchase_order->payment_term == 'Cash') {{__('portal.Cash')}}
                                    @elseif($deliveryNote->purchase_order->payment_term == 'Credit') {{__('portal.Credit')}}
                                    @elseif($deliveryNote->purchase_order->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($deliveryNote->purchase_order->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($deliveryNote->purchase_order->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($deliveryNote->purchase_order->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
                                    <br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $supplierBusiness = \App\Models\Business::where('id', $deliveryNote->supplier_business_id)->first();
                                @endphp
                                <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                            {{--<div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            </div>--}}
                        </div>


                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD" >
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD" >
                                        {{__('portal.Description')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD" >
                                        {{__('portal.UOM')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD" >
                                        {{__('portal.Quantity')}}
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                        1
                                    </td>
                                    <td class="px-2 py-2 text-center text-sm text-black border border-black">
                                        {{ $deliveryNote->purchase_order->eOrderItem->description }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                        {{ $deliveryNote->purchase_order->uom }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                        {{ number_format($deliveryNote->purchase_order->quantity) }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>


                        <br>
                        <br>
                        @if ($deliveryNote->status == 'processing')
                            <h2 class="text-2xl text-center font-bold">{{__('portal.Invoice Generate')}}</h2>
                            <p>
                                {{__('portal.Delivery Address')}}: {{ $deliveryNote->delivery_address }}<br>
                                {{__('portal.City')}}: {{ $deliveryNote->city }}<br>
                                @if(isset($deliveryNote->terms_and_conditions)) {{__('portal.Terms and Conditions')}}: {{ $deliveryNote->terms_and_conditions }}<br> @endif
                                @if(isset($deliveryNote->warranty)) {{__('portal.Warranty')}}: {{ $deliveryNote->warranty }}<br> @endif
                            </p>

                            <form action="{{ route('invoice.generate') }}" method="post">
                                @csrf
                                <div class="mt-5">
                                    <input type="hidden" name="delivery_note" value="{{ $deliveryNote->id }}">
                                    <input type="hidden" name="draft_purchase_order_id" value="{{ $deliveryNote->purchase_order->id }}">
                                    <input type="hidden" name="otp_mobile_number" value="{{ $deliveryNote->otp_mobile_number }}">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-gray active:bg-green-600 transition ease-in-out duration-150">
                                        {{__('portal.Generate Final Invoice')}}
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
            <div class="mt-5" style=" margin-right: 8px; margin-bottom: 10px ">
                <a href="{{ route('generateDeliveryNotePDF', $deliveryNote) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Create PDF')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow">

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
                                <strong>{{__('portal.Delivery Note')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.D.N.')}}-<span style="font-family: sans-serif">{{ $deliveryNote->id }}</span> <br>
                                @if ($deliveryNote->status == 'completed')
                                    <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}}-<span style="font-family: sans-serif">{{ $deliveryNote->delivery->invoice_id }}</span> <br>
                                @endif
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-<span style="font-family: sans-serif">{{ $deliveryNote->purchase_order->id }}</span> <br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$deliveryNote->purchase_order->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                <span class="text-blue-600">{{ $record->name_ar }}@if(isset($parent)), {{ $parent->name_ar }} @endif </span>
                                <br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $deliveryNote->purchase_order->created_at }}</span> <br>
                                <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-<span style="font-family: sans-serif">{{ $deliveryNote->purchase_order->qoute_no }}</span> <br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-<span style="font-family: sans-serif">{{ $deliveryNote->purchase_order->rfq_item_no }}</span> <br>
                                <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @if($deliveryNote->purchase_order->payment_term == 'Cash') {{__('portal.Cash')}}
                                    @elseif($deliveryNote->purchase_order->payment_term == 'Credit') {{__('portal.Credit')}}
                                    @elseif($deliveryNote->purchase_order->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($deliveryNote->purchase_order->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($deliveryNote->purchase_order->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($deliveryNote->purchase_order->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
                                <br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $supplierBusiness = \App\Models\Business::where('id', $deliveryNote->supplier_business_id)->first();
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
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black" style="font-family: sans-serif">
                                        1
                                    </td>
                                    <td class="px-2 py-2 text-center text-sm text-black border border-black" style="font-family: sans-serif">
                                        {{ $deliveryNote->purchase_order->eOrderItem->description }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black">
                                        @php $UOM = \App\Models\UnitMeasurement::where('uom_en', $deliveryNote->purchase_order->uom)->pluck('uom_ar')->first(); @endphp
                                        {{ $UOM }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-center text-sm text-black border border-black" style="font-family: sans-serif">
                                        {{ number_format($deliveryNote->purchase_order->quantity) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <br>
                        <br>
                        @if ($deliveryNote->status == 'processing')
                            <h2 class="text-2xl text-center font-bold">{{__('portal.Invoice Generate')}}</h2>
                            <p>
                                {{__('portal.Delivery Address')}}: <span style="font-family: sans-serif">{{ $deliveryNote->delivery_address }}</span> <br>
                                {{__('portal.City')}}: <span style="font-family: sans-serif">{{ $deliveryNote->city }}</span> <br>
                                @if(isset($deliveryNote->terms_and_conditions)) {{__('portal.Terms and Conditions')}}: <span style="font-family: sans-serif">{{ $deliveryNote->terms_and_conditions }}</span> <br> @endif
                                @if(isset($deliveryNote->warranty)) {{__('portal.Warranty')}}: <span style="font-family: sans-serif">{{ $deliveryNote->warranty }}</span> <br> @endif
                            </p>

                            <form action="{{ route('invoice.generate') }}" method="post">
                                @csrf
                                <div class="mt-5">
                                    <input type="hidden" name="delivery_note" value="{{ $deliveryNote->id }}">
                                    <input type="hidden" name="draft_purchase_order_id" value="{{ $deliveryNote->purchase_order->id }}">
                                    <input type="hidden" name="otp_mobile_number" value="{{ $deliveryNote->otp_mobile_number }}">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-green-700 focus:shadow-outline-gray active:bg-green-600 transition ease-in-out duration-150">
                                        {{__('portal.Generate Final Invoice')}}
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
