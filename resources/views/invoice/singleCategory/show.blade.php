@if (auth()->user()->rtl == 0)

@section('headerScripts')
    <style>
        @media (min-width: 600px) {
            .scroll-bar-for-large-screen{
                overflow-x:hidden;
            }
        }
    </style>
@endsection

    <x-app-layout>
        <div class="-my-2 overflow-x-auto sm:overflow-hidden lg:-mx-8 scroll-bar-for-large-screen">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="py-12">
                    <div class="mt-5" style=" margin-left: 8px; margin-bottom: 10px ">
                        <a href="{{ route('singleCategoryInvoiceGeneratePDF', encrypt($invoice->rfq_no)) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                            {{__('portal.Create PDF')}}
                        </a>
                    </div>
                    <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                                @php
                                    $supplierBusiness = \App\Models\Business::where('id', $draftPurchaseOrders[0]->supplier_business_id)->first();
                                    $buyerBusiness = \App\Models\Business::where('id', $draftPurchaseOrders[0]->business_id)->first();
                                @endphp
                                {{--                    <div class="flex flex-wrap overflow-hidden bg-white p-4">--}}
                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($supplierBusiness->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h3 class="text-2xl text-center"><strong>{{__('portal.Invoice')}}</strong></h3>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
{{--                                        <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>--}}
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Supplier Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_name }}<br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_email }}<br>
                                        <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->phone }}<br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->vat_reg_certificate_number }}<br>
                                        <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->address }}<br><br>

                                        <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}}-{{ $invoiceID }}<br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoice->created_at }}<br>
                                        <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-{{ $draftPurchaseOrders[0]->id }}<br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $draftPurchaseOrders[0]->rfq_item_no }}<br>
                                        <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
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
                                        <img src="{{ Storage::url($buyerBusiness->business_photo_url) }}" alt="{{ $buyerBusiness->business_name }}" style="height: 95px;border-radius: 9px;"/><br><br>
                                        <strong>{{__('portal.Buyer Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->business_name }}<br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->business_email }}<br>
                                        <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->phone }}<br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->vat_reg_certificate_number }}<br>
                                        <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->address }}<br>
                                    </div>
                                </div>

                                {{--                    </div>--}}
                                <table class="min-w-full divide-y divide-black ">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.UOM')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Remarks')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Quantity')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Unit Price')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Amount')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    @foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                        <tr>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{$loop->iteration}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                @php
                                                    $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp
                                                {{ $record->name }}@if(isset($parent)), {{ $parent->name }} @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->eOrderItem->description }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->uom }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                @if(isset($draftPurchaseOrder->remarks)){{ $draftPurchaseOrder->remarks }} @else {{__('portal.N/A')}} @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->quantity }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->unit_price }} {{__('portal.SAR')}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{--                                        {{ number_format($draftPurchaseOrder->sub_total, 2) }}--}}
                                                {{ number_format(($draftPurchaseOrder->quantity * $draftPurchaseOrder->unit_price), 2) }} {{__('portal.SAR')}}
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
                                        <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }} {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} {{ number_format($draftPurchaseOrders[0]->vat) }}%: @if($draftPurchaseOrders[0]->vat > 9) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @else &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @endif </strong>{{ number_format(($subtotal + $draftPurchaseOrders[0]->shipment_cost) * ($draftPurchaseOrders[0]->vat/100), 2) }} {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.Shipment cost')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }} {{__('portal.SAR')}}<br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }} {{__('portal.SAR')}}<br>
                                        <hr>
                                    </div>
                                </div>

                                <div class="w-full overflow-hidden mt-2 lg:w-1/2 xl:w-2/3">
                                    <div class="mt-3 text-blue-600">{{__('portal.General note')}}:</div>
                                </div>
                                <div class="w-full overflow-hidden mt-2 lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Emdad is a neutral Platform.')}}</li>
                                    </div>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Legality of the source of this payment is buyer\'s responsibility.')}}</li>
                                    </div>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Total amount of VAT, according to its category, is collectable at the supplier\'s end.')}}</li>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else

@section('headerScripts')
    <style>
        @media (min-width: 600px) {
            .scroll-bar-for-large-screen{
                overflow-x:hidden;
            }
        }
    </style>
