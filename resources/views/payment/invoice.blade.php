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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Proforma Invoices') }} </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Invoices History')}}</h2>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">{{ session('message') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if ($proformaInvoices->count())
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table id="proforma-table" class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs uppercase text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    #
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs uppercase text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.Invoice')}} #
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs uppercase text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.PO')}} #
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs uppercase text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.Category Name')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs uppercase text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.P.O Date')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs uppercase text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.Requisition Type')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs uppercase text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.Status')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs uppercase text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    @if (auth()->user()->registration_type == 'Buyer')
                                                        {{__('portal.Payment')}}
                                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                                        {{__('portal.Payment Status')}}
                                                    @endif
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs uppercase text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.View')}}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($proformaInvoices as $dn)
                                                <tr>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        {{__('portal.Inv.')}}-{{ $dn->id }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        {{__('portal.PO')}}-{{ $dn->purchase_order->id }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @php
                                                            $record = \App\Models\Category::where('id',$dn->purchase_order->item_code)->first();
                                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                        @endphp
                                                        {{ $record->name }}, @if(isset($parent)){{ $parent->name }} @endif
                                                        {{--                                                           {{ $dn->purchase_order->item_name }}--}}
                                                        {{-- <a href="{{ route('po.show', $dn->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{ $dn->item_name }}</a> --}}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        {{ Carbon\Carbon::parse($dn->purchase_order->po_date)->format('d-m-Y') }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dn->rfq_type == 1 ) {{__('portal.Multiple')}} @elseif($dn->rfq_type == 0) {{__('portal.Single')}} @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if (auth()->user()->registration_type == 'Buyer')
                                                            @if ($dn->invoice_status == 0)
                                                                <span class="text-yellow-400"> {{__('portal.Waiting for payment')}} </span>
                                                            @elseif($dn->invoice_status == 1)
                                                                <span class="text-yellow-400"> {{__('portal.Waiting for Emdad confirmation')}} </span>
                                                            @elseif($dn->invoice_status == 3)
                                                                <span class="text-green-600"> {{__('portal.Manual payment Confirmed')}} </span>
                                                            @else
                                                                <span class="text-red-600"> {{__('portal.Payment rejected')}} </span>
                                                            @endif
                                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                                            @if ($dn->invoice_status == 0)
                                                                <span class="text-yellow-400"> {{__('portal.Waiting for payment')}} </span>
                                                            @elseif($dn->invoice_status == 1)
                                                                <span class="text-yellow-400"> {{__('portal.Waiting for confirmation')}} </span>
                                                            @elseif($dn->invoice_status == 3)
                                                                <span class="text-green-600"> {{__('portal.Create Delivery Note')}} </span>
                                                            @else
                                                                <span class="text-red-600"> {{__('portal.Payment rejected')}} </span>
                                                            @endif
                                                        @else
                                                            {{__('portal.N/A')}}
                                                        @endif

                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">

                                                        @if (auth()->user()->registration_type == 'Buyer')
                                                            @if($dn->invoice_status == '0' || $dn->invoice_status == '2')
                                                                @if($dn->invoice_status == '0')

                                                                    @if($dn->rfq_type == 1)
                                                                        <a href=" {{ route('bank-payments.create', $dn->id) }}" class="text-blue-600 hover:underline">
                                                                            {{__('portal.Manual Payment')}}
                                                                        </a> |
                                                                    @elseif($dn->rfq_type == 0)
                                                                        <a href=" {{ route('singleCategoryBankPaymentCreate', $dn->rfq_no) }}" class="text-blue-600 hover:underline">
                                                                            {{__('portal.Manual Payment')}}
                                                                        </a> |
                                                                    @endif

                                                                    <form action="{{route('invoicePayment.stepOne')}}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="invoice_id" value="{{$dn->id}}">
                                                                        <button class="text-blue-600 hover:underline">{{__('portal.Online Payment')}}</button>
                                                                    </form>


                                                                @elseif($dn->invoice_status == '2')
                                                                    @if($dn->rfq_type == 1 )
                                                                        <a href=" {{ route('bank-payments.edit', $dn->id) }}" class="text-blue-600 hover:underline">
                                                                            {{__('portal.Proceed')}}
                                                                        </a>
                                                                    @elseif($dn->rfq_type == 0)
                                                                        <a href=" {{ route('singleCategoryBankPaymentEdit', $dn->id) }}" class="text-blue-600 hover:underline">
                                                                            {{__('portal.Proceed')}}
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            @elseif($dn->invoice_status == '1')
                                                                <span class="text-yellow-400"> {{__('portal.Emdad verification pending')}} </span>
                                                            @elseif($dn->invoice_status == '2')
                                                                <span class="text-red-700"> {{__('portal.Emdad rejected manual payment')}} </span>
                                                            @elseif($dn->invoice_status == '3' && isset($dn->bankPayment->supplier_payment_status) && $dn->bankPayment->supplier_payment_status == 3)
                                                                <span class="text-green-600"> {{__('portal.Payment received by supplier')}} </span>
                                                            @elseif($dn->invoice_status == '3')
                                                                <span class="text-green-600"> {{__('portal.Payment in Transit, on hold, with Emdad')}} </span>
                                                            @endif

                                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                                            @if($dn->invoice_status == '0')
                                                                <span class="text-yellow-400"> {{__('portal.Waiting for payment')}} </span>
                                                            @elseif($dn->invoice_status == '1')
                                                                @php $bankPaymentId = \App\Models\BankPayment::where('invoice_id', $dn->id)->first(); @endphp
                                                                {{--                                                        <a href="{{ route('bank-payments.show', $bankPaymentId->id) }}" class="text-blue-600 hover:underline">--}}
                                                                {{--                                                            View Payment--}}
                                                                <span class="text-yellow-400"> {{__('portal.Emdad verification pending')}} </span>
                                                            @elseif($dn->invoice_status == '2')
                                                                <span class="text-red-700"> {{__('portal.Manual payment rejected')}} </span>
                                                            @elseif($dn->invoice_status == '3' && isset($dn->bankPayment->supplier_payment_status) && $dn->bankPayment->supplier_payment_status == 3)
                                                                <span class="text-green-600"> {{__('portal.Payment received')}} </span>
                                                            @elseif($dn->invoice_status == '3')
                                                                <span class="text-green-600"> {{__('portal.Payment in Transit, Received by Emdad')}} </span>
                                                            @endif
                                                        @endif


                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dn->rfq_type == 1 )
                                                            <a href="{{ route('invoiceView',$dn->id) }}" class="hover:underline hover:text-blue-800 text-blue-500">
                                                                <svg class="w-6 h-6 inline" fill="none" stroke="orange" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                    </path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @elseif($dn->rfq_type == 0)
                                                            <a href="{{ route('singleCategoryInvoiceView',$dn->rfq_no) }}" class="hover:underline hover:text-blue-800 text-blue-500">
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
        $(document).ready(function () {
            $('#proforma-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

    </script>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Proforma Invoices') }} </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Invoices History')}}</h2>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-3">{{ session('message') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    @if ($proformaInvoices->count())
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table id="proforma-table" class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    #
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.Invoice')}} #
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.PO')}} #
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.Category Name')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.P.O Date')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.Requisition Type')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.Status')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    @if (auth()->user()->registration_type == 'Buyer')
                                                        {{__('portal.Payment')}}
                                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                                        {{__('portal.Payment Status')}}
                                                    @endif
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                    {{__('portal.View')}}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($proformaInvoices as $dn)
                                                <tr>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black" style="font-family: sans-serif">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        {{__('portal.Inv.')}}-<span style="font-family: sans-serif">{{ $dn->id }}</span>
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        {{__('portal.PO')}}-<span style="font-family: sans-serif">{{ $dn->purchase_order->id }}</span>
                                                    </td>


                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @php
                                                            $record = \App\Models\Category::where('id',$dn->purchase_order->item_code)->first();
                                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                        @endphp
                                                        {{ $record->name_ar }}, @if(isset($parent)){{ $parent->name_ar }} @endif
                                                        {{--                                                           {{ $dn->purchase_order->item_name }}--}}
                                                        {{-- <a href="{{ route('po.show', $dn->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{ $dn->item_name }}</a> --}}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black" style="font-family: sans-serif">
                                                        {{ Carbon\Carbon::parse($dn->purchase_order->po_date)->format('d-m-Y') }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dn->rfq_type == 1 ) {{__('portal.Multiple')}} @elseif($dn->rfq_type == 0) {{__('portal.Single')}} @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if (auth()->user()->registration_type == 'Buyer')
                                                            @if ($dn->invoice_status == 0)
                                                                <span class="text-yellow-400"> {{__('portal.Waiting for payment')}} </span>
                                                            @elseif($dn->invoice_status == 1)
                                                                <span class="text-yellow-400"> {{__('portal.Waiting for Emdad confirmation')}} </span>
                                                            @elseif($dn->invoice_status == 3)
                                                                <span class="text-green-600"> {{__('portal.Manual payment Confirmed')}} </span>
                                                            @else
                                                                <span class="text-red-600"> {{__('portal.Payment rejected')}} </span>
                                                            @endif
                                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                                            @if ($dn->invoice_status == 0)
                                                                <span class="text-yellow-400"> {{__('portal.Waiting for payment')}} </span>
                                                            @elseif($dn->invoice_status == 1)
                                                                <span class="text-yellow-400"> {{__('portal.Waiting for confirmation')}} </span>
                                                            @elseif($dn->invoice_status == 3)
                                                                <span class="text-green-600"> {{__('portal.Create Delivery Note')}} </span>
                                                            @else
                                                                <span class="text-red-600"> {{__('portal.Payment rejected')}} </span>
                                                            @endif
                                                        @else
                                                            <span style="font-family: sans-serif">{{__('portal.N/A')}}</span>
                                                        @endif

                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">

                                                        @if (auth()->user()->registration_type == 'Buyer')
                                                            @if($dn->invoice_status == '0' || $dn->invoice_status == '2')
                                                                @if($dn->invoice_status == '0')

                                                                    @if($dn->rfq_type == 0)
                                                                        <a href=" {{ route('bank-payments.create', $dn->id) }}" class="text-blue-600 hover:underline">
                                                                            {{__('portal.Manual Payment')}}
                                                                        </a> |
                                                                    @elseif($dn->rfq_type == 1)
                                                                        <a href=" {{ route('singleCategoryBankPaymentCreate', $dn->rfq_no) }}" class="text-blue-600 hover:underline">
                                                                            {{__('portal.Manual Payment')}}
                                                                        </a> |
                                                                    @endif

                                                                    <form action="{{route('invoicePayment.stepOne')}}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="invoice_id" value="{{$dn->id}}">
                                                                        <button class="text-blue-600 hover:underline">{{__('portal.Online Payment')}}</button>
                                                                    </form>


                                                                @elseif($dn->invoice_status == '2')
                                                                    @if($dn->rfq_type == 1 )
                                                                        <a href=" {{ route('bank-payments.edit', $dn->id) }}" class="text-blue-600 hover:underline">
                                                                            {{__('portal.Proceed')}}
                                                                        </a>
                                                                    @elseif($dn->rfq_type == 0)
                                                                        <a href=" {{ route('singleCategoryBankPaymentEdit', $dn->id) }}" class="text-blue-600 hover:underline">
                                                                            {{__('portal.Proceed')}}
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            @elseif($dn->invoice_status == '1')
                                                                <span class="text-yellow-400"> {{__('portal.Emdad verification pending')}} </span>
                                                            @elseif($dn->invoice_status == '2')
                                                                <span class="text-red-700"> {{__('portal.Emdad rejected manual payment')}} </span>
                                                            @elseif($dn->invoice_status == '3' && isset($dn->bankPayment->supplier_payment_status) && $dn->bankPayment->supplier_payment_status == 3)
                                                                <span class="text-green-600"> {{__('portal.Payment received by supplier')}} </span>
                                                            @elseif($dn->invoice_status == '3')
                                                                <span class="text-green-600"> {{__('portal.Payment in Transit, on hold, with Emdad')}} </span>
                                                            @endif

                                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                                            @if($dn->invoice_status == '0')
                                                                <span class="text-yellow-400"> {{__('portal.Waiting for payment')}} </span>
                                                            @elseif($dn->invoice_status == '1')
                                                                @php $bankPaymentId = \App\Models\BankPayment::where('invoice_id', $dn->id)->first(); @endphp
                                                                {{--                                                        <a href="{{ route('bank-payments.show', $bankPaymentId->id) }}" class="text-blue-600 hover:underline">--}}
                                                                {{--                                                            View Payment--}}
                                                                <span class="text-yellow-400"> {{__('portal.Emdad verification pending')}} </span>
                                                            @elseif($dn->invoice_status == '2')
                                                                <span class="text-red-700"> {{__('portal.Manual payment rejected')}} </span>
                                                            @elseif($dn->invoice_status == '3' && isset($dn->bankPayment->supplier_payment_status) && $dn->bankPayment->supplier_payment_status == 3)
                                                                <span class="text-green-600"> {{__('portal.Payment received')}} </span>
                                                            @elseif($dn->invoice_status == '3')
                                                                <span class="text-green-600"> {{__('portal.Payment in Transit, Received by Emdad')}} </span>
                                                            @endif
                                                        @endif


                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dn->rfq_type == 1 )
                                                            <a href="{{ route('invoiceView',$dn->id) }}" class="hover:underline hover:text-blue-800 text-blue-500">
                                                                <svg class="w-6 h-6 inline" fill="none" stroke="orange" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                    </path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @elseif($dn->rfq_type == 0)
                                                            <a href="{{ route('singleCategoryInvoiceView',$dn->rfq_no) }}" class="hover:underline hover:text-blue-800 text-blue-500">
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
        $(document).ready(function () {
            $('#proforma-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "language": {
                    "sSearch": "بحث:",
                    "oPaginate": {
                        "sFirst": "أولا",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الاخير"
                    },
                    "info": "عرض _PAGE_ ل _PAGES_ من _MAX_ المدخلات",
                },
            });
        });
    </script>
@endif
