<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
            <div class="bg-white overflow-hidden shadow-xl ">
                <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
{{--                    <a href="{{ route('generatePDF', $draftPurchaseOrders[0]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">--}}
{{--                        Create PDF--}}
{{--                    </a>--}}
                </div>

                <div class="px-4 py-5 sm:p-6 bg-white shadow ">
                    <div class="flex flex-wrap overflow-hidden bg-gray-100 p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->buyer_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->buyer_business->business_name }}"/>
                            <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</h1>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <h1 class="text-center text-2xl">Draft Purchase Order</h1>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($draftPurchaseOrders[0]->supplier_business->business_photo_url) }}" alt="{{ $draftPurchaseOrders[0]->supplier_business->business_name }}"/>
                            <h1 class="text-center text-2xl">{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</h1>
                        </div>
                    </div>

                    <div class="flex flex-wrap overflow-hidden bg-white p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <strong>Generated By: </strong><br>
                            <p>{{ $draftPurchaseOrders[0]->buyer_business->business_name }}</p><br>
                            <strong>ID: </strong> {{ $draftPurchaseOrders[0]->buyer_business->user_id }}<br>
                            <strong>City: </strong>{{ $draftPurchaseOrders[0]->buyer_business->city }}<br>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <strong>Purchased From: </strong><br>
                            <p>{{ $draftPurchaseOrders[0]->supplier_business->business_name }}</p><br>

                            <strong>ID: </strong>{{ $draftPurchaseOrders[0]->supplier_business->user_id }}<br>
                            <strong>City: </strong>{{ $draftPurchaseOrders[0]->supplier_business->city }}<br>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            <h3 class="text-2xl text-center"><strong>Draft P.O</strong></h3>
                            <strong>D..P. O. #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->id }}<br>
                            <strong>Category Code: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->item_code }}<br>
                            <strong>Category Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->item_name }}<br>
                            <strong>Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                            <strong>RFQ #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->rfq_no }}<br>
                            <strong>Quote #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                            <strong>Payment Terms: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->payment_term }}<br>
                            <strong>VAT %: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->vat, 2) }}<br>
                            <strong>Shipping Fees: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->shipment_cost, 2) }}<br>
                            <strong>Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ number_format($draftPurchaseOrders[0]->total_cost, 2) }}<br>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-black ">
                        <thead>
                        <tr>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Quantity
                            </th>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Unit Price
                            </th>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                UOM
                            </th>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Brand
                            </th>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Remarks
                            </th>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Amount
                            </th>
                        </tr>
                        </thead>
                        @foreach($draftPurchaseOrders as $draftPurchaseOrder)
                        <tbody class="bg-white divide-y divide-black border-1 border-black">
                        <tr>
                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                {{$loop->iteration}}
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                {{ $draftPurchaseOrder->quantity }}
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                {{ $draftPurchaseOrder->unit_price }}
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                {{ $draftPurchaseOrder->uom }}
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                {{ $draftPurchaseOrder->brand }}
                            </td>

                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                @if(isset($draftPurchaseOrder->remarks)){{ strip_tags($draftPurchaseOrder->remarks) }} @else N/A @endif
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                {{ number_format($draftPurchaseOrder->sub_total, 2) }}
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>


                    <div class="flex flex-wrap overflow-hidden  p-4 mt-4">
                        <div class="w-full overflow-hidden lg:w-1/2 xl:w-1/2">
                            <strong>Mobile Number for OTP: </strong> {{ $draftPurchaseOrders[0]->otp_mobile_number }} <br>
                            <strong>Delivery Address: </strong> {{ strip_tags($draftPurchaseOrders[0]->delivery_address) }} <br>
                            <strong class="text-red-900">Note: </strong> <span class="text-red-700">
                                We acknowledge that {{$draftPurchaseOrders[0]->buyer_business->business_name }}
                                agrees to deal with {{$draftPurchaseOrders[0]->supplier_business->business_name}}. <br>
                                Emdad has no responsibility with the kind of delivery and the source of finance for this delivery.</span> <br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="note" id="acknowledge" required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Please Check to acknowledge
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="flex justify-center">
                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block" style="height: 104px"/></div>
                    </div>


                    <div class="flex justify-between mt-4 mb-4">

                        @if ($draftPurchaseOrders[0]->status == 'approved')
                            <span class="px-3 py-3 bg-green-800 text-white rounded">Approve</span>
                        @elseif ($draftPurchaseOrders[0]->status == 'cancel')
                            <span class="px-3 py-3 bg-red-800 text-white rounded">Cancel DPO</span>
                        @elseif ($draftPurchaseOrders[0]->status == 'rejectToEdit')
                            <span class="px-3 py-3 bg-red-600 text-white rounded uppercase">Rejected for Edit</span>
                        @else
                            @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                <form method="POST" action="{{route('singleCategoryApproved', [ 'rfqNo' => $draftPurchaseOrders[0]->rfq_no, 'supplierBusinessID' => $draftPurchaseOrders[0]->supplier_business_id]) }}">
                                    @csrf
                                    <button type="submit" onclick="checkbox()" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-red-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                        Approve DPO
                                    </button>
                                </form>
                                <form method="POST" action="{{route('singleCategoryCancel', [ 'rfqNo' => $draftPurchaseOrders[0]->rfq_no, 'supplierBusinessID' => $draftPurchaseOrders[0]->supplier_business_id]) }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                        Cancel DPO
                                    </button>
                                </form>
                            @endif
                        @endif


                    </div>

                    <div class="flex justify-between px-2 py-2 mt-2 h-15">
                        <div></div>
                        <div class="mt-3">Thanks for your Business</div>
                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block" style="height: 60px"/></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function checkbox() {
        if (!$("#acknowledge").is(":checked")) {
            alert('Please check NOTE to acknowledge')
            event.preventDefault();
        }
    }
</script>