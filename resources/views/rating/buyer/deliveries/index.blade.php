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
            <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                <a href="{{ route('buyerRatingView') }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                    {{__('portal.Back')}}
                </a>
            </div>
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
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h2 class="text-2xl font-bold text-center text-blue-600">{{__('portal.List of Delivery Ratings')}}</h2>

                            @if ($deliveries->count())
                                <div class="flex flex-col mt-2">
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
                                                                {{__('portal.Delivery ID')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.Average rating')}}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                                {{__('portal.View')}}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @foreach ($deliveries as $delivery)
                                                            <tr>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    <span class="badge badge-info">{{ $loop->iteration }}</span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    <span class="badge badge-info">
                                                                        <a href="{{route('delivery.show', encrypt($delivery->rfq_no))}}" class="text-blue-600 hover:underline">{{__('portal.D')}}-{{ $delivery->id }} </a>
                                                                    </span>
                                                                </td>
                                                                @php
                                                                    $comment_type = [1,5,7];
                                                                    $deliveryComment = \App\Models\DeliveryComment::where('delivery_id', $delivery->id)->first();
                                                                    $deliveryComments = \App\Models\DeliveryComment::where('delivery_id', $delivery->id)->whereIn('comment_type', $comment_type)->get();
                                                                    $sum = 0;
                                                                    if (count($deliveryComments) > 0 )
                                                                        {
                                                                            foreach ($deliveryComments as $deliveryComm)
                                                                            {
                                                                                $sum += $deliveryComm->rating;
                                                                            }
                                                                        }
                                                                    $count = count($deliveryComments);
                                                                @endphp
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    @if(count($deliveryComments) > 0)
                                                                        {{number_format($sum/$count,2)}}
                                                                    @else
                                                                        {{number_format(0,2)}}
                                                                    @endif
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                    @if($deliveryComment)
                                                                        <a href="{{ route('buyerDeliveryRatingViewByID', encrypt($delivery->id)) }}" class="hover:underline hover:text-blue-800 text-blue-500" rel="noreferrer">
                                                                            <svg class="w-6 h-6 inline" fill="none" stroke="red"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                            </svg>
                                                                        </a>
                                                                    @else
                                                                        {{__('portal.No ratings received')}}
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ratings List') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="mt-5" style=" margin-right: 30px; margin-bottom: 10px ">
                <a href="{{ route('buyerRatingView') }}" style="background-color: #145EA8" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white focus:outline-none focus:border-gray-600 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                    {{__('portal.Back')}}
                </a>
            </div>
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

                    <div class="py-3">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h2 class="text-2xl font-bold text-center text-blue-600">{{__('portal.List of Delivery Ratings')}}</h2>

                            @if ($deliveries->count())
                                <div class="flex flex-col mt-2">
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
                                                            {{__('portal.Delivery ID')}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                            {{__('portal.Average rating')}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-orange-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                            {{__('portal.View')}}
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach ($deliveries as $delivery)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                <span class="badge badge-info">{{ $loop->iteration }}</span>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                <span class="badge badge-info">
                                                                    <a href="{{route('delivery.show', encrypt($delivery->rfq_no))}}" class="text-blue-600 hover:underline">{{__('portal.D')}}-{{ $delivery->id }} </a>
                                                                </span>
                                                            </td>
                                                            @php
                                                                $comment_type = [1,5,7];
                                                                $deliveryComment = \App\Models\DeliveryComment::where('delivery_id', $delivery->id)->first();
                                                                $deliveryComments = \App\Models\DeliveryComment::where('delivery_id', $delivery->id)->whereIn('comment_type', $comment_type)->get();
                                                                $sum = 0;
                                                                if (count($deliveryComments) > 0 )
                                                                    {
                                                                        foreach ($deliveryComments as $deliveryComm)
                                                                        {
                                                                            $sum += $deliveryComm->rating;
                                                                        }
                                                                    }
                                                                $count = count($deliveryComments);
                                                            @endphp
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                @if(count($deliveryComments) > 0)
                                                                    {{number_format($sum/$count,2)}}
                                                                @else
                                                                    {{number_format(0,2)}}
                                                                @endif
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                                @if($deliveryComment)
                                                                    <a href="{{ route('buyerDeliveryRatingViewByID', encrypt($delivery->id)) }}" class="hover:underline hover:text-blue-800 text-blue-500" rel="noreferrer">
                                                                        <svg class="w-6 h-6 inline" fill="none" stroke="red"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                        </svg>
                                                                    </a>
                                                                @else
                                                                    {{__('portal.No ratings received')}}
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

