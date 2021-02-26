<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
            <div class="bg-white overflow-hidden shadow-xl ">
                <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                    <a href="{{ route('generatePDF', $draftPurchaseOrder) }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                        Generate PDF
                    </a>
                </div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                    <div class="flex flex-wrap overflow-hidden bg-gray-300 p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <img class="h-20 w-20 rounded-full object-cover" src="{{ $draftPurchaseOrder->buyer_business->business_photo_url }}" alt="{{ $draftPurchaseOrder->buyer_business->business_name }}" />
                            <h1 class="text-center text-2xl">{{ $draftPurchaseOrder->buyer_business->business_name }}</h1>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <h1 class="text-center text-2xl">Draft Purchase Order</h1>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <img class="h-20 w-20 rounded-full object-cover" src="{{ $draftPurchaseOrder->supplier_business->business_photo_url }}" alt="{{ $draftPurchaseOrder->supplier_business->business_name }}" />
                            <h1 class="text-center text-2xl">{{ $draftPurchaseOrder->supplier_business->business_name }}</h1>
                        </div>
                    </div>


                    <div class="flex flex-wrap overflow-hidden bg-white p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <strong>Purchase From: </strong><br>
                            <p>{{ $draftPurchaseOrder->buyer_business->business_name }}</p><br>
                            <strong>ID: </strong> {{ $draftPurchaseOrder->buyer_business->user_id }}<br>
                            <strong>City: </strong>{{ $draftPurchaseOrder->buyer_business->city }}<br>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <strong>Deliver From: </strong><br>
                            <p>{{ $draftPurchaseOrder->supplier_business->business_name }}</p><br>

                            <strong>ID: </strong>{{ $draftPurchaseOrder->supplier_business->user_id }}<br>
                            <strong>City: </strong>{{ $draftPurchaseOrder->supplier_business->city }}<br>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            <h3 class="text-2xl text-center"><strong>Draft P.O</strong></h3>
                            <strong>D..P. O. No#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->id }}<br>
                            <strong>Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->created_at }}<br>
                            <strong>RFQ#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->rfq_no }}<br>
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
                                    {{ number_format($draftPurchaseOrder->shipment_cost,2) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                    P.O Total
                                </td>
                                <td class="px-1 py-1 whitespace-nowrap text-sm text-black border border-black">
                                    {{ number_format(($draftPurchaseOrder->sub_total * ($draftPurchaseOrder->vat/100)) + $draftPurchaseOrder->sub_total, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                        <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
                            <strong>Remarks: </strong> {{ strip_tags($draftPurchaseOrder->remarks) }} <br>
                            <strong>Warranty: </strong> {{ $draftPurchaseOrder->warranty }} <br>
                            <strong>Terms & Conditions: </strong> None <br>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
                            <strong>Delivery Information</strong><br>
                            @php $warehouseName =  \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse)->first(); @endphp
                            <strong>Warehouse: @if(isset($warehouseName)){{$warehouseName->name}} @endif</strong><br>

                        </div>
                    </div>


                    <div class="flex justify-center">
                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" /></div>
                    </div>



                    <div class="flex justify-between mt-4 mb-4">


                        @if ($draftPurchaseOrder->status == 'approved')
                            <span class="px-3 py-3 bg-green-800 text-white rounded">Approve</span>
                        @elseif ($draftPurchaseOrder->status == 'cancel')
                            <span class="px-3 py-3 bg-red-800 text-white rounded">Cancel DPO</span>
                        @elseif ($draftPurchaseOrder->status == 'rejectToEdit')
                            <span class="px-3 py-3 bg-red-600 text-white rounded uppercase">Rejected for Edit</span>
                        @else
                            <a href="{{ route('dpo.approved', $draftPurchaseOrder->id) }}" class="inline-flex  mx-4  items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">DPO Approved</a>
                            <a href="{{ route('dpo.cancel', $draftPurchaseOrder->id) }}" class="inline-flex  mx-4  items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Cancel P.O</a>
                            <a href="{{ route('dpo.rejected', $draftPurchaseOrder->id) }}" class="inline-flex  mx-4  items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Reject to Edit</a>

                        @endif




                    </div>

                    <div class="flex justify-between px-2 py-2 mt-2 h-15">
                        <div></div>
                        <div class="mt-3">Thanks for your Business</div>
                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" /></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
