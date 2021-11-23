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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Draft Purchase Orders') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session()->has('message'))
                    <div class="mb-3 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">{{ session('message') }}</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{--                    <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                                            <a href="{{route('generatePDF')}}"
                                               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                Generate PDF
                                            </a>
                                        </div>--}}

                    @if ($dpos->count())
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200" id="dpo">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.DPO Number')}}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.Category Name')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.Requisition Type')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.Date')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.Valid upto')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.Status')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.Action')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.View')}}
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($dpos as $dpo)
                                                    <tr>
                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            {{ $loop->iteration }}
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            @if($dpo->rfq_type == 1)
                                                                <a href="{{ route('dpo.show',$dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                    {{__('portal.DPO')}}-{{ $dpo->id }}
                                                                </a>
                                                            @elseif($dpo->rfq_type == 0)
                                                                <a href="{{ route('singleCategoryDPOShow',$dpo->rfq_no) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                    {{__('portal.DPO')}}-{{ $dpo->id }}
                                                                </a>
                                                            @endif
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            @php
                                                                $record = \App\Models\Category::where('id',$dpo->item_code)->first();
                                                                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                            @endphp
                                                            {{ $record->name }} @if(isset($parent)) , {{ $parent->name }} @endif
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            @if($dpo->rfq_type == 1) {{__('portal.Multiple Categories')}} @elseif($dpo->rfq_type == 0) {{__('portal.Single Category')}}@endif
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            {{ $dpo->po_date }}
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            {{ \Carbon\Carbon::parse($dpo->quote->expiry_date)->format('Y-m-d') }}
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            @if($dpo->quote->expiry_date >= \Carbon\Carbon::now())
                                                                <span class="text-green-700">{{__('portal.Valid')}}</span>
                                                            @elseif($dpo->status == 'cancel')
                                                                <span class="text-red-700">{{__('portal.canceled')}}</span>
                                                            @elseif($dpo->quote->expiry_date < \Carbon\Carbon::now() && $dpo->quote->request_status == 1)
                                                                <span class="text-yellow-400">{{__('portal.You have asked for extension in expiry date for this DPO.')}}</span>
                                                            @else
                                                                <span class="text-red-700">{{__('portal.Expired')}}</span>
                                                            @endif
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            @if($dpo->quote->expiry_date >= \Carbon\Carbon::now())
                                                                {{__('portal.N/A')}}
                                                            @else
                                                                @if($dpo->quote->request_status == 0)
                                                                    @if($dpo->rfq_type == 1)
                                                                        @if($dpo->status == 'cancel')
                                                                            {{__('portal.N/A')}}
                                                                        @else
                                                                            <a href="{{route('DPOExpiredStatusUpdate', $dpo->qoute_no)}}" onclick="request()" title="{{__('portal.Extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-gray active:bg-yellow-400 transition ease-in-out duration-150">
                                                                                {{__('portal.Request to extend expiry date')}}
                                                                            </a>
                                                                        @endif
                                                                    @elseif($dpo->rfq_type == 0)
                                                                        @if($dpo->status == 'cancel')
                                                                            {{__('portal.N/A')}}
                                                                        @else
                                                                            <a href="{{route('DPOExpiredStatusUpdateSingleCategory', $dpo->rfq_no)}}" onclick="request()" title="{{__('portal.Extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-gray active:bg-yellow-400 transition ease-in-out duration-150">
                                                                                {{__('portal.Request to extend expiry date')}}
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    {{__('portal.N/A')}}
                                                                @endif
                                                            @endif
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                            @if($dpo->rfq_type == 1)
                                                                <a href="{{ route('dpo.show',$dpo->id) }}" class="hover:text-blue-600 hover:underline text-blue-600">
                                                                    <svg class="w-6 h-6 inline" fill="none" stroke="orange"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                        </path>
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            @elseif($dpo->rfq_type == 0)
                                                                <a href="{{ route('singleCategoryDPOShow',$dpo->rfq_no) }}" class="hover:text-blue-600 hover:underline text-blue-600">
                                                                    <svg class="w-6 h-6 inline" fill="none" stroke="orange"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                            <strong class="mr-1">{{__('portal.No draft purchase found...!')}}</strong>
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
            $('#dpo').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });

        function request() {
            if(!confirm('Are you sure to request for extension?')){
                event.preventDefault();
            }
        }
    </script>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Draft Purchase Orders') }}</h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session()->has('message'))
                    <div class="mb-3 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-3">{{ session('message') }}</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    @if ($dpos->count())
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200" id="dpo">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.DPO Number')}}
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Category Name')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.Requisition Type')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.Date')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.Valid upto')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.Status')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"  style="background-color: #FCE5CD;">
                                                        {{__('portal.Action')}}
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                                        {{__('portal.View')}}
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($dpos as $dpo)
                                                <tr>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black" style=" font-family: sans-serif;">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->rfq_type == 1)
                                                            <a href="{{ route('dpo.show',$dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                {{__('portal.DPO')}}-<span style="font-family: sans-serif;">{{ $dpo->id }}</span>
                                                            </a>
                                                        @elseif($dpo->rfq_type == 0)
                                                            <a href="{{ route('singleCategoryDPOShow',$dpo->rfq_no) }}" class="hover:text-blue-900 hover:underline text-blue-900">
                                                                {{__('portal.DPO')}}-<span style="font-family: sans-serif;">{{ $dpo->id }}</span>
                                                            </a>
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @php
                                                            $record = \App\Models\Category::where('id',$dpo->item_code)->first();
                                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                        @endphp
                                                        {{ $record->name_ar }} @if(isset($parent)) , {{ $parent->name_ar }} @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->rfq_type == 1) {{__('portal.Multiple Categories')}} @elseif($dpo->rfq_type == 0) {{__('portal.Single Category')}}@endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black" style=" font-family: sans-serif;">
                                                        {{ $dpo->po_date }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black" style=" font-family: sans-serif;">
                                                        {{ \Carbon\Carbon::parse($dpo->quote->expiry_date)->format('Y-m-d') }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->quote->expiry_date >= \Carbon\Carbon::now())
                                                            <span class="text-green-700">{{__('portal.Valid')}}</span>
                                                        @elseif($dpo->status == 'cancel')
                                                            <span class="text-red-700">{{__('portal.canceled')}}</span>
                                                        @elseif($dpo->quote->expiry_date < \Carbon\Carbon::now() && $dpo->quote->request_status == 1)
                                                            <span class="text-yellow-400">{{__('portal.You have asked for extension in expiry date for this DPO.')}}</span>
                                                        @else
                                                            <span class="text-red-700">{{__('portal.Expired')}}</span>
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->quote->expiry_date >= \Carbon\Carbon::now())
                                                            <span style="font-family: sans-serif;">{{__('portal.N/A')}}</span>
                                                        @else
                                                            @if($dpo->quote->request_status == 0)
                                                                @if($dpo->rfq_type == 1)
                                                                    @if($dpo->status == 'cancel')
                                                                        <span style="font-family: sans-serif;">{{__('portal.N/A')}}</span>
                                                                    @else
                                                                        <a href="{{route('DPOExpiredStatusUpdate', $dpo->qoute_no)}}" onclick="request()" title="{{__('portal.Extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white focus:outline-none focus:border-yellow-700 focus:shadow-outline-gray active:bg-yellow-400 transition ease-in-out duration-150">
                                                                            {{__('portal.Request to extend expiry date')}}
                                                                        </a>
                                                                    @endif
                                                                @elseif($dpo->rfq_type == 0)
                                                                    @if($dpo->status == 'cancel')
                                                                        <span style="font-family: sans-serif;">{{__('portal.N/A')}}</span>
                                                                    @else
                                                                        <a href="{{route('DPOExpiredStatusUpdateSingleCategory', $dpo->rfq_no)}}" onclick="request()" title="{{__('portal.Extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white focus:outline-none focus:border-yellow-700 focus:shadow-outline-gray active:bg-yellow-400 transition ease-in-out duration-150">
                                                                            {{__('portal.Request to extend expiry date')}}
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            @else
                                                                <span style="font-family: sans-serif;">{{__('portal.N/A')}}</span>
                                                            @endif
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-black">
                                                        @if($dpo->rfq_type == 1)
                                                            <a href="{{ route('dpo.show',$dpo->id) }}" class="hover:text-blue-600 hover:underline text-blue-600">
                                                                <svg class="w-6 h-6 inline" fill="none" stroke="orange"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                    </path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @elseif($dpo->rfq_type == 0)
                                                            <a href="{{ route('singleCategoryDPOShow',$dpo->rfq_no) }}" class="hover:text-blue-600 hover:underline text-blue-600">
                                                                <svg class="w-6 h-6 inline" fill="none" stroke="orange"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                            <strong class="mr-3">{{__('portal.No draft purchase found...!')}}</strong>
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
            $('#dpo').DataTable( {
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

        function request() {
            if(!confirm('هل أنت متأكد من طلب التمديد؟')){
                event.preventDefault();
            }
        }
    </script>
@endif
