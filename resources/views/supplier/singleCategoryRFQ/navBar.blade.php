<nav class="flex flex-col sm:flex-row">
    <a href="{{ route('singleCategoryRFQs') }}" class="py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none {{ request()->routeIs('singleCategoryRFQs') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        @php
            $business_cate = \App\Models\BusinessCategory::where('business_id', auth()->user()->business_id)->get();
            if ($business_cate->isNotEmpty()) {
                foreach ($business_cate as $item) {
                    $business_categories[] = (int)$item->category_number;
                }
            }
            sort($business_categories);
                // Counting NEW RFQs for single category for supplier
                $now = \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d H:i:s');
                $eOrderItems = \App\Models\EOrderItems::where(['status' => 'pending', 'rfq_type' => 0])
                                                                ->where('bypass', 0)
                                                                ->whereDate('quotation_time', '>=', $now)
                                                                ->whereIn('item_code', $business_categories)
                                                                ->get();
                $eOrders = array();
                foreach ($eOrderItems as $eOrderItem)
                {
                    $eOrderPresent[] = \App\Models\EOrders::where(['id' => $eOrderItem->e_order_id])->first();
                    /*$eOrderPresent[] = \App\Models\EOrders::where(['id' => $eOrderItem->e_order_id, 'rfq_type' => 1])->first();*/
                    $eOrders = $eOrderPresent;
                }
                $quotes = array();
                $quotesNotPresent = array(); /* For saving and counting eOrders having no Quotes */
                if (count($eOrders) > 0)
                {
                    foreach($eOrders as $eOrder)
                        {
                            /*$quotes = \App\Models\EOrders::where(['id' => $eOrder->id])->withCount('quotes')->get();*/
                            $quotes = \App\Models\Qoute::where(['e_order_id' => $eOrder->id, 'supplier_business_id' => auth()->user()->business_id])->first();
                            if (!($quotes))
                                {
                                    $quotesNotPresent[] = $eOrder->id;
                                }
                        }
                }
        @endphp
        {{__('portal.New RFQs')}} <span class="text-red-400" style="font-family: sans-serif">({{count(array_unique($quotesNotPresent))}})</span>
    </a>
    <a href="{{ route('singleCategoryQuotedRFQQuoted') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQQuoted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
        @php
            $quoted = \App\Models\Qoute::where(['supplier_business_id' => auth()->user()->business_id , 'rfq_type' => 0])
                                        ->where('qoute_status' , '!=' ,'ModificationNeeded')
                                        ->where('qoute_status' , '!=' ,'RFQPendingConfirmation')
                                        ->get();

        $collection = $quoted->unique('e_order_id');
        @endphp
        {{__('portal.Quoted')}} <span class="text-red-400" style="font-family: sans-serif">({{count($collection)}})</span>
    </a>
    {{--<a href="{{ route('singleCategoryQuotedModifiedRFQ') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('singleCategoryQuotedModifiedRFQ') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
        @php $modifiedQuotedCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where(['qoute_status' => 'Modified'])->get(); @endphp
        {{__('portal.Modified')}} <span class="text-red-400 style="font-family: sans-serif"">({{count($modifiedQuotedCount->unique('e_order_id'))}})</span>
    </a>
    <a href="{{ route('singleCategoryQuotedRFQRejected') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        @php $rejectedCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where('qoute_status_updated', 'Rejected')->get(); @endphp
        {{__('portal.Rejected')}} <span class="text-red-400 style="font-family: sans-serif"">({{count($rejectedCount->unique('e_order_id'))}})</span>
    </a>--}}
    <a href="{{ route('singleCategoryQuotedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        @php $modificationCount = \App\Models\Qoute::where(['supplier_business_id'=> auth()->user()->business_id, 'rfq_type' => 0])->where('qoute_status_updated', 'ModificationNeeded')->get(); @endphp
        {{__('portal.Modification needed')}} <span class="text-red-400" style="font-family: sans-serif">({{count($modificationCount->unique('e_order_id'))}})</span>
    </a>
    <a href="{{ route('singleCategoryQuotedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        @php $pendingCount = \App\Models\Qoute::where(['supplier_business_id'=> auth()->user()->business_id, 'rfq_type' => 0])->where('qoute_status', 'RFQPendingConfirmation')->get(); @endphp
        {{__('portal.Pending Confirmation')}} <span class="text-red-400" style="font-family: sans-serif">({{count($pendingCount->unique('e_order_id'))}})</span>
    </a>
    <a href="{{ route('singleCategoryRFQExpired') }}" class=" py-4 px-6 block hover:text-blue-500 font-bold focus:outline-none  {{ request()->routeIs('singleCategoryRFQExpired') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        @php

            $col = \App\Models\Qoute::where(['supplier_business_id' => auth()->user()->business_id , 'rfq_type' => 0, 'request_status' => 1])
                            ->where(function ($query){
                                $query->where(['qoute_status' => 'Qouted'])->orWhere(['qoute_status' => 'accepted']);
                            })
                            ->get();

            $collection = $col->unique('e_order_id');
            $expired = array();
            foreach ($collection as $rfp)
            {
                if($rfp->qoute_status_updated != 'Rejected')
                {
                    $expired[] = $rfp;
                }
            }
         @endphp
        {{__('portal.Expired')}} <span class="text-red-400" style="font-family: sans-serif">({{count($expired)}})</span>
    </a>
</nav>
