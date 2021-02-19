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
                            <strong>Purchase Order #: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNote->purchase_order->id }}<br>
                            <strong>Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNote->purchase_order->created_at }}<br>
                            <strong>RFQ#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNote->purchase_order->rfq_no }}<br>
                            <strong>Qoute#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNote->purchase_order->qoute_no }}<br>
                            <strong>Payment Terms#: &nbsp;&nbsp;&nbsp;</strong>{{ $deliveryNote->purchase_order->payment_term }}<br>
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

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-black border-1 border-black">
                            <tr>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    1
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $deliveryNote->purchase_order->item_code }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $deliveryNote->purchase_order->item_name }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $deliveryNote->purchase_order->quantity }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $deliveryNote->purchase_order->uom }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $deliveryNote->purchase_order->unit_price }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-black border border-black">
                                    {{ $deliveryNote->purchase_order->brand }}
                                </td>
                            </tr>

                        </tbody>
                    </table>


                    <br>
                    <br>
                    <h2 class="text-2xl text-center font-bold">Invoice Generate</h2>
                    <p>
                        Delivery Address: {{ $deliveryNote->delivery_address }}<br>
                        City: {{ $deliveryNote->city }}<br>
                        Terms and Conditions: {{ $deliveryNote->terms_and_conditions }}<br>
                        Warranty: {{ $deliveryNote->warranty }}<br>
                    </p>
                    <form action="{{ route('deliveryNote.store') }}" method="post">
                        @csrf
                        <div class="mt-5">
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Generate Final Invoice
                            </button>
                        </div>
                    </form>

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
