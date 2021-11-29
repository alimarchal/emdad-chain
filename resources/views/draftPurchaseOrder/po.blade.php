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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Draft Purchase Orders') }}</h2>
        </x-slot>
        <div class="py-12">
            <h2 class="text-2xl font-bold py-0 text-center m-5">{{__('portal.Purchase Orders Center')}}</h2>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session()->has('message'))
                    <div class="mb-3 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">{{ session('message') }}</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{-- <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                     <a href="{{route('generatePDF')}}"
                     class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                     Generate PDF
                     </a>
                     </div> --}}

                    @if ($dpos->count())
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table id="po-table" class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.PO')}} #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Category')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Requisition Type')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.P.O Date')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.P.O Status')}}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Payment')}}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Payment Status')}}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor"
                                                             viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                            </path>
                                                        </svg>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.View')}}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($dpos as $dpo)
                                                <tr>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->rfq_type == 1)
                                                            <a href="{{ route('po.show', $dpo->id) }}" class="hover:text-blue-500 hover:underline text-blue-500">
                                                                {{__('portal.PO')}}-{{ $dpo->id }}
                                                            </a>
                                                        @elseif($dpo->rfq_type == 0)
                                                            <a href="{{ route('singleCategoryPOByID', $dpo->rfq_no) }}" class="hover:text-blue-500 hover:underline text-blue-500">
                                                                {{__('portal.PO')}}-{{ $dpo->id }}
                                                            </a>
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @php
                                                            $record = \App\Models\Category::where('id',$dpo->item_code)->first();
                                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                        @endphp
                                                        {{ $record->name }}@if(isset($parent)), {{ $parent->name }} @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->rfq_type == 1) {{__('portal.Multiple')}} @elseif($dpo->rfq_type == 0) {{__('portal.Single')}} @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        {{ $dpo->po_date }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if ($dpo->status == 'prepareDelivery')
                                                            <span class="text-green-600"> {{__('portal.Preparing Delivery')}} </span>
                                                        @elseif ($dpo->status == 'cancel')
                                                            <span class="text-red-600"> {{__('portal.canceled')}} </span>
                                                        @elseif ($dpo->status == 'approved')
                                                            <span class="text-green-600"> {{__('portal.Approved')}} </span>
                                                        @elseif ($dpo->status == 'completed')
                                                            <span class="text-green-600"> {{__('portal.Completed')}} </span>
                                                        @else
                                                            {{ $dpo->status }}
                                                        @endif

                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->payment_term == 'Cash') {{__('portal.Cash')}}
                                                        @elseif($dpo->payment_term == 'Credit') {{__('portal.Credit')}}
                                                        @elseif($dpo->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                                        @elseif($dpo->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                                        @elseif($dpo->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                                        @elseif($dpo->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->payment_term == 'Cash' || auth()->user()->can('all') && auth()->user()->hasRole('CEO') && auth()->user()->status == 3)
                                                            {{--@php $proformaInvoice = \App\Models\ProformaInvoice::where('draft_purchase_order_id', $dpo->id)->first(); @endphp--}}
                                                            @php $proformaInvoice = \App\Models\Invoice::where('draft_purchase_order_id', $dpo->id)->first(); @endphp
                                                            @if (isset($proformaInvoice) && $proformaInvoice->invoice_status == 0)
                                                                <a>{{__('portal.Waiting for payment')}}</a>
                                                            @elseif (isset($proformaInvoice) && $proformaInvoice->invoice_status == 2)
{{--                                                                <a>{{__('portal.Proforma invoice rejected by Emdad')}}</a>--}}
                                                                <span class="text-red-600">{{__('portal.Payment not confirmed by Emdad')}}</span>
                                                            @elseif (isset($proformaInvoice) && $proformaInvoice->invoice_status == 3)
{{--                                                                <a>{{__('portal.Proforma invoice confirmed by Emdad')}}</a>--}}
                                                                <span class="text-green-600">{{__('portal.Payment received by Emdad')}}</span>
                                                            @elseif($dpo->status == 'pending')
                                                                <a>{{__('portal.DPO not approved yet')}}</a>
                                                            @else
                                                                <a>{{__('portal.Waiting for payment')}}</a>
                                                            @endif
                                                        @else
{{--                                                            @if(auth()->user()->registration_type == 'Supplier')--}}
                                                            @if(auth()->user()->hasRole('CEO') && auth()->user()->status == 3)
                                                                @if($dpo->payment_term != 'Cash')
{{--                                                                    <a href="{{ url('deliveryNote') }}" class="hover:text-blue-900 hover:underline text-blue-900"> {{__('portal.Generate delivery note')}} </a>--}}

                                                                    @php $invoice = \App\Models\Invoice::where('draft_purchase_order_id', $dpo->id)->first(); @endphp
                                                                    @if($dpo->status == 'approved' && auth()->user()->registration_type == 'Supplier')
                                                                        <span> {{__('portal.Generate delivery note')}} </span>
                                                                    @elseif(!isset($invoice) && auth()->user()->registration_type == 'Supplier')
                                                                        <span>{{__('portal.Generate Final Invoice')}}</span>
                                                                    @elseif($dpo->status == 'approved' && auth()->user()->registration_type == 'Buyer')
                                                                        <span>{{__('portal.Invoice not generated')}}</span>
                                                                    @elseif(!isset($invoice) && auth()->user()->registration_type == 'Buyer')
                                                                        <span>{{__('portal.Invoice not generated')}}</span>
                                                                    @elseif(isset($invoice))
                                                                        <span>{{__('portal.Invoice generated')}}</span>
                                                                    @endif

                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->file)
                                                            <a href="{{ Storage::url($dpo->file) }}">
                                                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor"
                                                                     viewBox="0 0 24 24"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @else
                                                                {{__('portal.N/A')}}
                                                        @endif

                                                        <br>
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->rfq_type == 1)
                                                            <a href="{{ route('po.show', $dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                <svg class="w-6 h-6 inline" fill="none" stroke="orange"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                    </path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @elseif($dpo->rfq_type == 0)
                                                            <a href="{{ route('singleCategoryPOByID', $dpo->rfq_no) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                <svg class="w-6 h-6 inline" fill="none" stroke="orange"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                    </path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @endif

                                                        <br>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">{{__('portal.No record found...!')}}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#po-table').DataTable( {
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Draft Purchase Orders') }}</h2>
        </x-slot>
        <div class="py-12">
            <h2 class="text-2xl font-bold py-0 text-center m-5">{{__('portal.Purchase Orders Center')}}</h2>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session()->has('message'))
                    <div class="mb-3 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-3">{{ session('message') }}</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    @if ($dpos->count())

                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table id="po-table" class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.PO')}} #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Category')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Requisition Type')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.P.O Date')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.P.O Status')}}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Payment')}}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Payment Status')}}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor"
                                                             viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                            </path>
                                                        </svg>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.View')}}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($dpos as $dpo)
                                                <tr>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black" style=" font-family: sans-serif;">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->rfq_type == 1)
                                                            <a href="{{ route('po.show', $dpo->id) }}" class="hover:text-blue-500 hover:underline text-blue-500">
                                                                {{__('portal.PO')}}-<span style=" font-family: sans-serif;">{{ $dpo->id }}</span>
                                                            </a>
                                                        @elseif($dpo->rfq_type == 0)
                                                            <a href="{{ route('singleCategoryPOByID', $dpo->rfq_no) }}" class="hover:text-blue-500 hover:underline text-blue-500">
                                                                {{__('portal.PO')}}-<span style=" font-family: sans-serif;">{{ $dpo->id }}</span>
                                                            </a>
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @php
                                                            $record = \App\Models\Category::where('id',$dpo->item_code)->first();
                                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                        @endphp
                                                        {{ $record->name_ar }}@if(isset($parent)), {{ $parent->name_ar }} @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->rfq_type == 1) {{__('portal.Multiple')}} @elseif($dpo->rfq_type == 0) {{__('portal.Single')}} @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black" style=" font-family: sans-serif;">
                                                        {{ $dpo->po_date }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if ($dpo->status == 'prepareDelivery')
                                                            <span class="text-green-600"> {{__('portal.Preparing Delivery')}} </span>
                                                        @elseif ($dpo->status == 'cancel')
                                                            <span class="text-red-600"> {{__('portal.canceled')}} </span>
                                                        @elseif ($dpo->status == 'approved')
                                                            <span class="text-green-600"> {{__('portal.Approved')}} </span>
                                                        @elseif ($dpo->status == 'completed')
                                                            <span class="text-green-600"> {{__('portal.Completed')}} </span>
                                                        @else
                                                            {{ $dpo->status }}
                                                        @endif

                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->payment_term == 'Cash') {{__('portal.Cash')}}
                                                        @elseif($dpo->payment_term == 'Credit') {{__('portal.Credit')}}
                                                        @elseif($dpo->payment_term == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                                        @elseif($dpo->payment_term == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                                        @elseif($dpo->payment_term == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                                        @elseif($dpo->payment_term == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->payment_term == 'Cash' || auth()->user()->can('all') && auth()->user()->hasRole('CEO') && auth()->user()->status == 3)
                                                            {{--@php $proformaInvoice = \App\Models\ProformaInvoice::where('draft_purchase_order_id', $dpo->id)->first(); @endphp--}}
                                                            @php $proformaInvoice = \App\Models\Invoice::where('draft_purchase_order_id', $dpo->id)->first(); @endphp
                                                            @if (isset($proformaInvoice) && $proformaInvoice->invoice_status == 0)
                                                                <span>{{__('portal.Waiting for payment')}}</span>
                                                            @elseif (isset($proformaInvoice) && $proformaInvoice->invoice_status == 2)
{{--                                                                <span>{{__('portal.Proforma invoice rejected by Emdad')}}</span>--}}
                                                                <span class="text-red-600">{{__('portal.Payment not confirmed by Emdad')}}</span>
                                                            @elseif (isset($proformaInvoice) && $proformaInvoice->invoice_status == 3)
{{--                                                                <span>{{__('portal.Proforma invoice confirmed by Emdad')}}</span>--}}
                                                                <span class="text-green-600">{{__('portal.Payment received by Emdad')}}</span>
                                                            @elseif($dpo->status == 'pending')
                                                                <span>{{__('portal.DPO not approved yet')}}</span>
                                                            @else
                                                                <span>{{__('portal.Waiting for payment')}}</span>
                                                            @endif
                                                        @else
                                                            @if(auth()->user()->hasRole('CEO') && auth()->user()->status == 3 )
                                                                @if($dpo->payment_term != 'Cash')
                                                                    @php $invoice = \App\Models\Invoice::where('draft_purchase_order_id', $dpo->id)->first(); @endphp
                                                                    @if($dpo->status == 'approved' && auth()->user()->registration_type == 'Supplier')
                                                                        <span> {{__('portal.Generate delivery note')}}</span>
                                                                    @elseif(!isset($invoice) && auth()->user()->registration_type == 'Supplier')
                                                                        <span>{{__('portal.Generate Final Invoice')}}</span>
                                                                    @elseif($dpo->status == 'approved' && auth()->user()->registration_type == 'Buyer')
                                                                        <span>{{__('portal.Invoice not generated')}}</span>
                                                                    @elseif(!isset($invoice) && auth()->user()->registration_type == 'Buyer')
                                                                        <span>{{__('portal.Invoice not generated')}}</span>
                                                                    @elseif(isset($invoice))
                                                                        <span>{{__('portal.Invoice generated')}}</span>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->file)
                                                            <a href="{{ Storage::url($dpo->file) }}">
                                                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="color: black">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                                </svg>
                                                            </a>
                                                        @else
                                                            <span style="font-family: sans-serif">{{__('portal.N/A')}}</span>
                                                        @endif

                                                        <br>
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->rfq_type == 1)
                                                            <a href="{{ route('po.show', $dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                <svg class="w-6 h-6 inline" fill="none" stroke="orange"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                    </path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @elseif($dpo->rfq_type == 0)
                                                            <a href="{{ route('singleCategoryPOByID', $dpo->rfq_no) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                <svg class="w-6 h-6 inline" fill="none" stroke="orange"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                    </path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @endif
                                                        <br>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-3">{{__('portal.No record found...!')}}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#po-table').DataTable( {
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

