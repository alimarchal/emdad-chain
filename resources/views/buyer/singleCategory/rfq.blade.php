@section('headerScripts')
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous"></script>
@endsection
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
    <h2 class="text-2xl font-bold py-2 text-center m-2">Quotations List</h2>

    <div class="flex flex-col bg-white rounded ">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">

                        <tr>

                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                RFQ Item #
                            </th>

                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                Category Name
                            </th>

                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                Unit
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                Size
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                Quantity
                            </th>

                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                Last Price
                            </th>

                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                Time left
                            </th>

                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                Quotations
                            </th>

                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                Override
                            </th>

                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($RFQItems as $RFQItem)
                                <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $RFQItem->id }}
                                    </td>
                                    <td class="px-7 py-4 text-center whitespace-nowrap">
                                        {{ $RFQItem->created_at->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $RFQItem->item_name }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $RFQItem->unit_of_measurement }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $RFQItem->size }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $RFQItem->quantity }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ number_format($RFQItem->last_price, 2) }} <br>
                                    </td>

                                    @php
                                        $created = $RFQItem->quotation_time;
                                        $time = \Carbon\Carbon::parse($created)->format('Y-m-d');
                                        $now = \Carbon\Carbon::now();
                                        $diffInHrs = $now->diffInHours($created);
                                        $diffInMins = $now->diffInMinutes($created);
                                        // checking previous dpo if any
                                        $dpo = \App\Models\DraftPurchaseOrder::where('rfq_item_no', $RFQItem->id)->where('po_status' , 'pending')->where('status' , 'pending')->first();
                                    @endphp
                                    <td
                                        @if($RFQItem->status == 'accepted')  class="px-6 py-4 text-center whitespace-nowrap"
                                        @elseif($RFQItem->bypass == 1)
                                        @else
                                        class="px-6 py-4 text-center whitespace-nowrap"  data-countdown="{{$time}}"
                                        @endif
                                    >
                                        @if($RFQItem->status == 'accepted')
                                            N/A
                                        @else
                                            <br>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if(isset($dpo))
                                            <a class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                                                DPO generated
                                            </a>
                                        @elseif($RFQItem->bypass == 1 && $RFQItem->quotation_time > \Carbon\Carbon::now() && $RFQItem->status == 'pending')
                                            @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                                <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['EOrderItemID' => $RFQItem->id, 'bypass_id' => 0]) }}"
                                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    See Quotes
                                                </a>
                                            @endif
                                        @elseif($RFQItem->bypass == 1 && $RFQItem->quotation_time < \Carbon\Carbon::now() && $RFQItem->status == 'pending')
                                            @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))
                                                <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['EOrderItemID' => $RFQItem->id, 'bypass_id' => 0]) }}"
                                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    See Quotes
                                                </a>
                                            @endif
                                        @elseif($RFQItem->bypass == 0 && $RFQItem->quotation_time < \Carbon\Carbon::now() && $RFQItem->status == 'pending')
                                            @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['EOrderItemID' => $RFQItem->id, 'bypass_id' => 0]) }}"
                                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    See Quotes
                                                </a>
                                            @endif
                                        @elseif($RFQItem->status == 'accepted')
                                            <a class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                                                Completed
                                            </a>
                                        @else
                                            {{ $RFQItem->qoutes->count() }}
                                        @endif

                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if($RFQItem->qoutes->count() > 0 && $RFQItem->quotation_time >= \Carbon\Carbon::now() && $RFQItem->bypass == 0)
                                            {{--                                                @if(auth()->user()->can('Buyer Quotation Response') || auth()->user()->hasRole('CEO'))--}}
                                            @if(auth()->user()->can('Buyer View Quotations') || auth()->user()->hasRole('CEO'))
                                                <a href="{{ route('singleCategoryRFQQuotationsBuyerReceived', ['EOrderItemID' => $RFQItem->id, 'bypass_id' => 1]) }}"
                                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    Override
                                                </a>
                                            @endif
                                        @elseif($RFQItem->quotation_time >= \Carbon\Carbon::now() && $RFQItem->bypass == 1)
                                            Overrode
                                        @else
                                            N/A
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
    <div class="mt-5">
        <a href="{{route('singleCategoryBuyerRFQs')}}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
            Back
        </a>
    </div>
</x-app-layout>

<script>
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%D day(s) %H:%M:%S'));
        });
    });
</script>
