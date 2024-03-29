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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Emdad Invoices')}}</h2>

        <div class="flex flex-col bg-white rounded ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200" id="emdad-invoices">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-sm uppercase text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Emdad Invoice')}} #
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-sm uppercase text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{auth()->user()->business->business_name}} {{__('portal.Invoice')}} #
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-sm uppercase text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Requisition Type')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-sm uppercase text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Amount w/o VAT')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-sm uppercase text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Emdad invoice amount (1.5 %)')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-sm uppercase text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.View')}}
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($emdadInvoices as $emdadInvoice)
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{__('portal.EmdInv')}}-{{ $emdadInvoice->id }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{__('portal.Inv.')}}-{{ $emdadInvoice->invoice->id }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($emdadInvoice->rfq_type == 1) {{__('portal.Multiple')}} @elseif($emdadInvoice->rfq_type == 0) {{__('portal.Single')}} @endif
                                        </td>
                                        @if($emdadInvoice->rfq_type == 1)
                                            {{-- calculating total cost without VAT--}}
                                            @php
                                                $quote = \App\Models\Qoute::where('id', $emdadInvoice->invoice->quote->id)->first();
                                                $totalCost = ($quote->quote_quantity * $quote->quote_price_per_quantity) + $quote->shipment_cost;
                                                $totalEmdadCharges = $totalCost * (1.5 / 100);
                                            @endphp
                                        @elseif($emdadInvoice->rfq_type == 0)
                                            {{-- calculating total cost without VAT for Single Category--}}
                                            @php
                                                $totalAmount = 0;
                                                $totalEmdadCharges = 0;
                                                $quotes = \App\Models\Qoute::where(['e_order_id' => $emdadInvoice->invoice->quote->e_order_id, 'supplier_business_id' => auth()->user()->business_id])->get();
                                                    foreach ($quotes as $quote)
                                                        {
                                                            $totalAmount += ($quote->quote_quantity * $quote->quote_price_per_quantity);
                                                        }
                                                        $totalAmount += $quotes[0]->shipment_cost;
                                                        $totalSingleCategoryEmdadCharges = $totalAmount * (1.5 / 100);
                                            @endphp
                                        @endif
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($emdadInvoice->rfq_type == 1)
                                                {{ number_format($totalCost,2) }} {{__('portal.SAR')}}
                                            @elseif($emdadInvoice->rfq_type == 0)
                                                {{ number_format($totalAmount,2)}} {{__('portal.SAR')}}
                                            @endif
                                        </td>
                                        <td class="px-7 py-4 text-center whitespace-nowrap">
                                            @if($emdadInvoice->rfq_type == 1)
                                                {{ number_format($totalEmdadCharges,2) }} {{__('portal.SAR')}}
                                            @elseif($emdadInvoice->rfq_type == 0)
                                                {{ number_format($totalSingleCategoryEmdadCharges,2) }} {{__('portal.SAR')}}
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($emdadInvoice->rfq_type == 1)
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
                                            @elseif($emdadInvoice->rfq_type == 0)
                                                <a href="{{route('singleCategoryView', $emdadInvoice->rfq_no)}}" class="hover:underline hover:text-blue-800 text-blue-500">
                                                    <svg class="w-6 h-6 inline" fill="none" stroke="orange"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endif
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
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Emdad Invoices')}}</h2>

        <div class="flex flex-col bg-white rounded ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200" id="emdad-invoices">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Emdad Invoice')}} #
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        <span style="font-family: sans-serif">{{auth()->user()->business->business_name}}</span> {{__('portal.Invoice')}} #
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Requisition Type')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Amount w/o VAT')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Emdad invoice amount (1.5 %)')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.View')}}
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($emdadInvoices as $emdadInvoice)
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap" style="font-family: sans-serif">
                                            {{__('portal.EmdInv')}}-{{ $emdadInvoice->id }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{__('portal.Inv.')}}-<span style="font-family: sans-serif">{{ $emdadInvoice->invoice->id }}</span>
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($emdadInvoice->rfq_type == 1) {{__('portal.Multiple')}} @elseif($emdadInvoice->rfq_type == 0) {{__('portal.Single')}} @endif
                                        </td>

                                        @if($emdadInvoice->rfq_type == 1)
                                            {{-- calculating total cost without VAT--}}
                                            @php
                                                $quote = \App\Models\Qoute::where('id', $emdadInvoice->invoice->quote->id)->first();
                                                $totalCost = ($quote->quote_quantity * $quote->quote_price_per_quantity) + $quote->shipment_cost;
                                                $totalEmdadCharges = $totalCost * (1.5 / 100);
                                            @endphp
                                        @elseif($emdadInvoice->rfq_type == 0)
                                            {{-- calculating total cost without VAT for Single Category--}}
                                            @php
                                                $totalAmount = 0;
                                                $totalEmdadCharges = 0;
                                                $quotes = \App\Models\Qoute::where(['e_order_id' => $emdadInvoice->invoice->quote->e_order_id, 'supplier_business_id' => auth()->user()->business_id])->get();
                                                    foreach ($quotes as $quote)
                                                        {
                                                            $totalAmount += ($quote->quote_quantity * $quote->quote_price_per_quantity);
                                                        }
                                                        $totalAmount += $quotes[0]->shipment_cost;
                                                        $totalSingleCategoryEmdadCharges = $totalAmount * (1.5 / 100);
                                            @endphp
                                        @endif
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($emdadInvoice->rfq_type == 1)
                                                <span style="font-family: sans-serif">{{ number_format($totalCost,2) }}</span> {{__('portal.SAR')}}
                                            @elseif($emdadInvoice->rfq_type == 0)
                                                <span style="font-family: sans-serif">{{ number_format($totalAmount,2)}}</span> {{__('portal.SAR')}}
                                            @endif
                                        </td>
                                        <td class="px-7 py-4 text-center whitespace-nowrap">
                                            @if($emdadInvoice->rfq_type == 1)
                                                <span style="font-family: sans-serif">{{ number_format($totalEmdadCharges,2) }}</span> {{__('portal.SAR')}}
                                            @elseif($emdadInvoice->rfq_type == 0)
                                                <span style="font-family: sans-serif">{{ number_format($totalSingleCategoryEmdadCharges,2) }}</span> {{__('portal.SAR')}}
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($emdadInvoice->rfq_type == 1)
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
                                            @elseif($emdadInvoice->rfq_type == 0)
                                                <a href="{{route('singleCategoryView', $emdadInvoice->rfq_no)}}" class="hover:underline hover:text-blue-800 text-blue-500">
                                                    <svg class="w-6 h-6 inline" fill="none" stroke="orange"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endif
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

    <script>
        $(document).ready(function() {
            $('#emdad-invoices').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "language": {
                    "sSearch": "بحث:",
                    "oPaginate": {
                        "sFirst":    	"أولا",
                        "sPrevious": 	"السابق",
                        "sNext":     	"التالي",
                        "sLast":     	"الاخير"
                    },
                    "info": "عرض _PAGE_ ل _PAGES_ من _MAX_ المدخلات",
                },
            } );
        });
    </script>
@endif
