@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <div class="py-12">
            <div class="mt-5" style=" margin-left: 8px; margin-bottom: 10px ">
                <a href="{{ route('singleCategoryInvoiceGeneratePDF', encrypt($invoices[0]->rfq_no)) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Create PDF')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h3 class="text-2xl text-center"><strong>{{__('portal.Invoice')}}</strong></h3>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $supplierBusiness = \App\Models\Business::where('id', $invoices[0]->supplier_business_id)->first();
                                    $buyerBusiness = \App\Models\Business::where('id', $invoices[0]->buyer_business_id)->first();
                                @endphp
                                <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                        </div>
                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                <strong>{{__('portal.Supplier Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_name }}<br>
                                <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_email }}<br>
                                <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->phone }}<br>
                                <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->address }}<br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                <strong>{{__('portal.Invoice')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}} -{{ $invoices[0]->id }}<br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoices[0]->created_at }}<br>
                            </div>
                        </div>
                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                <strong>{{__('portal.Buyer Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->business_name }}<br>
                                <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->business_email }}<br>
                                <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->phone }}<br>
                                <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->address }}<br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.P.O.')}} -{{ $invoices[0]->purchase_order->id }}<br>
                                {{--                            <strong>Category #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoices[0]->purchase_order->item_code }}<br>--}}
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$invoices[0]->purchase_order->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                {{ $record->name }} , {{ $parent->name }}
{{--                                {{ $invoices[0]->purchase_order->item_name }}--}}
                                <br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $invoices[0]->purchase_order->rfq_no }}<br>
                                <strong>{{__('portal.Quote')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $invoices[0]->purchase_order->qoute_no }}<br>
                                <strong>{{__('portal.Payment Terms')}} #: &nbsp;&nbsp;&nbsp;</strong>
                                    @if($invoices[0]->purchase_order->payment_term == 'Cash') {{__('portal.Cash')}}
                                    @elseif($invoices[0]->purchase_order->payment_term == 'Credit') {{__('portal.Credit')}}
                                    @elseif($invoices[0]->purchase_order->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($invoices[0]->purchase_order->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($invoices[0]->purchase_order->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($invoices[0]->purchase_order->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
                                <br>
                            </div>
                        </div>

                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Description')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.UOM')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Quantity')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Unit Price')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Total')}}
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $invoice->eOrderItem->description }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $invoice->purchase_order->uom }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $invoice->purchase_order->quantity }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $invoice->purchase_order->unit_price }} {{__('portal.SAR')}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ number_format( ($invoice->purchase_order->quantity * $invoice->purchase_order->unit_price), 2) }} {{__('portal.SAR')}}
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
                                    foreach ($invoices as $invoice)
                                    {
                                        $subtotal += $invoice->purchase_order->quantity * $invoice->purchase_order->unit_price;
                                    }
                                @endphp
                                <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }} {{__('portal.SAR')}}<br>
                                <strong>{{__('portal.VAT')}} %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoices[0]->vat }}<br>
                                <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoices[0]->purchase_order->shipment_cost }} {{__('portal.SAR')}}<br>
                                <hr>
                                <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($invoices[0]->total_cost, 2) }} {{__('portal.SAR')}}<br>
                                <hr>
                            </div>
                        </div>

                        <br>
                        <br>

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
                <a href="{{ route('singleCategoryInvoiceGeneratePDF', encrypt($invoices[0]->rfq_no)) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Create PDF')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                <div class="bg-white overflow-hidden shadow-xl ">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                <h3 class="text-2xl text-center"><strong>{{__('portal.Invoice')}}</strong></h3>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                @php
                                    $supplierBusiness = \App\Models\Business::where('id', $invoices[0]->supplier_business_id)->first();
                                    $buyerBusiness = \App\Models\Business::where('id', $invoices[0]->buyer_business_id)->first();
                                @endphp
                                <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                        </div>
                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                <strong>{{__('portal.Supplier Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_name }}<br>
                                <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_email }}<br>
                                <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->phone }}<br>
                                <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->address }}<br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                <strong>{{__('portal.Invoice')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}}-{{ $invoices[0]->id }}<br>
                                <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoices[0]->created_at }}<br>
                            </div>
                        </div>
                        <div class="flex flex-wrap overflow-hidden bg-white p-4">
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                <strong>{{__('portal.Buyer Business Name')}}: &nbsp;&nbsp;</strong>{{ $buyerBusiness->business_name }}<br>
                                <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->business_email }}<br>
                                <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->phone }}<br>
                                <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->address }}<br>
                            </div>
                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.P.O.')}}-{{ $invoices[0]->purchase_order->id }}<br>
                                <strong>{{__('portal.Category Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                @php
                                    $record = \App\Models\Category::where('id',$invoices[0]->purchase_order->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp
                                {{ $record->name_ar }} , {{ $parent->name_ar }}
                                <br>
                                <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $invoices[0]->purchase_order->rfq_no }}<br>
                                <strong>{{__('portal.Quote')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $invoices[0]->purchase_order->qoute_no }}<br>
                                <strong>{{__('portal.Payment Terms')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    @if($invoices[0]->purchase_order->payment_term == 'Cash') {{__('portal.Cash')}}
                                    @elseif($invoices[0]->purchase_order->payment_term == 'Credit') {{__('portal.Credit')}}
                                    @elseif($invoices[0]->purchase_order->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                    @elseif($invoices[0]->purchase_order->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                    @elseif($invoices[0]->purchase_order->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                    @elseif($invoices[0]->purchase_order->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                    @endif
                                <br>
                            </div>
                        </div>

                        <table class="min-w-full divide-y divide-black ">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Description')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.UOM')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Quantity')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Unit Price')}}
                                    </th>
                                    <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider">
                                        {{__('portal.Total')}}
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-black border-1 border-black">
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $invoice->eOrderItem->description }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $invoice->purchase_order->uom }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $invoice->purchase_order->quantity }}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ $invoice->purchase_order->unit_price }} {{__('portal.SAR')}}
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                            {{ number_format( ($invoice->purchase_order->quantity * $invoice->purchase_order->unit_price), 2) }} {{__('portal.SAR')}}
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
                                    foreach ($invoices as $invoice)
                                    {
                                        $subtotal += $invoice->purchase_order->quantity * $invoice->purchase_order->unit_price;
                                    }
                                @endphp
                                <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }} {{__('portal.SAR')}}<br>
                                <strong>{{__('portal.VAT')}} %: &nbsp;&nbsp;</strong>{{ $invoices[0]->vat }}<br>
                                <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoices[0]->purchase_order->shipment_cost }} {{__('portal.SAR')}}<br>
                                <hr>
                                <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($invoices[0]->total_cost, 2) }} {{__('portal.SAR')}}<br>
                                <hr>
                            </div>
                        </div>

                        <br>
                        <br>

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
