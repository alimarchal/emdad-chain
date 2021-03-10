<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
            <div class="bg-white overflow-hidden shadow-xl ">
                <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                    <div class="flex flex-wrap overflow-hidden bg-white p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            <h3 class="text-2xl text-center"><strong>Invoice</strong></h3>
                            <strong>Invoice #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $invoice->id }}<br>
                            <strong>P. O. No#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->id }}<br>
                            <strong>Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->created_at }}<br>
                            <strong>RFQ#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->rfq_no }}<br>
                            <strong>RFQ Item#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->rfq_no }}<br>
                            <strong>Qoute#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->qoute_no }}<br>
                            <strong>Payment Terms#: &nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->payment_term }}<br>
                        </div>
                    </div>
                    <table class="min-w-full divide-y divide-black ">
                        <thead>
                            <tr>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Item Code
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Quantitiy
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    UOM
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Packing
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Brand
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Unit Price
                                </th>

                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-black border-1 border-black">
                            <tr>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    1
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $draftPurchaseOrder->item_code }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $draftPurchaseOrder->item_name }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $draftPurchaseOrder->quantity }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $draftPurchaseOrder->uom }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $draftPurchaseOrder->unit_price }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $draftPurchaseOrder->brand }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $draftPurchaseOrder->unit_price }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ number_format($draftPurchaseOrder->sub_total, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" rowspan="4">
                                </td>
                                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                    Sub Total
                                </td>
                                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                    {{ number_format($draftPurchaseOrder->sub_total, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                    VAT {{$draftPurchaseOrder->vat}}%
                                </td>
                                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                    {{ number_format($draftPurchaseOrder->sub_total * ($draftPurchaseOrder->vat/100), 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                    Shipment
                                </td>
                                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                    {{ number_format($draftPurchaseOrder->shipment_cost, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                    P.O Total
                                </td>
                                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                    {{ number_format(($draftPurchaseOrder->sub_total * ($draftPurchaseOrder->vat/100)) + ($draftPurchaseOrder->sub_total + $draftPurchaseOrder->shipment_cost), 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                        <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
                            <strong>Remarks: </strong> {{ strip_tags($draftPurchaseOrder->remarks) }} <br>
                            <strong>Warranty: </strong> {{ $draftPurchaseOrder->warranty }} <br>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
