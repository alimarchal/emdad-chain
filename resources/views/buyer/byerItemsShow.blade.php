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
    <h2 class="text-2xl font-bold py-2 text-center m-2">Items List @if (!$collection->count()) seems empty @endif
    </h2>

    <!-- This example requires Tailwind CSS v2.0+ -->


    @if ($collection->count())
        @php $total = 0; @endphp
        <div class="flex flex-col bg-white rounded ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        Item Name
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
                                        Qoutes Received
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
                                            {{ $rfp->item_name }}
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
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
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $EOrderItems, 'EOrderItemID' => $rfp->id]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                Qoutes({{ $rfp->qoutes->count() }})
                                            </a>

                                        </td>

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
        <a href="{{ route('QoutationsBuyerReceived') }}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Back
        </a>
    </div>





</x-app-layout>
