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
                        <a href="{{ route('singleCategoryInvoiceGeneratePDF', encrypt($invoices[0]->rfq_no)) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                            {{__('portal.Create PDF')}}
                        </a>
                    </div>
                    <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        @php
                                            $supplierBusiness = \App\Models\Business::where('id', $invoices[0]->supplier_business_id)->first();
                                            $buyerBusiness = \App\Models\Business::where('id', $invoices[0]->buyer_business_id)->first();
                                        @endphp
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($supplierBusiness->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h3 class="text-2xl text-center"><strong>{{__('portal.Invoice')}}</strong></h3>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        {{--@php
                                            $supplierBusiness = \App\Models\Business::where('id', $invoices[0]->supplier_business_id)->first();
                                            $buyerBusiness = \App\Models\Business::where('id', $invoices[0]->buyer_business_id)->first();
                                        @endphp
                                        <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>--}}
                                    </div>
                                </div>
                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Supplier Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_name }}<br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_email }}<br>
                                        <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->phone }}<br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->vat_reg_certificate_number }}<br>
                                        <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->address }}<br><br>

                                        @if(isset($invoices[0]->deliveryNote->id))
                                            <strong>{{__('portal.Delivery Note')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.D.N.')}}-{{ $invoices[0]->deliveryNote->id }}<br>
                                        @endif
                                        <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}}-{{ $invoices[0]->id }}<br>
                                        <strong>{{__('portal.Invoice Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoices[0]->created_at }}<br>
                                        <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-{{ $invoices[0]->purchase_order->id }}<br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-{{ $invoices[0]->purchase_order->qoute_no }}<br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-{{ $invoices[0]->purchase_order->rfq_item_no }}<br>
                                        <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($invoices[0]->purchase_order->payment_term == 'Cash') {{__('portal.Cash')}}
                                        @elseif($invoices[0]->purchase_order->payment_term == 'Credit') {{__('portal.Credit')}}
                                        @elseif($invoices[0]->purchase_order->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($invoices[0]->purchase_order->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($invoices[0]->purchase_order->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($invoices[0]->purchase_order->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                        <br>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <img src="{{ Storage::url($buyerBusiness->business_photo_url) }}" alt="{{ $buyerBusiness->business_name }}" style="height: 95px;border-radius: 9px;"/><br><br>
                                        <strong>{{__('portal.Buyer Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->business_name }}<br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->business_email }}<br>
                                        <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->phone }}<br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->vat_reg_certificate_number }}<br>
                                        <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->address }}<br>
                                    </div>
                                </div>

                                <table class="min-w-full divide-y divide-black ">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.UOM')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Quantity')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Unit Price')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
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
                                                @php
                                                    $record = \App\Models\Category::where('id',$invoice->purchase_order->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp
                                                {{ $record->name }}@if(isset($parent->name)), {{ $parent->name }} @endif
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
                                        <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoices[0]->purchase_order->shipment_cost }} {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} {{ number_format($invoices[0]->vat) }}%: @if($invoices[0]->vat > 9) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @else &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @endif</strong>{{ number_format(($subtotal + $invoices[0]->purchase_order->shipment_cost) * ($invoices[0]->vat/100), 2) }} {{__('portal.SAR')}}<br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($invoices[0]->total_cost, 2) }} {{__('portal.SAR')}}<br>
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

                                @if (auth()->user()->registration_type == 'Buyer')
                                    @if($invoices[0]->invoice_status == '0' || $invoices[0]->invoice_status == '2')
                                        @if($invoices[0]->invoice_status == '0')

                                            <div class="flex mt-4 mb-4">
                                                <div class="flex flex-wrap">
                                                    <a href=" {{ route('singleCategoryBankPaymentCreate', $invoices[0]->rfq_no) }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                        {{__('portal.Manual Payment')}}
                                                    </a>
                                                </div>
                                                <div class="flex flex-wrap ml-4">
                                                    <form action="{{route('invoicePayment.stepOne')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="invoice_id" value="{{$invoices[0]->id}}">
                                                        <button class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">{{__('portal.Online Payment')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                    @if($invoices[0]->invoice_status == '2')
                                        <a href=" {{ route('singleCategoryBankPaymentEdit', $invoices[0]->id) }}" class="inline-flex items-center justify-center px-4 py-2 mt-4 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                            {{__('portal.Proceed')}}
                                        </a>
                                    @endif
                                @endif

                                @if((auth()->user()->registration_type == "Buyer" || auth()->user()->hasAnyRole(['Buyer Payment Admin', 'Buyer Purchaser', 'Buyer Purchase Admin'])) && $invoices[0]->invoice_status == 3)
                                    <div class="flex mt-4 mb-4">
                                        <div class="flex flex-wrap"><img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-6@8x.png')}}" alt="{{__('portal.Paid')}}"></div>
                                        <div class="flex flex-wrap justify-content-center mt-6"><strong>{{__('portal.Invoice paid on')}}: &nbsp;</strong> {{$invoices[0]->BankPayment->created_at}}</div>
                                    </div>
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
                        <a href="{{ route('singleCategoryInvoiceGeneratePDF', encrypt($invoices[0]->rfq_no)) }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-gray-800 focus:shadow-outline-gray active:bg-red-600 transition ease-in-out duration-150">
                            {{__('portal.Create PDF')}}
                        </a>
                    </div>
                    <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
                        <div class="bg-white overflow-hidden shadow-xl ">
                            <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                                <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        @php
                                            $supplierBusiness = \App\Models\Business::where('id', $invoices[0]->supplier_business_id)->first();
                                            $buyerBusiness = \App\Models\Business::where('id', $invoices[0]->buyer_business_id)->first();
                                        @endphp
                                        <img class="h-20 w-30 object-cover mx-auto" src="{{ Storage::url($supplierBusiness->business_photo_url) }}" style="border-radius: 9px;"/>
                                        <h3 class="text-2xl text-center"><strong>{{__('portal.Invoice')}}</strong></h3>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                                        {{--@php
                                            $supplierBusiness = \App\Models\Business::where('id', $invoices[0]->supplier_business_id)->first();
                                            $buyerBusiness = \App\Models\Business::where('id', $invoices[0]->buyer_business_id)->first();
                                        @endphp
                                        <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>--}}
                                    </div>
                                </div>
                                <div class="flex flex-wrap overflow-hidden bg-white p-4">
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                                        <strong>{{__('portal.Supplier Business Name')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $supplierBusiness->business_name }}</span> <br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $supplierBusiness->business_email }}</span> <br>
                                        <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $supplierBusiness->phone }}</span> <br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $supplierBusiness->vat_reg_certificate_number }}</span> <br>
                                        <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $supplierBusiness->address }}</span> <br><br>

                                        @if(isset($invoices[0]->deliveryNote->id))
                                            <strong>{{__('portal.Delivery Note')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.D.N.')}}-<span style="font-family: sans-serif">{{ $invoices[0]->deliveryNote->id }}</span> <br>
                                        @endif
                                        <strong>{{__('portal.Invoice')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Inv.')}}-<span style="font-family: sans-serif">{{ $invoices[0]->id }}</span> <br>
                                        <strong>{{__('portal.Invoice Date')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $invoices[0]->created_at }}</span> <br>
                                        <strong>{{__('portal.Purchase Order')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.PO')}}-<span style="font-family: sans-serif">{{ $invoices[0]->purchase_order->id }}</span> <br>
                                        <strong>{{__('portal.Quotation')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.Q')}}-<span style="font-family: sans-serif">{{ $invoices[0]->purchase_order->qoute_no }}</span> <br>
                                        <strong>{{__('portal.Requisition')}} #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{__('portal.RFQ')}}-<span style="font-family: sans-serif">{{ $invoices[0]->purchase_order->rfq_item_no }}</span> <br>
                                        <strong>{{__('portal.Payment Terms')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                        @if($invoices[0]->purchase_order->payment_term == 'Cash') {{__('portal.Cash')}}
                                        @elseif($invoices[0]->purchase_order->payment_term == 'Credit') {{__('portal.Credit')}}
                                        @elseif($invoices[0]->purchase_order->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                        @elseif($invoices[0]->purchase_order->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                        @elseif($invoices[0]->purchase_order->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                        @elseif($invoices[0]->purchase_order->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                        @endif
                                        <br>
                                    </div>
                                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                                        <img src="{{ Storage::url($buyerBusiness->business_photo_url) }}" alt="{{ $buyerBusiness->business_name }}" style="height: 95px;border-radius: 9px;"/><br><br>
                                        <strong>{{__('portal.Buyer Business Name')}}: &nbsp;</strong><span style="font-family: sans-serif">{{ $buyerBusiness->business_name }}</span> <br>
                                        <strong>{{__('portal.Email')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $buyerBusiness->business_email }}</span> <br>
                                        <strong>{{__('portal.Phone')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $supplierBusiness->phone }}</span> <br>
                                        <strong>{{__('portal.VAT Number')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $buyerBusiness->vat_reg_certificate_number }}</span> <br>
                                        <strong>{{__('portal.Address')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $buyerBusiness->address }}</span> <br>
                                    </div>
                                </div>

                                <table class="min-w-full divide-y divide-black ">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            #
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Description')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.UOM')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Quantity')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Unit Price')}}
                                        </th>
                                        <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-right text-xs font-medium text-black uppercase tracking-wider" style="background-color: #FCE5CD">
                                            {{__('portal.Total')}}
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-black border-1 border-black">
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="font-family: sans-serif">
                                                {{$loop->iteration}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                @php
                                                    $record = \App\Models\Category::where('id',$invoice->purchase_order->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp
                                                {{ $record->name_ar }}@if(isset($parent->name_ar)), {{ $parent->name_ar }} @endif
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="font-family: sans-serif">
                                                {{ $invoice->eOrderItem->description }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                @php $UOM = \App\Models\UnitMeasurement::where('uom_en', $invoice->purchase_order->uom)->pluck('uom_ar')->first(); @endphp
                                                {{ $UOM }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black" style="font-family: sans-serif">
                                                {{ $invoice->purchase_order->quantity }}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                <span style="font-family: sans-serif">{{ $invoice->purchase_order->unit_price }}</span> {{__('portal.SAR')}}
                                            </td>
                                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                                <span style="font-family: sans-serif">{{ number_format( ($invoice->purchase_order->quantity * $invoice->purchase_order->unit_price), 2) }}</span> {{__('portal.SAR')}}
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
                                        <strong>{{__('portal.Sub-total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ number_format($subtotal, 2) }}</span> {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.Shipment cost')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ $invoices[0]->purchase_order->shipment_cost }}</span> {{__('portal.SAR')}}<br>
                                        <strong>{{__('portal.VAT')}} <span style="font-family: sans-serif">{{ number_format($invoices[0]->vat) }}</span>%: @if($invoices[0]->vat > 9) &nbsp; @else &nbsp;&nbsp; @endif </strong><span style="font-family: sans-serif">{{ number_format(($subtotal + $invoices[0]->purchase_order->shipment_cost) * ($invoices[0]->vat/100), 2) }}</span> {{__('portal.SAR')}}<br>
                                        <hr>
                                        <strong>{{__('portal.Total')}}: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span style="font-family: sans-serif">{{ number_format($invoices[0]->total_cost, 2) }}</span> {{__('portal.SAR')}}<br>
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

                                @if (auth()->user()->registration_type == 'Buyer')
                                    @if($invoices[0]->invoice_status == '0' || $invoices[0]->invoice_status == '2')
                                        @if($invoices[0]->invoice_status == '0')

                                            <div class="flex mt-4 mb-4">
                                                <div class="flex flex-wrap">
                                                    <a href=" {{ route('singleCategoryBankPaymentCreate', $invoices[0]->rfq_no) }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                        {{__('portal.Manual Payment')}}
                                                    </a>
                                                </div>
                                                <div class="flex flex-wrap mr-4">
                                                    <form action="{{route('invoicePayment.stepOne')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="invoice_id" value="{{$invoices[0]->id}}">
                                                        <button class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">{{__('portal.Online Payment')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                    @if($invoices[0]->invoice_status == '2')
                                        <a href=" {{ route('singleCategoryBankPaymentEdit', $invoices[0]->id) }}" class="inline-flex items-center justify-center px-4 py-2 mt-4 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                            {{__('portal.Proceed')}}
                                        </a>
                                    @endif
                                @endif

                                @if((auth()->user()->registration_type == "Buyer" || auth()->user()->hasAnyRole(['Buyer Payment Admin', 'Buyer Purchaser', 'Buyer Purchase Admin'])) && $invoices[0]->invoice_status == 3)
                                    <div class="flex mt-4 mb-4">
                                        <div class="flex flex-wrap"><img class="px-3 py-3 h-20" src="{{url('images/stamps/Artboard-6@8x.png')}}" alt="{{__('portal.Paid')}}"></div>
                                        <div class="flex flex-wrap justify-content-center mt-6"><strong>{{__('portal.Invoice paid on')}}: &nbsp;</strong> <span style="font-family: sans-serif">{{$invoices[0]->BankPayment->created_at}}</div>
                                    </div>
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
            </div>
        </div>
    </x-app-layout>
@endif
