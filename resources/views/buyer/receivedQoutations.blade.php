
@if (auth()->user()->rtl == 0)
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
        <h2 class="text-2xl font-bold py-2 text-center m-2">Quotations List</h2>

        <!-- This example requires Tailwind CSS v2.0+ -->

        <div class="flex flex-col bg-white rounded ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            {{-- <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Date
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    RFQ #
                                </th>

                                <th scope="col" class="px-6 py-3 text-xs text-center font-medium text-gray-500 tracking-wider">
                                    Total Items For Qoutes
                                </th>
                            </tr> --}}

                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    #
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Date
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
                                    Time left
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Quotations
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Override
                                </th>


                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($PlacedRFQ as $item)
                                @foreach ($item->OrderItems->sortBy('created_at') as $rfp)
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->id }}
                                        </td>
                                        <td class="px-7 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->created_at->format('d-m-Y') }}
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

                                        @php
                                            $created = $rfp->quotation_time;
                                            $now = \Carbon\Carbon::now();
                                            $diffInHrs = $now->diffInHours($created);
                                            $diffInMins = $now->diffInMinutes($created);
                                            // checking previous dpo if any
                                            $dpo = \App\Models\DraftPurchaseOrder::where('rfq_item_no', $rfp->id)->where('po_status' , 'pending')->where('status' , 'pending')->first();
                                        @endphp
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($rfp->status == 'accepted')
                                                N/A
                                            @else
                                                {{ $diffInHrs }} hours @if($diffInHrs == 0) and {{ $diffInMins }} minutes @endif <br>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if(isset($dpo))
                                                <a class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                                                    DPO generated
                                                </a>
                                            @elseif($rfp->bypass == 1 && $rfp->quotation_time >= \Carbon\Carbon::now() && $rfp->status == 'pending')
                                                <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $item->id, 'EOrderItemID' => $rfp->id, 'bypass_id' => 0]) }}"
                                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                   See Quotes
                                                </a>
                                            @elseif($rfp->bypass == 0 && $rfp->quotation_time <= \Carbon\Carbon::now() && $rfp->status == 'pending')
                                                <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $item->id, 'EOrderItemID' => $rfp->id, 'bypass_id' => 0]) }}"
                                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    See Quotes
                                                </a>
                                            @elseif($rfp->status == 'accepted')
                                                <a class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                                                    Completed
                                                </a>
                                            @else
                                                {{ $rfp->qoutes->count() }}
                                            @endif

                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($rfp->qoutes->count() > 0 && $rfp->quotation_time >= \Carbon\Carbon::now() && $rfp->bypass == 0)
                                                <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $item->id, 'EOrderItemID' => $rfp->id, 'bypass_id' => 1]) }}"
                                                   class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    Override
                                                </a>
                                            @elseif($rfp->quotation_time >= \Carbon\Carbon::now() && $rfp->bypass == 1)
                                                Overrode
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                    </tr>

                                @endforeach
                                {{-- <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $item->created_at->format('d-m-Y') }}
                                    </td>


                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if ($item->business_id)
                                            <a href="{{ route('RFQItemsByID', $item->id) }}" class="hover:underline hover:text-blue-900 text-blue-900">
                                                EMDAD-{{ $item->business_id }}-{{ $item->id }}
                                            </a>
                                            @else
                                            <a href="{{ route('RFQItemsByID', $item->id) }}" class="hover:underline hover:text-blue-900 text-blue-900">
                                                EMDAD-{{ $item->business_id }}-{{ $item->id }}
                                            </a>
                                        @endif

                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <a href="{{ route('QoutationsBuyerReceivedRFQItemsByID', $item->id) }}"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                            View-Items: {{ $item->OrderItems->count() }})
                                        </a>
                                    </td>


                                </tr> --}}
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

@else
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
        <h2 class="text-2xl font-bold py-2 text-center m-2">Quotations List</h2>

        <!-- This example requires Tailwind CSS v2.0+ -->

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
                                    تاريخ
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    اسم المنتج
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    الوحدة
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    مقاس
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    العدد
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    السعر الأخير
                                </th>


                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    عرض السعر
                                </th>


                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($PlacedRFQ as $item)
                                @foreach ($item->OrderItems->sortBy('created_at') as $rfp)
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->id }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $rfp->created_at->format('d-m-Y') }}
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
                                            <a href="{{ route('QoutationsBuyerReceivedQoutes', ['EOrderID' => $item->id, 'EOrderItemID' => $rfp->id]) }}"
                                               class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                عروض الأسعار  ({{ $rfp->qoutes->count() }})
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach
                                {{-- <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $item->created_at->format('d-m-Y') }}
                                    </td>


                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if ($item->business_id)
                                            <a href="{{ route('RFQItemsByID', $item->id) }}" class="hover:underline hover:text-blue-900 text-blue-900">
                                                EMDAD-{{ $item->business_id }}-{{ $item->id }}
                                            </a>
                                            @else
                                            <a href="{{ route('RFQItemsByID', $item->id) }}" class="hover:underline hover:text-blue-900 text-blue-900">
                                                EMDAD-{{ $item->business_id }}-{{ $item->id }}
                                            </a>
                                        @endif

                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <a href="{{ route('QoutationsBuyerReceivedRFQItemsByID', $item->id) }}"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                            View-Items: {{ $item->OrderItems->count() }})
                                        </a>
                                    </td>


                                </tr> --}}
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif

