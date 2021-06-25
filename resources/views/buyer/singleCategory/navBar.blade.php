<nav class="flex flex-col sm:flex-row">
    <a href="{{route('singleCategoryRFQQuotationsBuyerReceived', [$EOrderItemID,$bypass_id])}}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryRFQQuotationsBuyerReceived') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
        Received
    </a>
    <a href="{{route('singleCategoryRFQQuotationsBuyerRejected', [$EOrderItemID,$bypass_id])}}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryRFQQuotationsBuyerRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        Rejected
    </a>
    <a href="{{route('singleCategoryRFQQuotationsModificationNeeded', [$EOrderItemID,$bypass_id])}}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryRFQQuotationsModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        Modification needed
    </a>
{{--    <a href="" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutationsBuyerReceivedAccepted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">--}}
{{--        Pending Confirmation--}}
{{--    </a>--}}
</nav>