@endsection

    <x-app-layout>
        <div class="-my-2 overflow-x-auto sm:overflow-hidden lg:-mx-8 scroll-bar-for-large-screen">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="py-12">
                    <div class="mt-5" style=" margin-right: 8px; margin-bottom: 10px ">
                        <a href="{{ route('singleCategoryInvoiceGeneratePDF', encrypt($invoice->rfq_no)) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                            {{__('portal.Create PDF')}}
                        </a>
                    </div>
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
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($supplierBusiness->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h3 class="text-2xl text-center"><strong>{{__('portal.Invoice')}}</strong></h3>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
{{--                                        <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>--}}
                                    </div>
                                </div>

                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Supplier Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_name }}<br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_email }}<br>
                                        <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->phone }}<br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->vat_reg_certificate_number }}<br>
                                        <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->address }}<br><br>

                                        <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}}-{{ $invoiceID }}<br>
                                        <strong>{{__('portal.Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoice->created_at }}<br>
                                        <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-{{ $draftPurchaseOrders[0]->id }}<br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $draftPurchaseOrders[0]->rfq_item_no }}<br>
                                        <strong>{{__('portal.Payment Terms')}} : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
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
                                        <img src="{{ Storage::url($buyerBusiness->business_photo_url) }}" alt="{{ $buyerBusiness->business_name }}" style="height: 95px;border-radius: 9px;"/><br><br>
                                        <strong>{{__('portal.Buyer Business Name')}}: &nbsp;</strong>{{ $buyerBusiness->business_name }}<br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->business_email }}<br>
                                        <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->phone }}<br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->vat_reg_certificate_number }}<br>
                                        <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->address }}<br>
                                    </div>
                                </div>

                                {{--                    </div>--}}
                                <table class="min-w-full divide-y divide-black ">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.UOM')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Remarks')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Quantity')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Unit Price')}}
                                        </th>

                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-center text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Amount')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    @foreach($draftPurchaseOrders as $draftPurchaseOrder)
                                        <tr>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{$loop->iteration}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                @php
                                                    $record = \App\Models\Category::where('id',$draftPurchaseOrders[0]->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp
                                                {{ $record->name_ar }}@if(isset($parent)), {{ $parent->name_ar }}  @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->eOrderItem->description }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->uom }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                @if(isset($draftPurchaseOrder->remarks)){{ $draftPurchaseOrder->remarks }} @else {{__('portal.N/A')}} @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->quantity }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{ $draftPurchaseOrder->unit_price }} {{__('portal.SAR')}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-center text-black border border-black">
                                                {{--                                        {{ number_format($draftPurchaseOrder->sub_total, 2) }}--}}
                                                {{ number_format(($draftPurchaseOrder->quantity * $draftPurchaseOrder->unit_price), 2) }} {{__('portal.SAR')}}
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
                                        <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($subtotal, 2) }} {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} {{ number_format($draftPurchaseOrders[0]->vat) }}%: @if($draftPurchaseOrders[0]->vat > 9) &nbsp; @else &nbsp;&nbsp; @endif </strong>{{ number_format(($subtotal + $draftPurchaseOrders[0]->shipment_cost) * ($draftPurchaseOrders[0]->vat/100), 2) }} {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.Shipment cost')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }} {{__('portal.SAR')}}<br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }} {{__('portal.SAR')}}<br>
                                        <hr>
                                    </div>
                                </div>

                                <div class="w-full overflow-hidden mt-2 lg:w-1/2 xl:w-2/3">
                                    <div class="mt-3 text-blue-600">{{__('portal.General note')}}:</div>
                                </div>
                                <div class="w-full overflow-hidden mt-2 lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Emdad is a neutral Platform.')}}</li>
                                    </div>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Legality of the source of this payment is buyer\'s responsibility.')}}</li>
                                    </div>
                                </div>
                                <div class="w-full overflow-hidden lg:w-1/2 xl:w-2/3">
                                    <div class="text-blue-600">
                                        <li>{{__('portal.Total amount of VAT, according to its category, is collectable at the supplier\'s end.')}}</li>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif

