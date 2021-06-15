<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
            <div class="bg-white overflow-hidden shadow-xl ">
                <div class="px-4 py-5 sm:p-6 bg-white shadow ">



                    <div class="flex flex-wrap overflow-hidden bg-white p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            {{-- <strong>Purchase From: </strong><br> --}}
                            {{-- <p>{{ $draftPurchaseOrder->buyer_business->business_name }}</p><br> --}}
                            {{-- <strong>ID: </strong> {{ $draftPurchaseOrder->buyer_business->user_id }}<br> --}}
                            {{-- <strong>City: </strong>{{ $draftPurchaseOrder->buyer_business->city }}<br> --}}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            {{-- <strong>Deliver From: </strong><br> --}}
                            {{-- <p>{{ $draftPurchaseOrder->supplier_business->business_name }}</p><br> --}}

                            {{-- <strong>ID: </strong>{{ $draftPurchaseOrder->supplier_business->user_id }}<br> --}}
                            {{-- <strong>City: </strong>{{ $draftPurchaseOrder->supplier_business->city }}<br> --}}
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                            <h3 class="text-2xl text-center"><strong>Delivery Note</strong></h3>
                            <strong>Purchase Order #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $draftPurchaseOrder->id }}<br>
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
                                    Category Code
                                </th>
                                <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Category Name
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
                            </tr>

                        </tbody>
                    </table>


                    <br>
                    <br>
                    @if ($draftPurchaseOrder->payment_term == 'Cash')
{{--                        @php $proformaPresent = \App\Models\ProformaInvoice::where('draft_purchase_order_id',$draftPurchaseOrder->id)->first(); @endphp--}}
                        @php $proforma = \App\Models\Invoice::where('draft_purchase_order_id',$draftPurchaseOrder->id)->where('invoice_type', 1)->first();@endphp
                        @if (isset($proforma) && $proforma->invoice_status == 3)
                            <h2 class="text-2xl text-center font-bold">Prepare Delivery Note</h2>
                            <form action="{{ route('deliveryNote.store') }}" method="post">
                                @csrf
                                <div class="grid grid-cols-12 gap-6">

                                    <div class="col-span-12">
                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                            Delivery Address
                                        </label>
                                        {{--                                <textarea name="delivery_address" id="delivery_address" class="form-textarea w-full">{{ strip_tags($draftPurchaseOrder->buyer_business->address) . ' - City: ' . $draftPurchaseOrder->buyer_business->city . ' - Phone #: ' . $draftPurchaseOrder->buyer_business->phone }}</textarea>--}}
                                        @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse_id)->first(); @endphp
                                        <textarea class="form-textarea w-full" disabled>{{$delivery->address}}</textarea>
                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                            City
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" value="{{ $delivery->city }}" disabled="disabled">
                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                            Warranty
                                        </label>
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" name="warranty" required>

                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                            Terms and Conditions
                                        </label>
                                        <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-textarea w-full"></textarea>
                                        <input type="hidden" value="{{ auth()->user()->id }}" name="update_user_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->user_id }}" name="user_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->business_id }}" name="business_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->supplier_user_id }}" name="supplier_user_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->supplier_business_id }}" name="supplier_business_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->shipment_cost }}" name="shipment_cost">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->quantity }}" name="quantity">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->unit_price }}" name="unit_price">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->otp_mobile_number }}" name="otp_mobile_number">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->vat }}" name="vat">
                                        <input type="hidden" value="{{ $draftPurchaseOrder->total_cost }}" name="total_cost">
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

                            <a  class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                               Note: Waiting for payment by buyer
                            </a>
                        @else
                            <a href="{{route('generateProforma', $draftPurchaseOrder->id)}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Click here to generate proforma invoice
                            </a>

                        @endif
                     @else
                        <h2 class="text-2xl text-center font-bold">Prepare Delivery Note</h2>
                        <form action="{{ route('deliveryNote.store') }}" method="post">
                            @csrf
                            <div class="grid grid-cols-12 gap-6">

                                <div class="col-span-12">
                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                        Delivery Address
                                    </label>
                                    {{--                                <textarea name="delivery_address" id="delivery_address" class="form-textarea w-full">{{ strip_tags($draftPurchaseOrder->buyer_business->address) . ' - City: ' . $draftPurchaseOrder->buyer_business->city . ' - Phone #: ' . $draftPurchaseOrder->buyer_business->phone }}</textarea>--}}
                                    @php $delivery = \App\Models\BusinessWarehouse::where('id', $draftPurchaseOrder->warehouse_id)->first(); @endphp
                                    <textarea class="form-textarea w-full" disabled>{{$delivery->address}}</textarea>
                                    {{--                                <textarea class="form-textarea w-full" disabled>{{$draftPurchaseOrder->buyer_business->address}}</textarea>--}}

                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                        City
                                    </label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" value="{{ $delivery->city }}" disabled="disabled">


                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="city">
                                        Warranty
                                    </label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="city" type="text" name="warranty" required>

                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="delivery_address">
                                        Terms and Conditions
                                    </label>
                                    <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-textarea w-full"></textarea>
                                    <input type="hidden" value="{{ auth()->user()->id }}" name="update_user_id">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->user_id }}" name="user_id">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->business_id }}" name="business_id">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->supplier_user_id }}" name="supplier_user_id">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->supplier_business_id }}" name="supplier_business_id">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->id }}" name="draft_purchase_order_id">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->shipment_cost }}" name="shipment_cost">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->quantity }}" name="quantity">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->unit_price }}" name="unit_price">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->otp_mobile_number }}" name="otp_mobile_number">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->vat }}" name="vat">
                                    <input type="hidden" value="{{ $draftPurchaseOrder->total_cost }}" name="total_cost">
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

                    <div class="flex justify-center">
                        <div><img src="{{ url('logo-full.png') }}" alt="EMDAD CHAIN LOGO" class="block h-10 w-auto" /></div>
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
