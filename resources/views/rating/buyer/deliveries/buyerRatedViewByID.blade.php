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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Ratings List') }} </h2>
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

                    <div class="py-3">
                        <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h2 class="text-2xl font-bold text-center text-blue-600">{{__('portal.Rating details')}}</h2> <br>
                            @if ($deliveryComments->count())
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                #
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Rated To')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Delivery Note')}} #
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Name')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Business Name')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Comment')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Rated')}}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @foreach ($deliveryComments as $deliveryComment)
                                                            <tr>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    <span class="badge badge-info">{{ $loop->iteration }}</span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    <span>
                                                                        @if($deliveryComment->comment_type == 2 ) {{__('portal.To Driver')}}
                                                                        @elseif($deliveryComment->comment_type == 3 ) {{__('portal.To Supplier')}}
                                                                        @elseif($deliveryComment->comment_type == 4 ) {{__('portal.To Emdad')}}
                                                                        @endif
                                                                    </span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    @php $delivery = \App\Models\Delivery::where('id',$deliveryComment->delivery_id)->first(); @endphp
                                                                    <a href="{{route('deliveryDetails', [ 'rfq_no' => encrypt($delivery->rfq_no), 'deliveryID' => encrypt($delivery->id), 'rfq_type' => $delivery->rfq_type])}}" class="text-blue-600 hover:underline" target="_blank" rel="noreferrer">{{__('portal.D.N.')}}-{{ $delivery->delivery_note_id }} </a>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    @php
                                                                        $deliveryDetail = \App\Models\Delivery::where('id', $delivery->id)->first();
                                                                        $user = \App\Models\User::with('business')->where('id', $deliveryDetail->supplier_user_id)->first();
                                                                        $shipmentItem = \App\Models\ShipmentItem::where('delivery_id', $delivery->id)->first();
                                                                        $driver = \App\Models\User::with('business')->where('id', $shipmentItem->driver_id)->first();
                                                                    @endphp
                                                                    <span class="badge badge-info">@if($loop->iteration == 1) {{ $user->name }} @elseif($loop->iteration == 2) {{$driver->name}} @else {{__('portal.Emdad')}} @endif</span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    <span class="badge badge-info">@if($loop->iteration == 1) {{ $user->business->business_name }} @elseif($loop->iteration == 2) {{$driver->business->business_name}} @else {{__('portal.Emdad Supply Chain')}} @endif</span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    <span class="badge badge-info">@if(isset($deliveryComment->comment_content)) {{ $deliveryComment->comment_content }} @else {{__('portal.N/A')}} @endif</span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    <span class="badge badge-info">{{ number_format($deliveryComment->rating,2) }}</span>
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
                                    <strong class="mr-1">{{__('portal.No Ratings yet..!')}}</strong>
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

    <script>
        $(document).ready(function () {
            $('#roles-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

    </script>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Ratings List') }} </h2>
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

                    <div class="py-3">
                        <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h2 class="text-2xl font-bold text-center text-blue-600">{{__('portal.Rating details')}}</h2> <br>
                            @if ($deliveryComments->count())
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                #
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Rated To')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Delivery Note')}} #
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Name')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Business Name')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Comment')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Rated')}}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @foreach ($deliveryComments as $deliveryComment)
                                                            <tr>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500" style="font-family: sans-serif">
                                                                    <span class="badge badge-info">{{ $loop->iteration }}</span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                        <span>
                                                                            @if($deliveryComment->comment_type == 2 ) {{__('portal.To Driver')}}
                                                                            @elseif($deliveryComment->comment_type == 3 ) {{__('portal.To Supplier')}}
                                                                            @elseif($deliveryComment->comment_type == 4 ) {{__('portal.To Emdad')}}
                                                                            @endif
                                                                        </span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    @php $delivery = \App\Models\Delivery::where('id',$deliveryComment->delivery_id)->first(); @endphp
                                                                    <a href="{{route('deliveryDetails', [ 'rfq_no' => encrypt($delivery->rfq_no), 'deliveryID' => encrypt($delivery->id), 'rfq_type' => $delivery->rfq_type])}}" class="text-blue-600 hover:underline" target="_blank" rel="noreferrer">{{__('portal.D.N.')}}-<span style="font-family: sans-serif">{{ $delivery->delivery_note_id }}</span> </a>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    @php
                                                                        $deliveryDetail = \App\Models\Delivery::where('id', $delivery->id)->first();
                                                                        $user = \App\Models\User::with('business')->where('id', $deliveryDetail->supplier_user_id)->first();
                                                                        $shipmentItem = \App\Models\ShipmentItem::where('delivery_id', $delivery->id)->first();
                                                                        $driver = \App\Models\User::with('business')->where('id', $shipmentItem->driver_id)->first();
                                                                    @endphp
                                                                    <span class="badge badge-info">@if($loop->iteration == 1) <span style="font-family: sans-serif">{{ $user->name }}</span> @elseif($loop->iteration == 2) <span style="font-family: sans-serif">{{$driver->name}}</span> @else {{__('portal.Emdad')}} @endif</span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    <span class="badge badge-info">@if($loop->iteration == 1) <span style="font-family: sans-serif">{{ $user->business->business_name }}</span> @elseif($loop->iteration == 2) <span style="font-family: sans-serif">{{$driver->business->business_name}}</span> @else {{__('portal.Emdad Supply Chain')}} @endif</span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500" style="font-family: sans-serif">
                                                                    <span class="badge badge-info"> @if(isset($deliveryComment->comment_content)) {{ $deliveryComment->comment_content }} @else {{__('portal.N/A')}} @endif </span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500" style="font-family: sans-serif">
                                                                    <span class="badge badge-info">{{ number_format($deliveryComment->rating,2) }}</span>
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
                                    <strong class="mr-3">{{__('portal.No Ratings yet..!')}}</strong>
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

    <script>
        $(document).ready(function() {
            $('#roles-table').DataTable( {
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
