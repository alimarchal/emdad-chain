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
            {{ __('Draft Purchase Orders') }}
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
                @if ($collection->count())
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200" id="generate-invoice">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                #
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Delivery Note
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Purchase Order
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Category Name
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                P.O Date
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                View
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($collection as $dn)
                                            <tr>
                                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                    Emdad-{{ $dn->id }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                    Emdad-{{ $dn->purchase_order->id }}
                                                </td>


                                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                    <a href="{{ route('singleCategoryViewNote', $dn->rfq_no) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{ $dn->purchase_order->item_name }}</a>
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                    {{ Carbon\Carbon::parse($dn->purchase_order->po_date)->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                    @if ($dn->status == 'prepareDelivery')
                                                        Preparing Delivery
                                                    @else
                                                        {{ $dn->status }}
                                                    @endif

                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                    <a href="{{ route('singleCategoryViewNote',$dn->rfq_no) }}" class="hover:underline hover:text-blue-800 text-blue-500">
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

<script>
    $(document).ready(function() {
        $('#generate-invoice').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    });
</script>

