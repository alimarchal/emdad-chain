<nav class="flex flex-col sm:flex-row">
    <a href="{{ route('singleCategoryRFQs') }}" class="py-4 px-6 block hover:text-blue-500 focus:outline-none {{ request()->routeIs('singleCategoryRFQs') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        New
    </a>
    <a href="{{ route('singleCategoryQuotedRFQQuoted') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQQuoted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
        @php $quotedCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where([['qoute_status', 'Qouted'],['qoute_status_updated', null]])->get(); @endphp
        Quoted <span class="text-red-400">({{count($quotedCount->unique('e_order_id'))}})</span>
    </a>
    <a href="{{ route('singleCategoryQuotedModifiedRFQ') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryQuotedModifiedRFQ') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
        @php $modifiedQuotedCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where(['qoute_status' => 'Modified'])->get(); @endphp
        Modified <span class="text-red-400">({{count($modifiedQuotedCount->unique('e_order_id'))}})</span>
    </a>
    <a href="{{ route('singleCategoryQuotedRFQRejected') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        @php $rejectedCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where('qoute_status_updated', 'Rejected')->get(); @endphp
        Rejected <span class="text-red-400">({{count($rejectedCount->unique('e_order_id'))}})</span>
    </a>
    <a href="{{ route('singleCategoryQuotedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        @php $modificationCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where('qoute_status_updated', 'ModificationNeeded')->get(); @endphp
        Modification needed <span class="text-red-400">({{count($modificationCount->unique('e_order_id'))}})</span>
    </a>
    <a href="{{ route('singleCategoryQuotedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        @php $pendingCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where('qoute_status', 'RFQPendingConfirmation')->get(); @endphp
        Pending Confirmation <span class="text-red-400">({{count($pendingCount->unique('e_order_id'))}})</span>
    </a>
</nav>
