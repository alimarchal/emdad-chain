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
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Quotations List')}} @if (!$collection->count()) {{__('portal.seems empty')}} @endif </h2>

        <div class="bg-white">
            <nav class="flex flex-col sm:flex-row">
                <a href="{{ route('viewRFQs') }}" class="py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none {{ request()->routeIs('viewRFQs') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php
                        $business_cate = \App\Models\BusinessCategory::where('business_id', auth()->user()->business_id)->get();
                        if ($business_cate->isNotEmpty()) {
                            foreach ($business_cate as $item) {
                                $business_categories[] = (int)$item->category_number;
                            }
                        }
                        sort($business_categories);
                            // Counting NEW RFQs for multiple categories for supplier
                            $now = \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d H:i:s');
                            $multiEOrderItems = \App\Models\EOrderItems::where(['status' => 'pending', 'rfq_type' => 1])->where('bypass', 0)->whereDate('quotation_time', '>=', $now)->whereIn('item_code', $business_categories)->get();
                            $noMultiCategoryQuotationPresent = array();
                            foreach ($multiEOrderItems as $multiEOrderItem)
                                {
                                    $quotes = \App\Models\Qoute::where(['e_order_items_id' => $multiEOrderItem->id, 'supplier_business_id' => auth()->user()->business_id])->first();
                                        if (!($quotes))
                                            {
                                                $noMultiCategoryQuotationPresent[] = $multiEOrderItem->id;
                                            }
                                }
                    @endphp
                    {{__('portal.New RFQs')}} <span class="text-red-400">({{count($noMultiCategoryQuotationPresent)}})</span>
                </a>
                <a href="{{ route('QoutedRFQQouted') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQQouted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                    @php
                        $quotedCount = \App\Models\Qoute::where(['supplier_business_id' => auth()->user()->business_id , 'rfq_type' => 1])
                                        ->where('qoute_status' , '!=' ,'ModificationNeeded')
                                        ->where('qoute_status' , '!=' ,'RFQPendingConfirmation')
                                        ->count();
                    @endphp
                    {{__('portal.Quoted')}} <span class="text-red-400">({{$quotedCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $modificationCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status_updated', 'ModificationNeeded')->count(); @endphp
                    {{__('portal.Modification needed')}} <span class="text-red-400">({{$modificationCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $pendingCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status', 'RFQPendingConfirmation')->count(); @endphp
                    {{__('portal.Pending Confirmation')}} <span class="text-red-400">({{$pendingCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQQoutedExpired') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQQoutedExpired') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php
                        $data= \App\Models\Qoute::where(['supplier_business_id' => auth()->user()->business_id , 'rfq_type' => 1, 'request_status' => 1])
                            ->where(function ($query){
                                $query->where(['qoute_status' => 'Qouted'])->orWhere(['qoute_status' => 'accepted']);
                            })->get();
                        $expired = array();
                        foreach($data as $da)
                            {
                                if($da->qoute_status_updated != 'Rejected')
                                {
                                    $expired[] = $da;
                                }
                            }
                    @endphp
                    {{__('portal.Expired')}} <span class="text-red-400">({{count($expired)}})</span>
                </a>
            </nav>
        </div>
        @if ($collection->count())
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200" id="quotation-table">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Quantity'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Price Per Quantity'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Shipping Time'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
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
                                                {{ $rfp->quote_quantity }}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{ $rfp->quote_price_per_quantity }} {{__('portal.SAR')}}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{ $rfp->shipping_time_in_days }}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @if($rfp->qoute_status == 'pending') {{__('portal.pending')}} @else {{ $rfp->qoute_status }} @endif
{{--                                                {{ $rfp->qoute_status }}--}}
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
            <a href="{{ route('dashboard') }}" style="background-color: #145EA8"
               class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                {{__('portal.Back')}}
            </a>
        </div>
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
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Quotations List')}} @if (!$collection->count()) {{__('portal.seems empty')}} @endif </h2>

        <div class="bg-white">
            <nav class="flex flex-col sm:flex-row">
                <a href="{{ route('viewRFQs') }}" class="py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none {{ request()->routeIs('viewRFQs') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php
                        $business_cate = \App\Models\BusinessCategory::where('business_id', auth()->user()->business_id)->get();
                        if ($business_cate->isNotEmpty()) {
                            foreach ($business_cate as $item) {
                                $business_categories[] = (int)$item->category_number;
                            }
                        }
                        sort($business_categories);
                            // Counting NEW RFQs for multiple categories for supplier
                            $now = \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d H:i:s');
                            $multiEOrderItems = \App\Models\EOrderItems::where(['status' => 'pending', 'rfq_type' => 1])->where('bypass', 0)->whereDate('quotation_time', '>=', $now)->whereIn('item_code', $business_categories)->get();
                            $noMultiCategoryQuotationPresent = array();
                            foreach ($multiEOrderItems as $multiEOrderItem)
                                {
                                    $quotes = \App\Models\Qoute::where(['e_order_items_id' => $multiEOrderItem->id, 'supplier_business_id' => auth()->user()->business_id])->first();
                                        if (!($quotes))
                                            {
                                                $noMultiCategoryQuotationPresent[] = $multiEOrderItem->id;
                                            }
                                }
                    @endphp
                    {{__('portal.New RFQs')}} <span class="text-red-400" style="font-family: sans-serif">({{count($noMultiCategoryQuotationPresent)}})</span>
                </a>
                <a href="{{ route('QoutedRFQQouted') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('QoutedRFQQouted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                    @php
                        $quotedCount = \App\Models\Qoute::where(['supplier_business_id' => auth()->user()->business_id , 'rfq_type' => 1])
                                        ->where('qoute_status' , '!=' ,'ModificationNeeded')
                                        ->where('qoute_status' , '!=' ,'RFQPendingConfirmation')
                                        ->count();
                    @endphp
                    {{__('portal.Quoted')}} <span class="text-red-400" style="font-family: sans-serif">({{$quotedCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('QoutedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $modificationCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status_updated', 'ModificationNeeded')->count(); @endphp
                    {{__('portal.Modification needed')}} <span class="text-red-400" style="font-family: sans-serif">({{$modificationCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('QoutedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $pendingCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status', 'RFQPendingConfirmation')->count(); @endphp
                    {{__('portal.Pending Confirmation')}} <span class="text-red-400" style="font-family: sans-serif">({{$pendingCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQQoutedExpired') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('QoutedRFQQoutedExpired') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php
                        $data= \App\Models\Qoute::where(['supplier_business_id' => auth()->user()->business_id , 'rfq_type' => 1, 'request_status' => 1])
                            ->where(function ($query){
                                $query->where(['qoute_status' => 'Qouted'])->orWhere(['qoute_status' => 'accepted']);
                            })->get();
                        $expired = array();
                        foreach($data as $da)
                            {
                                if($da->qoute_status_updated != 'Rejected')
                                {
                                    $expired[] = $da;
                                }
                            }
                    @endphp
                    {{__('portal.Expired')}} <span class="text-red-400" style="font-family: sans-serif">({{count($expired)}})</span>
                </a>
            </nav>
        </div>
        @if ($collection->count())
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200" id="quotation-table">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Category Name')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Quantity'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Price Per Quantity'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Shipping Time'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Quote status'))) }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($collection as $rfp)
                                        <tr>
                                            <td class="px-6 py-4 text-center whitespace-nowrap" style="font-family: sans-serif">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{ \App\Models\Category::where('id', $rfp->orderItem->item_code)->first()->name_ar }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$rfp->orderItem->item_code)->first()->parent_id))->first()->name_ar }}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap" style="font-family: sans-serif">
                                                {{ $rfp->quote_quantity }}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                <span style="font-family: sans-serif">{{ $rfp->quote_price_per_quantity }}</span> {{__('portal.SAR')}}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap" style="font-family: sans-serif">
                                                {{ $rfp->shipping_time_in_days }}
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @if($rfp->qoute_status == 'pending') {{__('portal.pending')}} @else {{ $rfp->qoute_status }} @endif
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
            <a href="{{ route('dashboard') }}" style="background-color: #145EA8"
               class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                {{__('portal.Back')}}
            </a>
        </div>
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
