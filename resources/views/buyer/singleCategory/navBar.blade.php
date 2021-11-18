<nav class="flex flex-col sm:flex-row">
    <a href="{{route('singleCategoryRFQQuotationsBuyerReceived', [$eOrderID,$bypass_id])}}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('singleCategoryRFQQuotationsBuyerReceived') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
        {{__('portal.Received')}}
    </a>
    <a href="{{route('singleCategoryRFQQuotationsBuyerRejected', [$eOrderID,$bypass_id])}}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('singleCategoryRFQQuotationsBuyerRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        {{__('portal.Rejected')}}
    </a>
    <a href="{{route('singleCategoryRFQQuotationsModificationNeeded', [$eOrderID,$bypass_id])}}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('singleCategoryRFQQuotationsModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        {{__('portal.Modification needed')}}
    </a>
{{--    <a href="" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutationsBuyerReceivedAccepted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">--}}
{{--        Pending Confirmation--}}
{{--    </a>--}}
</nav>
