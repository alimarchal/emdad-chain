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
                            <h3 class="text-2xl text-center"><strong>Delivery Note</strong></h3>
                            <strong>Purchase Order #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->id }}<br>
                            <strong>Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->created_at }}<br>
                            <strong>RFQ #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->rfq_no }}<br>
                            <strong>Category Code: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->item_code }}<br>
                            <strong>Category Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->item_name }}<br>
                            <strong>Quote #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->qoute_no }}<br>
                            <strong>Payment Terms #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrders[0]->payment_term }}<br>
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
                                    UOM
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Packing
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Brand
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
                                        {{ $draftPurchaseOrder->uom }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $draftPurchaseOrder->unit_price }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $draftPurchaseOrder->brand }}
                                    </td>
                                </tr>

                            </tbody>
                        @endforeach
                    </table>


                    <br>
                    <br>
                    @if ($draftPurchaseOrders[0]->payment_term == 'Cash')

                        @php $proforma = \App\Models\Invoice::where('draft_purchase_order_id',$draftPurchaseOrder->id)->where('invoice_type', 1)->first();@endphp

                        @if (isset($proforma) && $proforma->invoice_status == 3)
                            <h2 class="text-2xl text-center font-bold">Prepare Delivery Note</h2>
                            <form action="{{ route('singleCategoryDeliveryNoteStore', $draftPurchaseOrders[0]->rfq_no) }}" method="post">
                                @csrf
                                <div class="grid grid-cols-12 gap-6">
                                    <div class="col-span-12">
                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                            Delivery Address
                                        </label>
                                        @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrders[0]->warehouse_id)->first(); @endphp

                                        <textarea class="form-textarea w-full" disabled>{{$delivery->address}}</textarea>

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="city">City</label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" value="{{ $delivery->city }}" disabled="disabled">

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="city">Warranty</label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" name="warranty">

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">Terms and Conditions</label>
                                        <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-textarea w-full"></textarea>

                                        <input type="hidden" value="{{ $delivery->address }}" name="delivery_address">
                                        <input type="hidden" value="{{ $delivery->city }}" name="city">
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                        Create Delivery Note
                                    </button>
                                </div>
                            </form>
                        @elseif(isset($proforma))
                            <h2 class="text-2xl text-center font-bold">Proforma invoice Generated</h2>

                            <a class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                @if($proforma->invoice_status == 1)
                                    Note: Emdad verification pending
                                @elseif($proforma->invoice_status == 2)
                                    Manual payment rejected
                                @elseif($proforma->invoice_status == 3)
                                    Manual payment accepted
                                @else
                                    Note: Waiting for payment by buyer
                                @endif
                            </a>
                        @else
                            <a href="{{route('singleCategoryGenerateProformaInvoice', $draftPurchaseOrders[0]->rfq_no)}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Click here to generate proforma invoice
                            </a>
                        @endif

                    @else
                        <h2 class="text-2xl text-center font-bold">Prepare Delivery Note</h2>
                        <form action="{{ route('singleCategoryDeliveryNoteStore', $draftPurchaseOrders[0]->rfq_no) }}" method="post">
                            @csrf
                            <div class="grid grid-cols-12 gap-6">

                                <div class="col-span-12">
                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">Delivery Address</label>

                                    @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrders[0]->warehouse_id)->first(); @endphp

                                    <textarea class="form-textarea w-full" disabled>{{$delivery->address}}</textarea>

                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="city">City</label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" value="{{ $delivery->city }}" disabled="disabled">

                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="warranty">Warranty</label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="warranty" type="text" name="warranty">

                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="terms_and_conditions">Terms and Conditions</label>
                                    <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-textarea w-full"></textarea>

                                    <input type="hidden" value="{{ $delivery->address }}" name="delivery_address">
                                    <input type="hidden" value="{{ $delivery->city }}" name="city">
                                </div>
                            </div>

                            <div class="mt-5">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    Create Delivery Note
                                </button>
                            </div>
                        </form>
                    @endif

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
