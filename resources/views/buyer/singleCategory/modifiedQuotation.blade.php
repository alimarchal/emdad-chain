<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
        <div class="block mt-2 text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
            <strong class="mr-1">{{ session('message') }}</strong>
            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <h2 class="text-2xl font-bold py-2 text-center m-2">Quotations List @if (!$collection->count()) seems empty @endif
    </h2>
    <div class="bg-white">
        @include('buyer.singleCategory.navBar')
    </div>

    @if ($collection->count())
        <div class="flex flex-col bg-white ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    ID
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Quantity
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Price Per Quantity
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Sample Information
                                </th>


                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Shipping Time In Days
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Note
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Action
                                </th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                foreach ($collection as $collect)
                                {
                                    $modification = \App\Models\Qoute::where(['qoute_status' => 'ModificationNeeded', 'e_order_id' => $collect->e_order_id])->first();
                                }
                                foreach ($collection as $collect)
                                {
                                    $modified = \App\Models\Qoute::where(['qoute_status' => 'Modified', 'e_order_id' => $collect->e_order_id])->first();
                                }
                            @endphp
                            @if(isset($modified) )
                                @foreach ($collection->where('qoute_status', 'Modified') as $rfp)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
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
                                            {{ $rfp->shipping_time_in_days }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ strip_tags($rfp->note_for_customer) }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->created_at->format('d-m-Y') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('singleCategoryRFQItemByID', $rfp->id) }}"
                                               class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                Respond
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            @elseif(isset($modification))
                                @foreach ($collection->where('qoute_status', 'ModificationNeeded') as $rfp)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
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
                                            {{ $rfp->shipping_time_in_days }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ strip_tags($rfp->note_for_customer) }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->created_at->format('d-m-Y') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a class="inline-flex text-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                                                Waiting for response
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="mt-5">
        <a href="{{ route('singleCategoryBuyerRFQs') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
            Back
        </a>
    </div>
</x-app-layout>
