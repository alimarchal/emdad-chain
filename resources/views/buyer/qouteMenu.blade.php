<nav class="flex flex-col sm:flex-row">
    <a href="{{ route('QoutationsBuyerReceivedQoutes', [$EOrderID, $EOrderItemID,$bypass_id]) }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutationsBuyerReceivedQoutes') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
        {{__('portal.Received Quotes')}}
    </a>
    <a href="{{ route('QoutationsBuyerReceivedRejected', [$EOrderID, $EOrderItemID,$bypass_id]) }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutationsBuyerReceivedRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        {{__('portal.Rejected')}}
    </a>
    <a href="{{ route('QoutationsBuyerReceivedModificationNeeded', [$EOrderID, $EOrderItemID,$bypass_id]) }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutationsBuyerReceivedModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        {{__('portal.Modification needed')}}
    </a>
    <a href="{{ route('QoutationsBuyerReceivedAccepted', [$EOrderID, $EOrderItemID,$bypass_id]) }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutationsBuyerReceivedAccepted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        {{__('portal.Pending Confirmation')}}
    </a>
</nav>
