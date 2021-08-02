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
                {{ __('RFQs (Single Category) History') }}
            </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 mt-2 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-0 text-center m-5">Requisitions (Single Category) History</h2>

        <!-- This example requires Tailwind CSS v2.0+ -->

        <div class="flex flex-col bg-white rounded ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200" id="requisition-table">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Requisition No.
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Date
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Requested by
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Requisition Type
                                </th>


                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Status
                                </th>


                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider" width="120">
                                    View
                                </th>



                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($PlacedRFQ as $item)
                                <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap" >
                                        {{$loop->iteration}}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap" >
                                        @if ($item->business_id)
                                            <a href="{{route('single_category_rfq_view',$item->id)}}" class="hover:underline hover:text-blue-900 text-blue-900">
                                                Emdad-{{$item->id}}
                                            </a>
                                        @else
                                            <a href="{{route('single_category_rfq_view',$item->id)}}" class="hover:underline hover:text-blue-900 text-blue-900">
                                                {{ $item->business_id }}-Emdad-{{$item->id}}
                                            </a>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{$item->created_at->format('d-m-Y')}}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap" >
{{--                                        {{str_replace('["', ' ', ' ' .str_replace('"]', ' ', $item->userName->pluck('name')))}}--}}
                                        @if(isset($item->userName))
                                            {{str_replace('["', ' ', ' ' .str_replace('"]', ' ', $item->userName->pluck('name')))}}
                                        @else
                                            {{str_replace('["', ' ', ' ' .str_replace('"]', ' ', ''))}}
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center text-center whitespace-nowrap" >
                                        @if($item->rfq_type == 0)
                                            Single Category
                                        @elseif($item->rfq_type == 1)
                                            Multi Category
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap" >
                                        {{$item->status}}
                                    </td>


                                    <td class="px-6 py-4 text-center text-center whitespace-nowrap">
                                        <a href="{{route('single_category_rfq_view',$item->id)}}" >
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
    </x-app-layout>
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
        <h2 class="text-2xl font-bold py-2 text-center m-15">RFQ List</h2>

        <!-- This example requires Tailwind CSS v2.0+ -->

        <div class="flex flex-col bg-white rounded ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200" id="requisition-table">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    تاريخ
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    الحالة
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    RFQ #
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Client Name
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Who Place
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-center text-xs font-medium text-gray-500 tracking-wider" width="120">
                                    معاينة
                                </th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($PlacedRFQ as $item)
                                <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap" width="30">
                                        {{$loop->iteration}}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap" width="140">
                                        {{$item->created_at->format('d-m-Y')}}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap" width="140">
                                        {{$item->status}}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if ($item->business_id)
                                            <a href="{{route('RFQItemsByID',$item->id)}}" class="hover:underline hover:text-blue-900 text-blue-900">
                                                {{ $item->business_id }}-{{$item->id}}
                                            </a>
                                        @else
                                            <a href="{{route('RFQItemsByID',$item->id)}}" class="hover:underline hover:text-blue-900 text-blue-900">
                                                {{ $item->business_id }}-{{$item->id}}
                                            </a>
                                        @endif

                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if (\App\Models\Business::find($item->business_id))
                                            <a href="{{url('business/'.$item->business_id)}}" class="hover:underline hover:text-blue-900 text-blue-900">
                                                {{\App\Models\Business::find($item->business_id)->first()->business_name}}
                                            </a>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if (\App\Models\User::find($item->user_id))
                                            {{\App\Models\User::find($item->user_id)->first()->name}}
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <a href="{{route('RFQItemsByID',$item->id)}}" >
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
    </x-app-layout>
@endif

<script>
    $(document).ready(function() {
        $('#requisition-table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    });

</script>
