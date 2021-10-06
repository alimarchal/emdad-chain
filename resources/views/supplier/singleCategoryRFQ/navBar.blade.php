<nav class="flex flex-col sm:flex-row">
    <a href="{{ route('singleCategoryRFQs') }}" class="py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none {{ request()->routeIs('singleCategoryRFQs') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        {{__('portal.New')}}
    </a>
    <a href="{{ route('singleCategoryQuotedRFQQuoted') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQQuoted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
        @php
            $quoted = \App\Models\Qoute::where(['supplier_user_id' => auth()->id() , 'rfq_type' => 0])
                                ->where(function ($query){
                                    $query->where(['qoute_status' => 'Qouted'])->where(['qoute_status_updated' => null])->orWhere(['qoute_status' => 'accepted']);
                                })->get();

            $collection = $quoted->unique('e_order_id');

            $quoted = array();
            $accepted = array();
            /* Separating Quotes which have dpo created SINGLE CATEGORY */
            foreach ($collection as $col)
            {
                if ($col['qoute_status'] == 'Qouted')
                {
                    $quoted[] = $col;
                }
                if ($col['qoute_status'] == 'accepted' )
                {
                    $accepted[] = $col;
                }
            }
            $quotedCollection = collect($quoted);
            $acceptedCollection = collect($accepted);

            $dpo = array();
            /* Checking where quotes have DPO with pending status SINGLE CATEGORY */
            foreach ($acceptedCollection as $acceptedCol)
            {
                $dpoPresent = \App\Models\DraftPurchaseOrder::where('id', $acceptedCol->dpo)->where('status', 'pending')->first();
                if ($dpoPresent)
                {
                    $dpo[] = $acceptedCol;
                }
            }
            $pendingDpo = collect($dpo);
            $quotedQuotes = collect($quotedCollection->merge($pendingDpo));
            $collection = $quotedQuotes;
        @endphp
        {{__('portal.Quoted')}} <span class="text-red-400">({{count($collection)}})</span>
    </a>
    <a href="{{ route('singleCategoryQuotedModifiedRFQ') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('singleCategoryQuotedModifiedRFQ') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
        @php $modifiedQuotedCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where(['qoute_status' => 'Modified'])->get(); @endphp
        {{__('portal.Modified')}} <span class="text-red-400">({{count($modifiedQuotedCount->unique('e_order_id'))}})</span>
    </a>
    <a href="{{ route('singleCategoryQuotedRFQRejected') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        @php $rejectedCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where('qoute_status_updated', 'Rejected')->get(); @endphp
        {{__('portal.Rejected')}} <span class="text-red-400">({{count($rejectedCount->unique('e_order_id'))}})</span>
    </a>
    <a href="{{ route('singleCategoryQuotedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        @php $modificationCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where('qoute_status_updated', 'ModificationNeeded')->get(); @endphp
        {{__('portal.Modification needed')}} <span class="text-red-400">({{count($modificationCount->unique('e_order_id'))}})</span>
    </a>
    <a href="{{ route('singleCategoryQuotedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        @php $pendingCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where('qoute_status', 'RFQPendingConfirmation')->get(); @endphp
        {{__('portal.Pending Confirmation')}} <span class="text-red-400">({{count($pendingCount->unique('e_order_id'))}})</span>
    </a>
</nav>
