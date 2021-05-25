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
    <!-- component -->
    <div class="bg-white">
        <nav class="flex flex-col sm:flex-row">
            <a href="{{ route('viewRFQs') }}" class="py-4 px-6 block hover:text-blue-500 focus:outline-none {{ request()->routeIs('viewRFQs') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                New
            </a>
            <a href="{{ route('QoutedRFQQouted') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutedRFQQouted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                Qouted
            </a>
            <a href="{{ route('QoutedRFQRejected') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutedRFQRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                Rejected
            </a>
            <a href="{{ route('QoutedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                Modification needed
            </a>
            <a href="{{ route('QoutedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                Pending Confirmation
            </a>
        </nav>
    </div>
    @if ($collection->count())
        <div class="flex flex-col bg-white rounded ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Item Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                         {{ ucwords(str_replace("_", " ", "quantity")) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                         {{ ucwords(str_replace("_", " ", "price_per_quantity")) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                         {{ ucwords(str_replace("_", " ", "sample_information")) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                         {{ ucwords(str_replace("_", " ", "sample_unit")) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                         {{ ucwords(str_replace("_", " ", "sample_security_charges")) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                         {{ ucwords(str_replace("_", " ", "sample_charges_per_unit")) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                         {{ ucwords(str_replace("_", " ", "shipping_time_in_days")) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                         {{ ucwords(str_replace("_", " ", "note_for_customer")) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                         {{ ucwords(str_replace("_", " ", "qoute_status")) }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Action
                                   </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($collection as $rfp)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->orderItem->item_name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->quote_quantity }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->quote_price_per_quantity }}
                                        </td>


                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->sample_information }}
                                        </td>



                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->sample_unit }}
                                        </td>



                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->sample_security_charges }}
                                        </td>


                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->sample_charges_per_unit }}
                                        </td>


                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->shipping_time_in_days }}
                                        </td>


                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ strip_tags($rfp->note_for_customer) }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->qoute_status }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('viewRFQsID', $rfp->orderItem->id) }}" class=" px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                Response
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
        <a href="{{ route('dashboard') }}"
            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Back
        </a>
    </div>
</x-app-layout>
