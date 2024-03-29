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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Draft Purchase Orders') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">{{ session('message') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    {{--<div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                        <a href="{{route('generatePDF')}}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            Generate PDF
                        </a>
                    </div>--}}
                    @if ($dpos->count())
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200" id="delivery-note">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.PO')}} #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Category Name')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.P.O Date')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.P.O Type')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Requisition Type')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Invoice Status')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.P.O Status')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
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
                                                            {{__('portal.PO')}}-{{ $dpo->id }}
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            @if($dpo->rfq_type == 1)
                                                                <a href="{{ route('deliveryNoteView',$dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                    @php
                                                                        $record = \App\Models\Category::where('id',$dpo->item_code)->first();
                                                                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                                    @endphp
                                                                    {{ $record->name }} , {{ $parent->name }}
                                                                </a>
                                                            @else
                                                                <a href="{{ route('singleCategoryDeliveryNoteView',$dpo->rfq_no) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                    @php
                                                                        $record = \App\Models\Category::where('id',$dpo->item_code)->first();
                                                                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                                    @endphp
                                                                    {{ $record->name }} , {{ $parent->name }}
                                                                </a>
                                                            @endif

                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            {{ $dpo->po_date }}
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
                                                            @if($dpo->rfq_type == 1) {{__('portal.Multiple')}} @elseif($dpo->rfq_type == 0) {{__('portal.Single')}}  @endif
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            @if($dpo->payment_term == 'Cash' || auth()->user()->can('all') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                                                                @php $proformaInvoice = \App\Models\Invoice::where('draft_purchase_order_id', $dpo->id)->where('invoice_type', 1)->first(); @endphp
                                                                @if (isset($proformaInvoice) && $proformaInvoice->invoice_status == 3)
                                                                    <a class="text-yellow-400">{{__('portal.Create delivery Note')}}</a>
                                                                @elseif(isset($proformaInvoice))
                                                                    <a class="text-green-600">{{__('portal.Proforma invoice generated')}}</a>
                                                                @else
                                                                    @if($dpo->rfq_type == 1)
                                                                        <a href="{{route('generateProforma', $dpo->id)}}" class="text-green-900 hover:underline">{{__('portal.Generate proforma invoice')}}</a>
                                                                    @else
                                                                        <a href="{{route('singleCategoryGenerateProformaInvoice', $dpo->rfq_no)}}" class="text-green-900 hover:underline">{{__('portal.Generate proforma invoice')}}</a>
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @if(auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                                                                    @if($dpo->payment_term != 'Cash')
                                                                        @if($dpo->status == 'approved')
                                                                            <span class="text-yellow-400">{{__('portal.Create delivery Note')}}</span>
                                                                        @elseif($dpo->status == 'completed')
                                                                            <span class="text-green-600">{{__('portal.Completed')}}</span>
                                                                        @elseif($dpo->status == 'prepareDelivery')
                                                                            <span class="text-yellow-400">{{__('portal.Preparing delivery')}}</span>
                                                                        @elseif($dpo->status == 'cancel')
                                                                            <span class="text-red-700">{{__('portal.Purchase Order Canceled')}}</span>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            <a class="hover:text-blue-900 hover:underline text-blue-900">
                                                                @if($dpo->status == 'cancel') <span class="text-red-700">{{__('portal.Cancel')}}</span> @endif
                                                                @if($dpo->status == 'approved') <span class="text-green-600">{{__('portal.approved')}}</span> @endif
                                                                @if($dpo->status == 'completed') <span class="text-green-600">{{__('portal.Completed')}}</span> @endif
                                                                @if($dpo->status == 'pending') <span class="text-yellow-400">{{__('portal.pending')}}</span> @endif
                                                                @if($dpo->status == 'processing') <span class="text-yellow-400">{{__('portal.processing')}}</span> @endif
                                                            </a>
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            @if($dpo->rfq_type == 1)
                                                                <a href="{{ route('deliveryNoteView',$dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                    <svg class="w-6 h-6 inline" fill="none" stroke="orange" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                        </path>
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            @else
                                                                <a href="{{ route('singleCategoryDeliveryNoteView',$dpo->rfq_no) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                    <svg class="w-6 h-6 inline" fill="none" stroke="orange" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
            $('#delivery-note').DataTable( {
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Draft Purchase Orders') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-3">{{ session('message') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    {{--<div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                        <a href="{{route('generatePDF')}}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            Generate PDF
                        </a>
                    </div>--}}
                    @if ($dpos->count())
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200" id="delivery-note">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    #
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.PO')}} #
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.Category Name')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.P.O Date')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.P.O Type')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.Requisition Type')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.Invoice Status')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.P.O Status')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.View')}}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($dpos as $dpo)
                                                <tr>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black" style="font-family: sans-serif">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        {{__('portal.PO')}}-<span style="font-family: sans-serif">{{ $dpo->id }}</span>
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->rfq_type == 1)
                                                            <a href="{{ route('deliveryNoteView',$dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                @php
                                                                    $record = \App\Models\Category::where('id',$dpo->item_code)->first();
                                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                                @endphp
                                                                {{ $record->name_ar }} , {{ $parent->name_ar }}
                                                            </a>
                                                        @else
                                                            <a href="{{ route('singleCategoryDeliveryNoteView',$dpo->rfq_no) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                @php
                                                                    $record = \App\Models\Category::where('id',$dpo->item_code)->first();
                                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                                @endphp
                                                                {{ $record->name_ar }} , {{ $parent->name_ar }}
                                                            </a>
                                                        @endif

                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black" style="font-family: sans-serif">
                                                        {{ $dpo->po_date }}
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
                                                        @if($dpo->rfq_type == 1) {{__('portal.Multiple')}} @elseif($dpo->rfq_type == 0) {{__('portal.Single')}}  @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->payment_term == 'Cash' || auth()->user()->can('all') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                                                            @php $proformaInvoice = \App\Models\Invoice::where('draft_purchase_order_id', $dpo->id)->where('invoice_type', 1)->first(); @endphp
                                                            @if (isset($proformaInvoice) && $proformaInvoice->invoice_status == 3)
                                                                <a class="text-yellow-400">{{__('portal.Create delivery Note')}}</a>
                                                            @elseif(isset($proformaInvoice))
                                                                <a class="text-green-600">{{__('portal.Proforma invoice generated')}}</a>
                                                            @else
                                                                @if($dpo->rfq_type == 1)
                                                                    <a href="{{route('generateProforma', $dpo->id)}}" class="text-green-900 hover:underline">{{__('portal.Generate proforma invoice')}}</a>
                                                                @else
                                                                    <a href="{{route('singleCategoryGenerateProformaInvoice', $dpo->rfq_no)}}" class="text-green-900 hover:underline">{{__('portal.Generate proforma invoice')}}</a>
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if(auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                                                                @if($dpo->payment_term != 'Cash')
                                                                    @if($dpo->status == 'approved')
                                                                        <span class="text-yellow-400">{{__('portal.Create delivery Note')}}</span>
                                                                    @elseif($dpo->status == 'completed')
                                                                        <span class="text-green-600">{{__('portal.Completed')}}</span>
                                                                    @elseif($dpo->status == 'prepareDelivery')
                                                                        <span class="text-yellow-400">{{__('portal.Preparing delivery')}}</span>
                                                                    @elseif($dpo->status == 'cancel')
                                                                        <span class="text-red-700">{{__('portal.Purchase Order Canceled')}}</span>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        <a class="hover:text-blue-900 hover:underline text-blue-900">
                                                            @if($dpo->status == 'cancel') <span class="text-red-700">{{__('portal.Cancel')}}</span> @endif
                                                            @if($dpo->status == 'approved') <span class="text-green-600">{{__('portal.approved')}}</span> @endif
                                                            @if($dpo->status == 'completed') <span class="text-green-600">{{__('portal.Completed')}}</span> @endif
                                                            @if($dpo->status == 'pending') <span class="text-yellow-400">{{__('portal.pending')}}</span> @endif
                                                            @if($dpo->status == 'processing') <span class="text-yellow-400">{{__('portal.processing')}}</span> @endif
                                                        </a>
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->rfq_type == 1)
                                                            <a href="{{ route('deliveryNoteView',$dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                <svg class="w-6 h-6 inline" fill="none" stroke="orange" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                    </path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('singleCategoryDeliveryNoteView',$dpo->rfq_no) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                <svg class="w-6 h-6 inline" fill="none" stroke="orange" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
            $('#delivery-note').DataTable( {
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
