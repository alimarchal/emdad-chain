<nav class="flex flex-col sm:flex-row">
    <a href="{{ route('QoutationsBuyerReceivedQoutes', [$EOrderID, $EOrderItemID]) }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutationsBuyerReceivedQoutes') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
        Received Qoutes
    </a>
    <a href="{{ route('QoutationsBuyerReceivedRejected', [$EOrderID, $EOrderItemID]) }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutationsBuyerReceivedRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        Rejected
    </a>
    <a href="{{ route('QoutationsBuyerReceivedModificationNeeded', [$EOrderID, $EOrderItemID]) }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutationsBuyerReceivedModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        Modification needed
    </a>
    <a href="{{ route('QoutationsBuyerReceivedAccepted', [$EOrderID, $EOrderItemID]) }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutationsBuyerReceivedAccepted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
        Pending Confirmation
    </a>
</nav>