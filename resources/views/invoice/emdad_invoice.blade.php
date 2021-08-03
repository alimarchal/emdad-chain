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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
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
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block flex flex-col bg-green rounded" id="alermessage">

                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <script>
                    $(document).ready(function() {
                        $('#alermessage').delay(2000).hide(0);
                        $('#roles-table').DataTable( {
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        } );
                    });

                </script>

                @php $total = 0; @endphp

                <div class="py-3">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <h2 class="text-2xl font-bold text-center">Emdad Invoices</h2>
                        <x-jet-validation-errors class="mb-4" />
                    @if ($emdadInvoices->count())
                            <div class="flex flex-col">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                            <table class="min-w-full divide-y divide-gray-200 " id="roles-table">
                                                <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider" style="text-align:center;">
                                                        #
                                                    </th>
                                                    <th scope="col" class="px-6 py-30 text-left text-xs font-medium text-gray-500 tracking-wider" style="text-align:center;">
                                                        Supplier Business Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-30 text-left text-xs font-medium text-gray-500 tracking-wider" style="text-align:center;">
                                                        Invoice #
                                                    </th>
                                                    <th scope="col" class="px-6 py-30 text-left text-xs font-medium text-gray-500 tracking-wider" style="text-align:center;">
                                                        Invoice Type
                                                    </th>
                                                    <th scope="col" class="px-6 py-30 text-left text-xs font-medium text-gray-500 tracking-wider" style="text-align:center;">
                                                        Invoice status
                                                    </th>
                                                    {{--<th scope="col" class="px-6 py-30 text-left text-xs font-medium text-gray-500 tracking-wider" style="text-align:center;">
                                                        Emdad Invoice status
                                                    </th>--}}
                                                    <th scope="col" class="px-6 py-30 text-left text-xs font-medium text-gray-500 tracking-wider" style="text-align:center;">
                                                        Action
                                                    </th>

                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200 ">
                                                    @foreach ($emdadInvoices as $emdadInvoice)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap ml-10" style="text-align:center;">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            @php $supplierName = \App\Models\User::where('id', $emdadInvoice->invoice->supplier_user_id)->first(); @endphp
                                                            <td class="px-6 py-4 whitespace-nowrap ml-10" style="text-align:center;">
                                                                <a href="{{ route('business.show', $supplierName->business->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{ $supplierName->business->business_name }}</a>
                                                            </td>

                                                            <td class="px-6 py-4 whitespace-nowrap ml-10" style="text-align:center;">
                                                                <a href="{{route('emdadInvoiceView', $emdadInvoice->id)}}" class="hover:underline text-blue-600" target="_blank">{{$emdadInvoice->invoice->id}}</a>
                                                            </td>

                                                            <td class="whitespace-nowrap ml-10" style="text-align:center;">
                                                                <span>@if($emdadInvoice->invoice->invoice_type == 1) Proforma Invoice @else Final Invoice @endif</span>
                                                            </td>

                                                            <td class="whitespace-nowrap ml-10" style="text-align:center;">
                                                                <span>
                                                                    @if($emdadInvoice->invoice->invoice_status == 0) Un-Paid
                                                                    @elseif($emdadInvoice->invoice->invoice_status == 1) Verification Pending
                                                                    @elseif($emdadInvoice->invoice->invoice_status == 2) Rejected
                                                                    @elseif($emdadInvoice->invoice->invoice_status == 3) Payment received
                                                                    @endif
                                                                </span>
                                                            </td>
                                                            {{--<td class="whitespace-nowrap ml-10" style="text-align:center;">
                                                                <span>@if($emdadInvoice->status == 1) Paid @else Un-paid @endif</span>
                                                            </td>--}}
                                                            <td class="whitespace-nowrap ml-10" style="text-align:center;">
                                                                @if($emdadInvoice->invoice->invoice_status == 3 && $emdadInvoice->invoice->invoice_type == 0 && $emdadInvoice->send_status == 0)
                                                                    <a href="{{route('emdadGenerateInvoice', $emdadInvoice->id)}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                                                                        Send Emdad Invoice
                                                                    </a>
                                                                @elseif($emdadInvoice->invoice->invoice_status != 3 && $emdadInvoice->invoice->invoice_type == 0 && $emdadInvoice->send_status == 0)
                                                                    <a class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                                        Invoice Un-paid
                                                                    </a>
                                                                @elseif($emdadInvoice->invoice->invoice_type == 1)
                                                                    <a @if($emdadInvoice->invoice->invoice_status == 2) class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150" @else class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-600 transition ease-in-out duration-150" @endif>
                                                                        @if($emdadInvoice->invoice->invoice_status == 0) Proforma Invoice Un-paid
                                                                        @elseif($emdadInvoice->invoice->invoice_status == 1) Proforma invoice verification Pending
                                                                        @elseif($emdadInvoice->invoice->invoice_status == 2) Proforma invoice rejected
                                                                        @elseif($emdadInvoice->invoice->invoice_status == 3) Proforma invoice accepted
                                                                        @endif
                                                                    </a>
                                                                @elseif($emdadInvoice->send_status == 1)
                                                                    <a class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                                        Emdad Invoice Sent
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
                                <strong class="mr-1">No record found...!</strong>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
