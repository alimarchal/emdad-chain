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
            {{ __('Ratings List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
            <a href="{{ route('ratingView') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-500 focus:outline-none focus:border-orange-700 focus:shadow-outline-orange active:bg-orange-600 transition ease-in-out duration-150">
                Back
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

                <div class="py-3">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <h2 class="text-2xl font-bold text-center text-blue-600">Buyer Ratings List</h2>
                        @if (count($buyerDeliveryComments) > 0)
                            <div class="flex flex-col">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                            <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-orange-500 uppercase tracking-wider">
                                                        #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-orange-500 uppercase tracking-wider">
                                                        Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-orange-500 uppercase tracking-wider">
                                                        Business Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-orange-500 uppercase tracking-wider">
                                                        Delivery ID
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-orange-500 uppercase tracking-wider">
                                                        Emdad rating
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-orange-500 uppercase tracking-wider">
                                                        Average rating
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                @php $i = 0; $j= 0; @endphp
                                                @foreach ($buyerDeliveryComments as $buyerDeliveryComment)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                            <span class="badge badge-info">{{ $loop->iteration }}</span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                            @php $user = \App\Models\User::where('id', $buyerDeliveryComments[$i]['userID'])->first(); $i = $loop->iteration; @endphp
                                                            <span class="badge badge-info">{{$user->name}}</span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                            <span class="badge badge-info">{{$user->business->business_name}}</span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                            <span class="badge badge-info">
                                                                @php $rfqNo = \App\Models\Delivery::where('id', $buyerDeliveryComment[0]['delivery_id'])->pluck('rfq_no')->first(); @endphp
                                                                <a href="{{route('delivery.show', encrypt($rfqNo))}}" class="text-blue-600 hover:underline" target="_blank"> {{$buyerDeliveryComment[0]['delivery_id']}} </a>
                                                            </span>
                                                        </td>
                                                        @php

                                                            /* Retrieving Emdad Rating for Buyer */
                                                            $deliveryCommentsForEmdadRating = \App\Models\DeliveryComment::where('delivery_id', $buyerDeliveryComments[$j][$j]->delivery_id)->where('comment_type', 7)->first();

                                                            /* Calculating Buyer Average Rating */
                                                            $sum = 0;
                                                            $commentTypeForAverage = [1,5];
                                                            $deliveryComments = \App\Models\DeliveryComment::where('delivery_id', $buyerDeliveryComments[$j][$j]->delivery_id)->whereIn('comment_type', $commentTypeForAverage)->get();
                                                            $j = $loop->iteration;
                                                            foreach ($deliveryComments as $deliveryComm)
                                                                {
                                                                    $sum += $deliveryComm->rating;
                                                                }
                                                            $count = count($deliveryComments);

                                                        @endphp
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                           @if(isset($deliveryCommentsForEmdadRating) ) {{number_format($deliveryCommentsForEmdadRating->rating,2,'.')}} @endif
                                                        </td>

                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                            @if(count($deliveryComments) > 0 ) {{number_format($sum/$count,2,'.')}} @endif
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
                                <strong class="mr-1">No Ratings yet..!</strong>
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