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
            {{ __('Purchase Orders') }}
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
                <script>
                    $(document).ready(function() {
                        $('#alermessage').delay(2000).hide(0);
                        $('#po-table').DataTable( {
                            dom: 'Bfrtip',
                            buttons: [
                                // 'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        } );
                    });
                </script>
                @if ($pos->count())
                <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table id="po-table" class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                #
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                DPO Number
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Category Name
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                P.O Date
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                P.O Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                P.O Type
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Proceed Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                View
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($pos as $po)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                    EMDAD-{{ $po->id }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                    <a href="{{ route('singleCategoryPOByID', $po->rfq_no) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{ $po->item_name }}</a>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                    {{ $po->po_date }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                    @if ($po->status == 'prepareDelivery')
                                                        Preparing Delivery
                                                    @elseif ($po->status == 'cancel')
                                                        Canceled
                                                    @else
                                                        {{ $po->status }}
                                                    @endif

                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                    {{$po->payment_term}}
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                    @if($po->payment_term == 'Cash' || auth()->user()->can('all') && auth()->user()->hasRole('CEO') && auth()->user()->status == 3)
                                                        @php $proformaInvoice = \App\Models\Invoice::where('draft_purchase_order_id', $po->id)->first(); @endphp
                                                        @if (isset($proformaInvoice) && $proformaInvoice->invoice_status == 0)
                                                            <a>Waiting for payment</a>
                                                        @elseif (isset($proformaInvoice) && $proformaInvoice->invoice_status == 2)
                                                            <a>Proforma invoice rejected by Emdad</a>
                                                        @elseif (isset($proformaInvoice) && $proformaInvoice->invoice_status == 3)
                                                            <a>Proforma invoice confirmed by Emdad</a>
                                                        @elseif($po->status == 'pending')
                                                            <a>DPO not approved yet</a>
                                                        @else
                                                            <a>Waiting for proforma invoice</a>
                                                        @endif
                                                    @else
                                                        {{--                                                            <a>Completed</a>--}}
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                    <a href="{{ route('singleCategoryPOByID', $po->rfq_no) }}" class="hover:text-blue-900 hover:underline text-blue-900">View</a>
                                                    <br>
                                                    @if(auth()->user()->registration_type == 'Supplier')
                                                        @if($po->payment_term == 'Credit')
                                                            <a href="{{ url('deliveryNote') }}" class="hover:text-blue-900 hover:underline text-blue-900"> Generate delivery note </a>
                                                        @endif
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                        <!-- More rows... -->
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


</x-app-layout>
