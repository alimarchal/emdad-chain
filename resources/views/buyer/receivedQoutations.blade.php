@section('headerScripts')
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous"></script>

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
            <div class="mt-4 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Quotations List')}}</h2>

        @if ($PlacedRFQ->count())
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider"  style="background-color: #FCE5CD;">
                                            {{__('portal.Requisition')}} #
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider"  style="background-color: #FCE5CD;">
                                            {{__('portal.Category Name')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider"  style="background-color: #FCE5CD;">
                                            {{__('portal.Requisition Type')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider"  style="background-color: #FCE5CD;">
                                            {{__('portal.Date')}}
                                        </th>

                                        {{--<th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider"  style="background-color: #FCE5CD;">
                                            {{__('portal.Unit')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider"  style="background-color: #FCE5CD;">
                                            {{__('portal.Size')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider"  style="background-color: #FCE5CD;">
                                            {{__('portal.Quantity')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider"  style="background-color: #FCE5CD;">
                                            {{__('portal.Last Price')}}
                                        </th>--}}

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider"  style="background-color: #FCE5CD;">
                                            {{__('portal.Time left')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider"  style="background-color: #FCE5CD;">
                                            {{__('portal.Quotations/Status')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider"  style="background-color: #FCE5CD;">
                                            {{__('portal.Action')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($PlacedRFQ as $placedRFQ)
                                    @if($placedRFQ->rfq_type == 1)
                                        @foreach ($placedRFQ->OrderItems->sortBy('created_at') as $rfp)
                                            <tr>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{__('portal.RFQ')}}-{{ $rfp->id }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @php
                                                        $record = \App\Models\Category::where('id',$rfp->item_code)->first();
                                                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                    @endphp
                                                    {{ $record->name }} @if(isset($parent)), {{$parent->name}} @endif
                                                </td>
                                                <td class="px-7 py-4 text-center whitespace-nowrap">
                                                    {{__('portal.Multiple Categories')}}
                                                </td>
                                                <td class="px-7 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->created_at->format('d-m-Y') }}
                                                </td>

                                                {{--<td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->unit_of_measurement }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->size }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->quantity }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ number_format($rfp->last_price, 2) }} <br>
                                                </td>--}}

                                                @php
                                                    $created = $rfp->quotation_time;
                                                    $time = \Carbon\Carbon::parse($created)->format('Y-m-d');
                                                    $now = \Carbon\Carbon::now();
                                                    $diffInHrs = $now->diffInHours($created);
                                                    $diffInMins = $now->diffInMinutes($created);
                                                    // checking previous dpo if any
                                                    $dpo = \App\Models\DraftPurchaseOrder::where('rfq_item_no', $rfp->id)->where('po_status' , 'pending')->where('status' , 'pending')->first();
                                                @endphp
                                                <td
                                                  @if($rfp->status == 'accepted')  class="px-6 py-4 text-center whitespace-nowrap"
                                                  @elseif($rfp->bypass == 1)
                                                  @else
                                                      class="px-6 py-4 text-center whitespace-nowrap"  data-countdown="{{$time}}"
                                                  @endif
                                                >
                                                    @if($rfp->status == 'accepted')
                                                        {{__('portal.N/A')}}
                                                    @else
        {{--                                                {{ $diffInHrs }} hours @if($diffInHrs == 0) and {{ $diffInMins }} minutes @endif --}}
        {{--                                                <br>--}}
                                                        <div class="text-center"><span class="text-center">--</span></div>
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if(isset($dpo))
                                                        <span class="text-blue-600">{{__('portal.DPO generated')}}</span>
                                                    @elseif($rfp->bypass == 1 && $rfp->quotation_time > \Carbon\Carbon::now() && $rfp->status == 'pending')
                                                        @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                                            <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $placedRFQ->id, 'EOrderItemID' => $rfp->id, 'bypass_id' => 0]) }}"
                                                               class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                               {{__('portal.See Quotes')}}
                                                            </a>
                                                        @endif
                                                    @elseif($rfp->bypass == 1 && $rfp->quotation_time < \Carbon\Carbon::now() && $rfp->status == 'pending')
                                                        @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                                            <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $placedRFQ->id, 'EOrderItemID' => $rfp->id, 'bypass_id' => 0]) }}"
                                                               class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                                {{__('portal.See Quotes')}}
                                                            </a>
                                                        @endif
                                                    @elseif($rfp->bypass == 0 && $rfp->qoutes->count() == 0 && $rfp->quotation_time < \Carbon\Carbon::now() && $rfp->status == 'pending')
                                                        @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                            <a href="{{ route('resetQuotationTime', ['EOrderItemID' => $rfp->id]) }}"
                                                               class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Are you sure to reset this requisition?')}}'>
                                                                {{__('portal.Reset')}}
                                                            </a>
                                                            <a href="{{ route('discardQuotation', ['EOrderID' => $placedRFQ->id]) }}"
                                                               class="inline-flex items-center justify-center mt-2 px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Are you sure to discard this requisition?')}}'>
                                                                {{__('portal.Discard')}}
                                                            </a>
                                                        @endif
                                                    @elseif($rfp->bypass == 0 && $rfp->quotation_time < \Carbon\Carbon::now() && $rfp->status == 'pending')
                                                        @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                            <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $placedRFQ->id, 'EOrderItemID' => $rfp->id, 'bypass_id' => 0]) }}"
                                                               class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                                {{__('portal.See Quotes')}}
                                                            </a>
                                                        @endif
                                                    @elseif($rfp->status == 'accepted')
                                                        <span style="color: #eb8e08">{{__('portal.Completed')}}</span>
                                                    @else
                                                        {{ $rfp->qoutes->count() }}
                                                    @endif

                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if($rfp->qoutes->count() > 0 && $rfp->quotation_time >= \Carbon\Carbon::now() && $rfp->bypass == 0)
        {{--                                                @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))--}}
                                                        @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                            <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $placedRFQ->id, 'EOrderItemID' => $rfp->id, 'bypass_id' => 1]) }}"
                                                               class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Once overrode you cannot receive quotations for this requisition')}}'>
                                                                {{__('portal.Override')}}
                                                            </a>
                                                        @endif
                                                    @elseif($rfp->quotation_time >= \Carbon\Carbon::now() && $rfp->bypass == 1)
                                                        {{__('portal.Overrode')}}
                                                    @else
                                                        {{__('portal.N/A')}}
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{__('portal.RFQ')}}-{{ $placedRFQ->OrderItems[0]->id }}
                                            </td>
                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @php
                                                    $record = \App\Models\Category::where('id',$placedRFQ->OrderItems[0]->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp
                                                {{ $record->name }} @if(isset($parent)) , {{$parent->name}} @endif
                                            </td>
                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{ __('portal.Single Category') }} <br>
                                            </td>
                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                {{ $placedRFQ->created_at->format('d-m-Y') }} <br>
                                            </td>
                                            @php
                                                $created = $placedRFQ->OrderItems[0]->quotation_time;
                                                $time = \Carbon\Carbon::parse($created)->format('Y-m-d');
                                                $now = \Carbon\Carbon::now();
                                                $diffInHrs = $now->diffInHours($created);
                                                $diffInMins = $now->diffInMinutes($created);
                                                // checking previous dpo if any
                                                $dpo = \App\Models\DraftPurchaseOrder::where('rfq_item_no', $placedRFQ->OrderItems[0]->id)->where('po_status' , 'pending')->where('status' , 'pending')->first();
                                            @endphp
                                            <td
                                                @if($placedRFQ->OrderItems[0]->status == 'accepted')  class="px-6 py-4 text-center whitespace-nowrap"
                                                @elseif($placedRFQ->OrderItems[0]->bypass == 1)
                                                @else
                                                class="px-6 py-4 text-center whitespace-nowrap"  data-countdown="{{$time}}"
                                                @endif
                                            >
                                                @if($placedRFQ->OrderItems[0]->status == 'accepted')
                                                    {{__('portal.N/A')}}
                                                @else
                                                    {{--                                            <br>--}}
                                                    <div class="text-center"><span class="text-center">--</span></div>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @if(isset($dpo))
                                                    <span class="text-blue-600">{{__('portal.DPO generated')}}</span>
                                                @elseif($placedRFQ->OrderItems[0]->bypass == 1 && $placedRFQ->OrderItems[0]->quotation_time > \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->status == 'pending')
                                                    @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                                        <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['eOrderID' => $placedRFQ->id, 'bypass_id' => 0]) }}"
                                                           class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                            {{__('portal.See Quotes')}}
                                                        </a>
                                                    @endif
                                                @elseif($placedRFQ->OrderItems[0]->bypass == 1 && $placedRFQ->OrderItems[0]->quotation_time < \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->status == 'pending')
                                                    @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                                        <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['eOrderID' => $placedRFQ->id, 'bypass_id' => 0]) }}"
                                                           class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                            {{__('portal.See Quotes')}}
                                                        </a>
                                                    @endif
                                                @elseif($placedRFQ->OrderItems[0]->bypass == 0 && $placedRFQ->OrderItems[0]->qoutes->count() == 0 && $placedRFQ->OrderItems[0]->quotation_time < \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->status == 'pending')
                                                    @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                        <a href="{{ route('resetSingleCategoryQuotationTime', ['eOrderID' => $placedRFQ->id]) }}"
                                                           class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Are you sure to reset this requisition?')}}'>
                                                            {{__('portal.Reset')}}
                                                        </a>
                                                        <a href="{{ route('discardSingleCategoryQuotation', ['eOrderID' => $placedRFQ->id]) }}"
                                                           class="inline-flex mt-1 items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Are you sure to discard this requisition?')}}'>
                                                            {{__('portal.Discard')}}
                                                        </a>
                                                    @endif
                                                @elseif($placedRFQ->OrderItems[0]->bypass == 0 && $placedRFQ->OrderItems[0]->quotation_time < \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->status == 'pending')
                                                    @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                        <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['eOrderID' => $placedRFQ->id, 'bypass_id' => 0]) }}"
                                                           class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                            {{__('portal.See Quotes')}}
                                                        </a>
                                                    @endif
                                                @elseif($placedRFQ->OrderItems[0]->status == 'accepted')
                                                    <span style="color: #eb8e08">{{__('portal.Completed')}}</span>
                                                @else
                                                    @php
                                                        /* Counting Total quotations for Single Category RFQ */
                                                            $quotationCount = array();
                                                            $quotationCount = \App\Models\Qoute::where('e_order_id', $placedRFQ->id)->get();
                                                    @endphp
                                                    {{count($quotationCount->unique('supplier_user_id'))}}
                                                @endif

                                            </td>

                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                @if($placedRFQ->OrderItems[0]->qoutes->count() > 0 && $placedRFQ->OrderItems[0]->quotation_time >= \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->bypass == 0)
                                                    @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                        <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['eOrderID' => $placedRFQ->id, 'bypass_id' => 1]) }}"
                                                           class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Once overrode you cannot receive quotations for this requisition')}}'>
                                                            {{__('portal.Override')}}
                                                        </a>
                                                    @endif
                                                @elseif($placedRFQ->OrderItems[0]->quotation_time >= \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->bypass == 1)
                                                    {{__('portal.Overrode')}}
                                                @else
                                                    {{__('portal.N/A')}}
                                                @endif
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            {{ $PlacedRFQ->onEachSide(2)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="mt-4 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Quotations List')}}</h2>

        @if ($PlacedRFQ->count())
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Requisition')}} #
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Category Name')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Requisition Type')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Date')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Time left')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Quotations/Status')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Action')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($PlacedRFQ as $placedRFQ)
                                        @if($placedRFQ->rfq_type == 1)
                                            @foreach ($placedRFQ->OrderItems->sortBy('created_at') as $rfp)
                                                <tr>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{__('portal.RFQ')}}-{{ $rfp->id }}
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        @php
                                                            $record = \App\Models\Category::where('id',$rfp->item_code)->first();
                                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                        @endphp
                                                        {{ $record->name_ar }} @if(isset($parent)), {{$parent->name_ar}} @endif
                                                    </td>
                                                    <td class="px-7 py-4 text-center whitespace-nowrap">
                                                        {{__('portal.Multiple Categories')}}
                                                    </td>
                                                    <td class="px-7 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->created_at->format('d-m-Y') }}
                                                    </td>

                                                    {{--<td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->unit_of_measurement }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->size }}
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->quantity }}
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ number_format($rfp->last_price, 2) }} <br>
                                                    </td>--}}

                                                    @php
                                                        $created = $rfp->quotation_time;
                                                        $time = \Carbon\Carbon::parse($created)->format('Y-m-d');
                                                        $now = \Carbon\Carbon::now();
                                                        $diffInHrs = $now->diffInHours($created);
                                                        $diffInMins = $now->diffInMinutes($created);
                                                        // checking previous dpo if any
                                                        $dpo = \App\Models\DraftPurchaseOrder::where('rfq_item_no', $rfp->id)->where('po_status' , 'pending')->where('status' , 'pending')->first();
                                                    @endphp
                                                    <td
                                                        @if($rfp->status == 'accepted')  class="px-6 py-4 text-center whitespace-nowrap"
                                                        @elseif($rfp->bypass == 1)
                                                        @else
                                                        class="px-6 py-4 text-center whitespace-nowrap"  data-countdown="{{$time}}"
                                                        @endif
                                                    >
                                                        @if($rfp->status == 'accepted')
                                                            {{__('portal.N/A')}}
                                                        @else
                                                            {{--                                                {{ $diffInHrs }} hours @if($diffInHrs == 0) and {{ $diffInMins }} minutes @endif --}}
                                                            {{--                                                <br>--}}
                                                            <div class="text-center"><span class="text-center">--</span></div>
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        @if(isset($dpo))
                                                            <span class="text-blue-600">{{__('portal.DPO generated')}}</span>
                                                        @elseif($rfp->bypass == 1 && $rfp->quotation_time > \Carbon\Carbon::now() && $rfp->status == 'pending')
                                                            @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                                                <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $placedRFQ->id, 'EOrderItemID' => $rfp->id, 'bypass_id' => 0]) }}"
                                                                   class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                                    {{__('portal.See Quotes')}}
                                                                </a>
                                                            @endif
                                                        @elseif($rfp->bypass == 1 && $rfp->quotation_time < \Carbon\Carbon::now() && $rfp->status == 'pending')
                                                            @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                                                <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $placedRFQ->id, 'EOrderItemID' => $rfp->id, 'bypass_id' => 0]) }}"
                                                                   class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                                    {{__('portal.See Quotes')}}
                                                                </a>
                                                            @endif
                                                        @elseif($rfp->bypass == 0 && $rfp->qoutes->count() == 0 && $rfp->quotation_time < \Carbon\Carbon::now() && $rfp->status == 'pending')
                                                            @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                                <a href="{{ route('resetQuotationTime', ['EOrderItemID' => $rfp->id]) }}"
                                                                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Are you sure to reset this requisition?')}}'>
                                                                    {{__('portal.Reset')}}
                                                                </a>
                                                                <a href="{{ route('discardQuotation', ['EOrderID' => $placedRFQ->id]) }}"
                                                                   class="inline-flex items-center justify-center mt-2 px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Are you sure to discard this requisition?')}}'>
                                                                    {{__('portal.Discard')}}
                                                                </a>
                                                            @endif
                                                        @elseif($rfp->bypass == 0 && $rfp->quotation_time < \Carbon\Carbon::now() && $rfp->status == 'pending')
                                                            @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                                <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $placedRFQ->id, 'EOrderItemID' => $rfp->id, 'bypass_id' => 0]) }}"
                                                                   class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                                    {{__('portal.See Quotes')}}
                                                                </a>
                                                            @endif
                                                        @elseif($rfp->status == 'accepted')
                                                            <span style="color: #eb8e08">{{__('portal.Completed')}}</span>
                                                        @else
                                                            {{ $rfp->qoutes->count() }}
                                                        @endif

                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        @if($rfp->qoutes->count() > 0 && $rfp->quotation_time >= \Carbon\Carbon::now() && $rfp->bypass == 0)
                                                            {{--                                                @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))--}}
                                                            @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                                <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $placedRFQ->id, 'EOrderItemID' => $rfp->id, 'bypass_id' => 1]) }}"
                                                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Once overrode you cannot receive quotations for this requisition')}}'>
                                                                    {{__('portal.Override')}}
                                                                </a>
                                                            @endif
                                                        @elseif($rfp->quotation_time >= \Carbon\Carbon::now() && $rfp->bypass == 1)
                                                            {{__('portal.Overrode')}}
                                                        @else
                                                            {{__('portal.N/A')}}
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{__('portal.RFQ')}}-{{ $placedRFQ->OrderItems[0]->id }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @php
                                                        $record = \App\Models\Category::where('id',$placedRFQ->OrderItems[0]->item_code)->first();
                                                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                    @endphp
                                                    {{ $record->name_ar }} @if(isset($parent)) , {{$parent->name_ar}} @endif
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ __('portal.Single Category') }} <br>
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $placedRFQ->created_at->format('d-m-Y') }} <br>
                                                </td>
                                                @php
                                                    $created = $placedRFQ->OrderItems[0]->quotation_time;
                                                    $time = \Carbon\Carbon::parse($created)->format('Y-m-d');
                                                    $now = \Carbon\Carbon::now();
                                                    $diffInHrs = $now->diffInHours($created);
                                                    $diffInMins = $now->diffInMinutes($created);
                                                    // checking previous dpo if any
                                                    $dpo = \App\Models\DraftPurchaseOrder::where('rfq_item_no', $placedRFQ->OrderItems[0]->id)->where('po_status' , 'pending')->where('status' , 'pending')->first();
                                                @endphp
                                                <td
                                                    @if($placedRFQ->OrderItems[0]->status == 'accepted')  class="px-6 py-4 text-center whitespace-nowrap"
                                                    @elseif($placedRFQ->OrderItems[0]->bypass == 1)
                                                    @else
                                                    class="px-6 py-4 text-center whitespace-nowrap"  data-countdown="{{$time}}"
                                                    @endif
                                                >
                                                    @if($placedRFQ->OrderItems[0]->status == 'accepted')
                                                        {{__('portal.N/A')}}
                                                    @else
                                                        {{--                                            <br>--}}
                                                        <div class="text-center"><span class="text-center">--</span></div>
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if(isset($dpo))
                                                        <span class="text-blue-600">{{__('portal.DPO generated')}}</span>
                                                    @elseif($placedRFQ->OrderItems[0]->bypass == 1 && $placedRFQ->OrderItems[0]->quotation_time > \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->status == 'pending')
                                                        @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                                            <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['eOrderID' => $placedRFQ->id, 'bypass_id' => 0]) }}"
                                                               class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                                {{__('portal.See Quotes')}}
                                                            </a>
                                                        @endif
                                                    @elseif($placedRFQ->OrderItems[0]->bypass == 1 && $placedRFQ->OrderItems[0]->quotation_time < \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->status == 'pending')
                                                        @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                                            <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['eOrderID' => $placedRFQ->id, 'bypass_id' => 0]) }}"
                                                               class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                                {{__('portal.See Quotes')}}
                                                            </a>
                                                        @endif
                                                    @elseif($placedRFQ->OrderItems[0]->bypass == 0 && $placedRFQ->OrderItems[0]->qoutes->count() == 0 && $placedRFQ->OrderItems[0]->quotation_time < \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->status == 'pending')
                                                        @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                            <a href="{{ route('resetSingleCategoryQuotationTime', ['eOrderID' => $placedRFQ->id]) }}"
                                                               class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 hover:text-white focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Are you sure to reset this requisition?')}}'>
                                                                {{__('portal.Reset')}}
                                                            </a>
                                                            <a href="{{ route('discardSingleCategoryQuotation', ['eOrderID' => $placedRFQ->id]) }}"
                                                               class="inline-flex mt-1 items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Are you sure to discard this requisition?')}}'>
                                                                {{__('portal.Discard')}}
                                                            </a>
                                                        @endif
                                                    @elseif($placedRFQ->OrderItems[0]->bypass == 0 && $placedRFQ->OrderItems[0]->quotation_time < \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->status == 'pending')
                                                        @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                            <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['eOrderID' => $placedRFQ->id, 'bypass_id' => 0]) }}"
                                                               class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                                {{__('portal.See Quotes')}}
                                                            </a>
                                                        @endif
                                                    @elseif($placedRFQ->OrderItems[0]->status == 'accepted')
                                                        <span style="color: #eb8e08">{{__('portal.Completed')}}</span>
                                                    @else
                                                        @php
                                                            /* Counting Total quotations for Single Category RFQ */
                                                                $quotationCount = array();
                                                                $quotationCount = \App\Models\Qoute::where('e_order_id', $placedRFQ->id)->get();
                                                        @endphp
                                                        {{count($quotationCount->unique('supplier_user_id'))}}
                                                    @endif

                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if($placedRFQ->OrderItems[0]->qoutes->count() > 0 && $placedRFQ->OrderItems[0]->quotation_time >= \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->bypass == 0)
                                                        @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                            <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['eOrderID' => $placedRFQ->id, 'bypass_id' => 1]) }}"
                                                               class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Once overrode you cannot receive quotations for this requisition')}}'>
                                                                {{__('portal.Override')}}
                                                            </a>
                                                        @endif
                                                    @elseif($placedRFQ->OrderItems[0]->quotation_time >= \Carbon\Carbon::now() && $placedRFQ->OrderItems[0]->bypass == 1)
                                                        {{__('portal.Overrode')}}
                                                    @else
                                                        {{__('portal.N/A')}}
                                                    @endif
                                                </td>

                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $PlacedRFQ->onEachSide(2)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </x-app-layout>
@endif

<script>

    $('.confirm').on('click', function (e) {
        return confirm($(this).data('confirm'));
    });

    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%D day(s) %H:%M:%S'));
        });
    });

    $(document).ready(function() {
        $('#quotation-table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    });
</script>
