<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:2x-8">
            <div class="bg-white overflow-hidden shadow-xl ">
                <div class="px-4 py-5 sm:p-6 bg-white shadow ">

                    <div class="flex flex-wrap overflow-hidden bg-white p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            <h3 class="text-2xl text-center"><strong>Delivery Note</strong></h3>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                        </div>
                    </div>

                    <div class="flex flex-wrap overflow-hidden bg-white p-4">
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                            @if ($deliveryNotes[0]->status == 'completed')
                                <strong>Invoice #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNotes[0]->delivery->invoice_id }}<br>
                            @endif
                            <strong>Purchase Order #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNotes[0]->purchase_order->id }}<br>
{{--                            <strong>Category #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNotes[0]->purchase_order->item_code }}<br>--}}
                            <strong>Category Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNotes[0]->purchase_order->item_name }}<br>
                            <strong>Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNotes[0]->purchase_order->created_at }}<br>
                            <strong>RFQ #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNotes[0]->purchase_order->rfq_no }}<br>
                            <strong>Quote #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNotes[0]->purchase_order->qoute_no }}<br>
                            <strong>Payment Terms : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNotes[0]->purchase_order->payment_term }}<br>
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3">
                        </div>
                        <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 ">
                        </div>
                    </div>


                    <table class="min-w-full divide-y divide-black ">
                        <thead>
                        <tr>
                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                #
                            </th>

                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Description
                            </th>

                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                UOM
                            </th>


                            <th scope="col" class="px-2 py-2 border border-black bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Quantity
                            </th>

                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-black border-1 border-black">
                            @foreach($deliveryNotes as $deliveryNote)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{$loop->iteration}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $deliveryNote->purchase_order->eOrderItem->description }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $deliveryNote->purchase_order->uom }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                        {{ $deliveryNote->purchase_order->quantity }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <br>
                    <br>
                    @if ($deliveryNotes[0]->status == 'processing')
                        <h2 class="text-2xl text-center font-bold">Invoice Generate</h2>
                        <p>
                            <strong>Delivery Address:</strong> {{ $deliveryNotes[0]->delivery_address }}<br>
                            <strong>City:</strong> {{ $deliveryNotes[0]->city }}<br>
                            <strong>Terms and Conditions:</strong> {{ $deliveryNotes[0]->terms_and_conditions }}<br>
                            <strong>Warranty:</strong> {{ $deliveryNotes[0]->warranty }}<br>
                        </p>

                        <form action="{{ route('singleCategoryInvoiceGenerate') }}" method="post">
                            @csrf
                            <div class="mt-5">
                                <input type="hidden" name="rfq_no" value="{{ $deliveryNotes[0]->rfq_no }}">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    Generate Final Invoice
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
