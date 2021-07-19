<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
            <div class="bg-white overflow-hidden shadow-xl ">
                <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                    <div class="flex flex-wrap overflow-hidden bg-white p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <h3 class="text-2xl text-center"><strong>Invoice</strong></h3>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            @php
                                $supplierBusiness = \App\Models\Business::where('id', $invoice->supplier_business_id)->first();
                                $buyerBusiness = \App\Models\Business::where('id', $invoice->buyer_business_id)->first();
                            @endphp
                            <img src="{{(isset($supplierBusiness->business_photo_url)?Storage::url($supplierBusiness->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
                        </div>
                    </div>
                    <div class="flex flex-wrap overflow-hidden bg-white p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <strong>Supplier Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->user->name }}<br>
                            <strong>Supplier Business Name: &nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->business_name }}<br>
                            <strong>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->user->email }}<br>
                            <strong>Address: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $supplierBusiness->address }}<br>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            <strong>Invoice #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoice->id }}<br>
                            <strong>Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoice->purchase_order->created_at }}<br>
                        </div>
                    </div>
                    <div class="flex flex-wrap overflow-hidden bg-white p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-2/3">
                            <strong>Buyer Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->user->name }}<br>
                            <strong>Buyer Business Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->business_name }}<br>
                            <strong>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->user->email }}<br>
                            <strong>Address: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $buyerBusiness->address }}<br>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            <strong>Purchase Order #: &nbsp;&nbsp;</strong>{{ $invoice->purchase_order->id }}<br>
                            <strong>Category Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoice->purchase_order->item_name }}<br>
                            <strong>RFQ #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoice->purchase_order->rfq_no }}<br>
                            <strong>Quote #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoice->purchase_order->qoute_no }}<br>
                            <strong>Payment Terms: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoice->purchase_order->payment_term }}<br>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-black ">
                        <thead>
                        <tr>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                #
                            </th>
                            {{--<th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Category Number
                            </th>--}}
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                UOM
                            </th>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Quantity
                            </th>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Unit Price
                            </th>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Total
                            </th>

                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-black border-1 border-black">
                        <tr>
                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                1
                            </td>
                            {{--<td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                {{ $invoice->purchase_order->item_code }}
                            </td>--}}
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
                                {{ $invoice->purchase_order->unit_price }}
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                {{ number_format(($invoice->purchase_order->quantity * $invoice->purchase_order->unit_price), 2) }}
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <div class="flex flex-wrap overflow-hidden bg-white p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <strong>Sub-total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format(($invoice->purchase_order->quantity * $invoice->purchase_order->unit_price), 2) }}<br>
                            <strong>VAT %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoice->vat }}<br>
                            <strong>Shipment cost: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoice->purchase_order->shipment_cost }}<br>
                            <hr>
                            <strong>Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($invoice->total_cost, 2) }}<br>
                            <hr>
                        </div>
                    </div>

                    <br>
                    <br>

                    <div class="flex justify-between px-2 py-2 mt-2 h-15">
                        <div></div>
                        <div class="mt-3">Thank you for using Emdad platform for your business.</div>
                        <div></div>
                    </div>
                    <div class="flex justify-end px-2 py-2 h-15">
                        <div class="mt-2">Copied to Emdad records</div>
                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" style="margin-left: auto; margin-right: auto;"/></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
