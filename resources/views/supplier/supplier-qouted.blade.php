@section('headerScripts')
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <style>
        #datepicker {
            width: 100%;
            padding: 10px;
            cursor: default;
            /*text-transform: uppercase;*/
            font-size: 13px;
            background: #FFFFFF;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            border: solid 1px #d2d6dc;
            box-shadow: none;
        }
    </style>
@endsection

@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>
        @if (session()->has('message'))
            <div class="block mt-4 text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @foreach ($errors->get('expiry_date') as $error)
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative mt-4" role="alert">
                <strong class="mr-1">{{ $error }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach
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
                        $quoted = \App\Models\Qoute::where(['supplier_business_id' => auth()->user()->business_id , 'rfq_type' => 1])
                                        ->where('qoute_status' , '!=' ,'ModificationNeeded')
                                        ->where('qoute_status' , '!=' ,'RFQPendingConfirmation')
                                        ->count();
                    @endphp
                    {{__('portal.Quoted')}} <span class="text-red-400">({{$quoted}})</span>
                </a>
                {{--<a href="{{ route('QuotedModifiedRFQ') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QuotedModifiedRFQ') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                    @php $quotedCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1, 'qoute_status' => 'Modified'])->count(); @endphp
                    {{__('portal.Modified')}} <span class="text-red-400">({{$quotedCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQRejected') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $rejectedCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status_updated', 'Rejected')->count(); @endphp
                    {{__('portal.Rejected')}} <span class="text-red-400">({{$rejectedCount}})</span>
                </a>--}}
                <a href="{{ route('QoutedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $modificationCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status_updated', 'ModificationNeeded')->count(); @endphp
                    {{__('portal.Modification needed')}} <span class="text-red-400">({{$modificationCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $pendingCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status', 'RFQPendingConfirmation')->count(); @endphp
                    {{__('portal.Pending Confirmation')}} <span class="text-red-400">({{$pendingCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQQoutedExpired') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
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
                                            {{__('portal.Quotation')}}&nbsp;#
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
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Valid upto'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Generate PDF'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Action'))) }}
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
                                                <a href="{{route('QoutedRFQQoutedViewByID', encrypt($rfp->id))}}" class="text-blue-500 hover:underline">{{__('portal.Q')}}-{{ $rfp->id }}</a>
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
                                                {{--@if($rfp->qoute_status == 'Qouted' && $rfp->request_status == 1 || $rfp->qoute_status == 'accepted' && $rfp->request_status == 1) {{__('portal.Buyer Requested to extend expiry date.')}}
                                                @elseif($rfp->qoute_status == 'Qouted') {{__('portal.Quoted')}}
                                                    --}}{{-- Have to show Supplier status quotes only if dpo is created and has status pending --}}{{--
                                                @else {{__('portal.Quoted')}}
                                                @endif--}}
                                                @if($rfp->dpo != null)
                                                    @php $po = \App\Models\DraftPurchaseOrder::firstWhere('id', $rfp->dpo); @endphp

                                                    @if(isset($po) && $po->status == 'approved') {{__('portal.P.O. APPROVED')}}
                                                    @elseif(isset($po) && $po->status == 'cancel') {{__('portal.Canceled')}}
                                                    @elseif(isset($po) && $po->status == 'completed') {{__('portal.Completed')}}
                                                    @else {{__('portal.Quoted')}}
                                                    @endif
                                                @elseif($rfp->qoute_status == 'Qouted' && $rfp->request_status == 1 && $rfp->qoute_status_updated != 'Rejected' || $rfp->qoute_status == 'accepted' && $rfp->request_status == 1 && $rfp->qoute_status_updated != 'Rejected') {{__('portal.Buyer Requested to extend expiry date.')}}
                                                @elseif($rfp->qoute_status == 'Modified') {{__('portal.Modified')}}
                                                @elseif($rfp->qoute_status_updated == 'Rejected') {{__('portal.Rejected')}}
                                                @elseif($rfp->qoute_status == 'RFQPendingConfirmation') {{__('portal.Pending Confirmation')}}
                                                @elseif($rfp->qoute_status == 'Qouted') {{__('portal.Quoted')}}
                                                    {{-- Have to show Supplier status quotes only if dpo is created and has status pending --}}
                                                @else {{__('portal.Quoted')}}
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @if($rfp->dpo != null)
                                                    @if(isset($po) && $po->status == 'pending' && $rfp->expiry_date < \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d H:i:s')) <span class="text-red-600"> {{ __('portal.Expired') }} </span>
                                                    @else <span class="text-center">--</span>
                                                    @endif
                                                @elseif($rfp->status == 'completed' || $rfp->status == 'expired') <span class="text-center">--</span>
                                                @elseif($rfp->expiry_date >= \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d H:i:s')) {{ \Carbon\Carbon::parse($rfp->expiry_date)->format('Y-m-d') }}
                                                @else <span class="text-red-600"> {{ __('portal.Expired') }} </span>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                <a href="{{route('PDFForQuotation', encrypt($rfp->orderItem->id))}}">
                                                    {{--<svg class="svg-icon" style="height: 50px;" viewBox="0 0 20 20">
                                                        <path d="M17.222,5.041l-4.443-4.414c-0.152-0.151-0.356-0.235-0.571-0.235h-8.86c-0.444,0-0.807,0.361-0.807,0.808v17.602c0,0.448,0.363,0.808,0.807,0.808h13.303c0.448,0,0.808-0.36,0.808-0.808V5.615C17.459,5.399,17.373,5.192,17.222,5.041zM15.843,17.993H4.157V2.007h7.72l3.966,3.942V17.993z"></path>
                                                        <path d="M5.112,7.3c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808c0-0.447-0.363-0.808-0.808-0.808H5.92C5.475,6.492,5.112,6.853,5.112,7.3z"></path>
                                                        <path d="M5.92,5.331h4.342c0.445,0,0.808-0.361,0.808-0.808c0-0.446-0.363-0.808-0.808-0.808H5.92c-0.444,0-0.808,0.361-0.808,0.808C5.112,4.97,5.475,5.331,5.92,5.331z"></path>
                                                        <path d="M13.997,9.218H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,9.58,14.442,9.218,13.997,9.218z"></path>
                                                        <path d="M13.997,11.944H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,12.306,14.442,11.944,13.997,11.944z"></path>
                                                        <path d="M13.997,14.67H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.447,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,15.032,14.442,14.67,13.997,14.67z"></path>
                                                    </svg>--}}
                                                    <img src="{{url('pdf.png')}}" style="height: 40px; padding-left: 26%;">
                                                </a>
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @if($rfp->qoute_status == 'Qouted' && $rfp->request_status == 1 && $rfp->qoute_status_updated != 'Rejected' || $rfp->qoute_status == 'accepted' && $rfp->request_status == 1 && $rfp->qoute_status_updated != 'Rejected')
                                                    <a href="javascript:void(0)" title="{{__('portal.Extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150" onclick="toggleModal({{$rfp->id}})">
                                                        {{__('portal.Accept')}}
                                                    </a>
                                                    <a href="{{route('quotationExpiredStatusRejectResponse', encrypt($rfp->id))}}" onclick="request()" title="{{__('portal.Reject request to extend quotation expiry date')}}" class="inline-flex mt-2 items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                        {{__('portal.Reject')}}
                                                    </a>
                                                @else <span class="text-center">--</span>
                                                @endif
                                            </td>

                                            <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="modal">
                                                <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                    <div class="fixed inset-0 transition-opacity">
                                                        <div class="absolute inset-0 bg-gray-900 opacity-75" />
                                                    </div>
                                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                                                    <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                                        <form action="{{route('QuotationExpiredStatusResponse')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="quoteID" id="quoteID">
                                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                <label>{{__('portal.Last expiry date')}}:</label>
                                                                <input type="text" value="{{\Carbon\Carbon::parse($rfp->expiry_date)->format('m-d-Y')}}" disabled class="w-full bg-gray-100 p-2 mt-2 mb-3" />
                                                                <label>{{__('portal.Select New expiry date')}}:</label>
                                                                <input type="text" id="datepicker" class="block mt-1 w-full focus:outline-none focus:border-gray-700 focus:shadow-outline-gray" name="expiry_date" value="{{old('expiry_date')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
                                                                @foreach ($errors->get('expiry_date') as $error)
                                                                    <span class="text-red-700">{{ $error }}</span>
                                                                @endforeach
                                                            </div>
                                                            <div class="bg-gray-200 px-4 py-3 text-right">
                                                                <button type="button" class="py-2 px-4 bg-gray-500 text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray rounded hover:bg-gray-700 mr-2" onclick="toggleModal()">{{__('portal.Cancel')}}</button>
                                                                <button type="submit" class="py-2 px-4 text-white focus:outline-none focus:border-blue-700 focus:shadow-outline-blue rounded hover:bg-blue-700 mr-2" style="background-color: #145EA8">{{__('portal.Save')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

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

        function request() {
            if(!confirm('Are you sure to reject the request?')){
                event.preventDefault();
            }
        }
    </script>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>
        @if (session()->has('message'))
            <div class="block mt-4 text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @foreach ($errors->get('expiry_date') as $error)
            <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative mt-4" role="alert">
                <strong class="mr-3">{{ $error }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach
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
                        $quoted = \App\Models\Qoute::where(['supplier_business_id' => auth()->user()->business_id , 'rfq_type' => 1])
                                        ->where('qoute_status' , '!=' ,'ModificationNeeded')
                                        ->where('qoute_status' , '!=' ,'RFQPendingConfirmation')
                                        ->count();
                    @endphp
                    {{__('portal.Quoted')}} <span class="text-red-400" style="font-family: sans-serif">({{$quoted}})</span>
                </a>
                <a href="{{ route('QoutedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('QoutedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $modificationCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status_updated', 'ModificationNeeded')->count(); @endphp
                    {{__('portal.Modification needed')}} <span class="text-red-400" style="font-family: sans-serif">({{$modificationCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('QoutedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $pendingCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status', 'RFQPendingConfirmation')->count(); @endphp
                    {{__('portal.Pending Confirmation')}} <span class="text-red-400" style="font-family: sans-serif">({{$pendingCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQQoutedExpired') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('QoutedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
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
                                            {{__('portal.Quotation')}}#
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
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Valid upto'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Generate PDF'))) }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{ ucwords(str_replace("_", " ", __('portal.Action'))) }}
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
                                                <a href="{{route('QoutedRFQQoutedViewByID', encrypt($rfp->id))}}" class="text-blue-500 hover:underline">{{__('portal.Q')}}-<span style="font-family: sans-serif">{{ $rfp->id }}</span></a>
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{ \App\Models\Category::where('id', $rfp->orderItem->item_code)->first()->name_ar }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$rfp->orderItem->item_code)->first()->parent_id))->first()->name_ar }}
{{--                                                {{ $rfp->orderItem->item_name }}--}}
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
                                                {{--@if($rfp->qoute_status == 'Qouted' && $rfp->request_status == 1 || $rfp->qoute_status == 'accepted' && $rfp->request_status == 1) {{__('portal.Buyer Requested to extend expiry date.')}}
                                                @elseif($rfp->qoute_status == 'Qouted') {{__('portal.Quoted')}}
                                                    --}}{{-- Have to show Supplier status quotes only if dpo is created and has status pending --}}{{--
                                                @else {{__('portal.Quoted')}}
                                                @endif--}}
                                                @if($rfp->dpo != null)
                                                    @php $po = \App\Models\DraftPurchaseOrder::firstWhere('id', $rfp->dpo); @endphp

                                                    @if(isset($po) && $po->status == 'approved') {{__('portal.P.O. APPROVED')}}
                                                    @elseif(isset($po) && $po->status == 'cancel') {{__('portal.Canceled')}}
                                                    @elseif(isset($po) && $po->status == 'completed') {{__('portal.Completed')}}
                                                    @else {{__('portal.Quoted')}}
                                                    @endif
                                                @elseif($rfp->qoute_status == 'Qouted' && $rfp->request_status == 1 || $rfp->qoute_status == 'accepted' && $rfp->request_status == 1) {{__('portal.Buyer Requested to extend expiry date.')}}
                                                @elseif($rfp->qoute_status == 'Modified') {{__('portal.Modified')}}
                                                @elseif($rfp->qoute_status_updated == 'Rejected') {{__('portal.Rejected')}}
                                                @elseif($rfp->qoute_status == 'RFQPendingConfirmation') {{__('portal.Pending Confirmation')}}
                                                @elseif($rfp->qoute_status == 'Qouted') {{__('portal.Quoted')}}
                                                {{-- Have to show Supplier status quotes only if dpo is created and has status pending --}}
                                                @else {{__('portal.Quoted')}}
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @if($rfp->dpo != null)
                                                    @if(isset($po) && $po->status == 'pending' && $rfp->expiry_date < \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d H:i:s')) <span class="text-red-600"> {{ __('portal.Expired') }} </span>
                                                    @else <span class="text-center">--</span>
                                                    @endif
                                                @elseif($rfp->status == 'completed' || $rfp->status == 'expired') <span class="text-center">--</span>
                                                @elseif($rfp->expiry_date >= \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d H:i:s')) <span style="font-family: sans-serif">{{ \Carbon\Carbon::parse($rfp->expiry_date)->format('Y-m-d') }}</span>
                                                @else <span class="text-red-600"> {{ __('portal.Expired') }} </span>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                <a href="{{route('PDFForQuotation', encrypt($rfp->orderItem->id))}}">
                                                    <img src="{{url('pdf.png')}}" style="height: 40px; padding-right: 35%;">
                                                </a>
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @if($rfp->qoute_status == 'Qouted' && $rfp->request_status == 1 || $rfp->qoute_status == 'accepted' && $rfp->request_status == 1)
                                                    <a href="javascript:void(0)" title="{{__('portal.Extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:text-white hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150" onclick="toggleModal({{$rfp->id}})">
                                                        {{__('portal.Accept')}}
                                                    </a>
                                                    <a href="{{route('quotationExpiredStatusRejectResponse', encrypt($rfp->id))}}" onclick="request()" title="{{__('portal.Reject request to extend quotation expiry date')}}" class="inline-flex mt-2 items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                        {{__('portal.Reject')}}
                                                    </a>
                                                @else <span class="text-center">--</span>
                                                @endif
                                            </td>

                                            <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="modal">
                                                <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                    <div class="fixed inset-0 transition-opacity">
                                                        <div class="absolute inset-0 bg-gray-900 opacity-75" />
                                                    </div>
                                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                                                    <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                                        <form action="{{route('QuotationExpiredStatusResponse')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="quoteID" id="quoteID">
                                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                <label class="float-right">{{__('portal.Last expiry date')}}:</label>
                                                                <input type="text" value="{{\Carbon\Carbon::parse($rfp->expiry_date)->format('m-d-Y')}}" disabled class="w-full bg-gray-100 p-2 mt-2 mb-3" />
                                                                <label class="float-right">{{__('portal.Select New expiry date')}}:</label>
                                                                <input type="text" id="datepicker" class="block mt-1 w-full focus:outline-none focus:border-gray-700 focus:shadow-outline-gray" name="expiry_date" value="{{old('expiry_date')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
                                                                @foreach ($errors->get('expiry_date') as $error)
                                                                    <span class="text-red-700">{{ $error }}</span>
                                                                @endforeach
                                                            </div>
                                                            <div class="bg-gray-200 px-4 py-3 text-right">
                                                                <button type="button" class="py-2 px-4 bg-gray-500 text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray rounded hover:bg-gray-700 mr-2" onclick="toggleModal()">{{__('portal.Cancel')}}</button>
                                                                <button type="submit" class="py-2 px-4 text-white focus:outline-none focus:border-blue-700 focus:shadow-outline-blue rounded hover:bg-blue-700 mr-2" style="background-color: #145EA8">{{__('portal.Save')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

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

        function request() {
            if(!confirm('Are you sure to reject the request?')){
                event.preventDefault();
            }
        }
    </script>
@endif

<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            minDate: +5,
            maxDate: +94,
            clear: true,
            required: true,
        }).attr('readonly', 'readonly');
    } );

    function toggleModal(id) {
        document.getElementById('modal').classList.toggle('hidden')
        $("#quoteID").val(id);
    }
</script>
