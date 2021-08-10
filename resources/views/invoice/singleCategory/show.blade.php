@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                        @php
                            $supplierBusiness = \App\Models\Business::where('id', $draftPurchaseOrders[0]->supplier_business_id)->first();
                            $buyerBusiness = \App\Models\Business::where('id', $draftPurchaseOrders[0]->business_id)->first();
                        @endphp
                        {{--                    <div class="flex flex-wrap overflow-hidden bg-white p-4">--}}
                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h3 class="text-2xl text-center"><strong>{{__('portal.Invoice')}}</strong></h3>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong>{{__('portal.Supplier Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->user->name }}<br>
                                <strong>{{__('portal.Supplier Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_name }}<br>
                                <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->user->email }}<br>
                                <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->address }}<br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoiceID }}<br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                <strong>{{__('portal.Buyer Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->user->name }}<br>
                                <strong>{{__('portal.Buyer Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->business_name }}<br>
                                <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->user->email }}<br>
                                <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->address }}<br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->id }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                {{ $record->name }} , {{ $parent->name }}
{{--                                {{ $draftPurchaseOrders[0]->item_name }}--}}
                                <br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->rfq_no }}<br>
                                {{--                            <strong>RFQ Item #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->rfq_no }}<br>--}}
                                <strong>{{__('portal.Quote')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                                <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->payment_term }}<br>
                            </div>
                        </div>


                        {{--<div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            <h3 class="text-2xl text-center"><strong>Invoice</strong></h3>
                            <strong>Invoice #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoiceID }}<br>
                            <strong>P. O. #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->id }}<br>
                            <strong>Category Code: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->item_code }}<br>
                            <strong>Category Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->item_name }}<br>
                            <strong>Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                            <strong>RFQ #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->rfq_no }}<br>
                            <strong>Payment Terms: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->payment_term }}<br>
                            <strong>VAT %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->vat }}<br>
                            <strong>Shipment Cost: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }}<br>
                            <strong>Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }}<br>
                        </div>--}}
                        {{--                    </div>--}}
                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                            <tr>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    #
                                </th>
{{--                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">--}}
{{--                                    Quote #--}}
{{--                                </th>--}}
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    UOM
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    Remarks
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    Quantity
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    Unit Price
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    Amount
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                            @foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        {{$loop->iteration}}
                                    </td>
{{--                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">--}}
{{--                                        {{ $draftPurchaseOrder->qoute_no }}--}}
{{--                                    </td>--}}
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        {{ $draftPurchaseOrder->eOrderItem->description }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        {{ $draftPurchaseOrder->uom }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        @if(isset($draftPurchaseOrder->remarks)){{ $draftPurchaseOrder->remarks }} @else N/A @endif
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        {{ $draftPurchaseOrder->quantity }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        {{ $draftPurchaseOrder->unit_price }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
{{--                                        {{ number_format($draftPurchaseOrder->sub_total, 2) }}--}}
                                        {{ number_format(($draftPurchaseOrder->quantity * $draftPurchaseOrder->unit_price), 2) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php $subtotal = 0;
                                    foreach ($draftPurchaseOrders as $draftPurchaseOrder)
                                    {
                                        $subtotal += $draftPurchaseOrder->quantity * $draftPurchaseOrder->unit_price;
                                    }
                                @endphp
                                <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }}<br>
                                <strong>{{__('portal.VAT')}} %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->vat }}<br>
                                <strong>{{__('portal.Shipment cost')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }}<br>
                                <hr>
                                <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }}<br>
                                <hr>
                            </div>
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
                        @php
                            $supplierBusiness = \App\Models\Business::where('id', $draftPurchaseOrders[0]->supplier_business_id)->first();
                            $buyerBusiness = \App\Models\Business::where('id', $draftPurchaseOrders[0]->business_id)->first();
                        @endphp
                        {{--                    <div class="flex flex-wrap overflow-hidden bg-white p-4">--}}
                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h3 class="text-2xl text-center"><strong>{{__('portal.Invoice')}}</strong></h3>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong>{{__('portal.Supplier Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->user->name }}<br>
                                <strong>{{__('portal.Supplier Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_name }}<br>
                                <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->user->email }}<br>
                                <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->address }}<br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoiceID }}<br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                            </div>
                        </div>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                <strong>{{__('portal.Buyer Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->user->name }}<br>
                                <strong>{{__('portal.Buyer Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->business_name }}<br>
                                <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->user->email }}<br>
                                <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->address }}<br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->id }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                {{ $record->name_ar }} , {{ $parent->name_ar }}
                                {{--                                {{ $draftPurchaseOrders[0]->item_name }}--}}
                                <br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->rfq_no }}<br>
                                {{--                            <strong>RFQ Item #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->rfq_no }}<br>--}}
                                <strong>{{__('portal.Quote')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                                <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->payment_term }}<br>
                            </div>
                        </div>


                        {{--<div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            <h3 class="text-2xl text-center"><strong>Invoice</strong></h3>
                            <strong>Invoice #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoiceID }}<br>
                            <strong>P. O. #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->id }}<br>
                            <strong>Category Code: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->item_code }}<br>
                            <strong>Category Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->item_name }}<br>
                            <strong>Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                            <strong>RFQ #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->rfq_no }}<br>
                            <strong>Payment Terms: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->payment_term }}<br>
                            <strong>VAT %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->vat }}<br>
                            <strong>Shipment Cost: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }}<br>
                            <strong>Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }}<br>
                        </div>--}}
                        {{--                    </div>--}}
                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                            <tr>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    #
                                </th>
                                {{--                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">--}}
                                {{--                                    Quote #--}}
                                {{--                                </th>--}}
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    UOM
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    Remarks
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    Quantity
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    Unit Price
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider">
                                    Amount
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                            @foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        {{$loop->iteration}}
                                    </td>
                                    {{--                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">--}}
                                    {{--                                        {{ $draftPurchaseOrder->qoute_no }}--}}
                                    {{--                                    </td>--}}
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        {{ $draftPurchaseOrder->eOrderItem->description }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        {{ $draftPurchaseOrder->uom }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        @if(isset($draftPurchaseOrder->remarks)){{ $draftPurchaseOrder->remarks }} @else N/A @endif
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        {{ $draftPurchaseOrder->quantity }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                        {{ $draftPurchaseOrder->unit_price }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
{{--                                        {{ number_format($draftPurchaseOrder->sub_total, 2) }}--}}
                                        {{ number_format(($draftPurchaseOrder->quantity * $draftPurchaseOrder->unit_price), 2) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php $subtotal = 0;
                                    foreach ($draftPurchaseOrders as $draftPurchaseOrder)
                                    {
                                        $subtotal += $draftPurchaseOrder->quantity * $draftPurchaseOrder->unit_price;
                                    }
                                @endphp
                                <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }}<br>
                                <strong>{{__('portal.VAT')}} %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->vat }}<br>
                                <strong>{{__('portal.Shipment cost')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }}<br>
                                <hr>
                                <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }}<br>
                                <hr>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif

