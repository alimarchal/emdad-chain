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
        <h2 class="text-2xl font-bold py-2 text-center m-15">{{__('portal.Items List')}} @if (!$shipmentDetails->count()) {{__('portal.seems empty')}} @endif
        </h2>

        @if ($shipmentDetails->count())
            @php $total = 0; @endphp
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200" id="shipment-table">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{__('portal.Delivery ID')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{__('portal.Supplier Business Name')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{__('portal.Status')}}
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($shipmentDetails as $shipmentDetail)
                                        <tr>
                                            <td class="px-6 text-center py-4 whitespace-nowrap">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-6 text-center py-4 whitespace-nowrap">
                                                <a href="{{route('delivery.show', encrypt($shipmentDetail->rfq_no))}}" class="hover:underline text-blue-600">{{__('portal.D')}}-{{ $shipmentDetail->delivery_id }}</a>
                                            </td>

                                            <td class="px-6 text-center py-4 whitespace-nowrap">
                                                @php $supplierBusiness = \App\Models\Business::where('id', $shipmentDetail->supplier_business_id)->first();  @endphp
                                                {{ $supplierBusiness->business_name }}
                                            </td>

                                            <td class="px-6 text-center py-4 whitespace-nowrap">
                                                @if($shipmentDetail->status == 1 )
                                                    <span class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">
                                                        {{__('portal.Delivered')}}
                                                    </span>
                                                @else
                                                    <span class="bg-red-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">
                                                        {{__('portal.Not Delivered yet')}}
                                                    </span>
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
        @endif
        <div class="mt-5">
            <a href="{{route('shipment.index')}}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                {{__('portal.Back')}}
            </a>
        </div>

    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#shipment-table').DataTable( {
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
        <h2 class="text-2xl font-bold py-2 text-center m-15">{{__('portal.Items List')}} @if (!$shipmentDetails->count()) {{__('portal.seems empty')}} @endif
        </h2>

        @if ($shipmentDetails->count())
            @php $total = 0; @endphp
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200" id="shipment-table">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Delivery ID')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Supplier Business Name')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Status')}}
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($shipmentDetails as $shipmentDetail)
                                    <tr>
                                        <td class="px-6 text-center py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 text-center py-4 whitespace-nowrap">
                                            <a href="{{route('delivery.show', encrypt($shipmentDetail->rfq_no))}}" class="hover:underline text-blue-600">{{__('portal.D')}}-{{ $shipmentDetail->delivery_id }}</a>
                                        </td>

                                        <td class="px-6 text-center py-4 whitespace-nowrap">
                                            @php $supplierBusiness = \App\Models\Business::where('id', $shipmentDetail->supplier_business_id)->first();  @endphp
                                            {{ $supplierBusiness->business_name }}
                                        </td>

                                        <td class="px-6 text-center py-4 whitespace-nowrap">
                                            @if($shipmentDetail->status == 1 )
                                                <span class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">
                                                    {{__('portal.Delivered')}}
                                                </span>
                                            @else
                                                <span class="bg-red-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">
                                                    {{__('portal.Not Delivered yet')}}
                                                </span>
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
        @endif
        <div class="mt-5">
            <a href="{{route('shipment.index')}}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                {{__('portal.Back')}}
            </a>
        </div>

    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#shipment-table').DataTable( {
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
