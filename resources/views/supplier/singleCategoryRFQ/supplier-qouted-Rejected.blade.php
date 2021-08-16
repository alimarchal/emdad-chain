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
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Items List')}} @if (!$collection->count()) {{__('portal.seems empty')}} @endif </h2>

        <div class="bg-white">
            @include('supplier.singleCategoryRFQ.navBar')
        </div>

        @if ($collection->count())
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200" id="quotation-table">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{ ucwords(str_replace("_", " ", __('portal.Shipping Time In Days'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{ ucwords(str_replace("_", " ", __('portal.Quote status'))) }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($collection as $rfp)
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->orderItem->item_name }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$rfp->orderItem->item_code)->first()->parent_id))->first()->name }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->shipping_time_in_days }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if(isset($rfp->qoute_status_updated) == 'Rejected') {{__('portal.Rejected')}} @else {{ $rfp->qoute_status_updated }} @endif
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
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#quotation-table').DataTable( {
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
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Items List')}} @if (!$collection->count()) {{__('portal.seems empty')}} @endif </h2>

        <div class="bg-white">
            @include('supplier.singleCategoryRFQ.navBar')
        </div>

        @if ($collection->count())
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200" id="quotation-table">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{ ucwords(str_replace("_", " ", __('portal.Shipping Time In Days'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{ ucwords(str_replace("_", " ", __('portal.Quote status'))) }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($collection as $rfp)
                                        <tr>
                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @php
                                                    $record = \App\Models\Category::where('id',$rfp->orderItem->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp
                                                {{ $record->name_ar }} @if(isset($parent->name)) , {{ $parent->name_ar }} @endif
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{ $rfp->shipping_time_in_days }}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @if(isset($rfp->qoute_status_updated) == 'Rejected') {{__('portal.Rejected')}} @else {{ $rfp->qoute_status_updated }} @endif
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
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#quotation-table').DataTable( {
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
