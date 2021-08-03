@section('headerScripts')
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
@endsection
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User List') }}
            </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-2 text-center m-2">Emdad Invoices</h2>

        <div class="flex flex-col bg-white rounded ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200" id="emdad-invoices">
                            <thead class="bg-gray-50">

                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Emdad Invoice #
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{auth()->user()->business->business_name}} Invoice #
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Amount w/o VAT
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Emdad invoice amount (1.5 %)
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    View
                                </th>


                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($emdadInvoices as $emdadInvoice)
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $emdadInvoice->id }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $emdadInvoice->invoice->id }}
                                        </td>
                                        {{-- calculating total cost without VAT--}}
                                        @php
                                            $quote = \App\Models\Qoute::where('id', $emdadInvoice->invoice->quote->id)->first();
                                            $totalCost = ($quote->quote_quantity * $quote->quote_price_per_quantity) + $quote->shipment_cost;
                                            $totalEmdadCharges = $totalCost * (1.5 / 100);
                                        @endphp
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{$totalCost}}
                                        </td>
                                        <td class="px-7 py-4 text-center whitespace-nowrap">
                                            {{ $totalEmdadCharges }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <a href="{{route('emdadInvoiceView', $emdadInvoice->id)}}"
                                               class="hover:underline hover:text-blue-800 text-blue-500">
                                                <svg class="w-6 h-6 inline" fill="none" stroke="orange"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User List') }}
            </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-2 text-center m-2">Quotations List</h2>

        <div class="flex flex-col bg-white rounded ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">

                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    #
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    تاريخ
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    اسم المنتج
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    الوحدة
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    مقاس
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    العدد
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    السعر الأخير
                                </th>


                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    عرض السعر
                                </th>


                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($PlacedRFQ as $item)
                                @foreach ($item->OrderItems->sortBy('created_at') as $rfp)
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->id }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->created_at->format('d-m-Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->item_name }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->unit_of_measurement }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->size }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->quantity }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ number_format($rfp->last_price, 2) }} <br>
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $item->id, 'EOrderItemID' => $rfp->id]) }}"
                                               class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                عروض الأسعار  ({{ $rfp->qoutes->count() }})
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach
                                {{-- <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $item->created_at->format('d-m-Y') }}
                                    </td>


                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if ($item->business_id)
                                            <a href="{{ route('RFQItemsByID', $item->id) }}" class="hover:underline hover:text-blue-900 text-blue-900">
                                                EMDAD-{{ $item->business_id }}-{{ $item->id }}
                                            </a>
                                            @else
                                            <a href="{{ route('RFQItemsByID', $item->id) }}" class="hover:underline hover:text-blue-900 text-blue-900">
                                                EMDAD-{{ $item->business_id }}-{{ $item->id }}
                                            </a>
                                        @endif

                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <a href="{{ route('QoutationsBuyerReceivedRFQItemsByID', $item->id) }}"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                            View-Items: {{ $item->OrderItems->count() }})
                                        </a>
                                    </td>


                                </tr> --}}
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif

<script>
    $(document).ready(function() {
        $('#emdad-invoices').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    });
</script>
