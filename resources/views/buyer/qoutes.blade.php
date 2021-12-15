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
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Quotations List')}} @if (!$collection->qoutes->count()) {{__('portal.seems empty')}} @endif </h2>

        <div class="bg-white">
            @include('buyer.qouteMenu')
        </div>

        @if ($collection->qoutes->count())
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.ID')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Category Name')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Quantity')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Unit Price')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Size')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Shipping Time')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Total Cost')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Note')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Created At')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Quotation valid upto')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Action')}}
                                        </th>

                                    </tr>
                                </thead>
                                @php $packageType = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first(); @endphp
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if($packageType->package_id == 1)
                                    @php
                                        /*$modification = $collection->qoutes()->where('qoute_status', 'ModificationNeeded')->orWhere('qoute_status', 'Modified')->first();*/

                                        /* Changed query and added two because of orWhere clause Error in single query */
                                        $modificationModificationNeeded = $collection->qoutes()->where('qoute_status', 'ModificationNeeded')->first();
                                        $modificationModified = $collection->qoutes()->where('qoute_status', 'Modified')->first();
                                    @endphp
                                    {{--                                    @if(isset($modification) )--}}
                                    @if(isset($modificationModificationNeeded) || isset($modificationModified))
                                           {{-- @foreach ($collection->qoutes->where('qoute_status', 'ModificationNeeded') as $rfp)
                                                <tr>
                                                    <td class="px-6 text-center py-4 whitespace-nowrap">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 text-center py-4 whitespace-nowrap">
                                                        {{ $rfp->quote_quantity }}
                                                    </td>

                                                    <td class="px-6 text-center py-4 whitespace-nowrap">
                                                        {{ $rfp->quote_price_per_quantity }} {{__('portal.SAR')}}
                                                    </td>

                                                    <td class="px-6 text-center py-4 whitespace-nowrap">
                                                        {{ $rfp->orderItem->size }}
                                                    </td>

                                                    <td class="px-6 text-center py-4 whitespace-nowrap">
                                                        {{ $rfp->sample_information }}
                                                    </td>


                                                    <td class="px-6 text-center py-4 whitespace-nowrap">
                                                        {{ $rfp->shipping_time_in_days }}
                                                    </td>

                                                    <td class="px-6 text-center py-4 whitespace-nowrap">
                                                        {{ $rfp->total_cost }} {{__('portal.SAR')}}
                                                    </td>

                                                    <td class="px-6 text-center py-4 whitespace-nowrap">
                                                        {{ strip_tags($rfp->note_for_customer) }}
                                                    </td>

                                                    <td class="px-6 text-center py-4 whitespace-nowrap">
                                                        {{ $rfp->created_at->format('d-m-Y') }}
                                                    </td>

                                                    <td class="px-6 text-center py-4 whitespace-nowrap">
                                                        <a href="{{ route('QoutationsBuyerReceivedQouteID', $rfp->id) }}"
                                                           class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                            Respond
                                                        </a>
                                                    </td>

                                                </tr>
                                            @endforeach--}}
                                        <div class="text-center"> <span class="py-4 px-6 block hover:text-red-500 focus:outline-none 'text-blue-500 border-b-2 font-medium border-blue-500' text-center text-bold text-red-700"> {{__('portal.See Modification needed tab')}}</span></div>
                                    @else
                                        @foreach ($collection->qoutes->where('qoute_status', 'Qouted')->sortBy('total_cost')->take(2) as $rfp)
                                            <tr>
                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @php
                                                        $categoryName = \App\Models\Category::where('id', $rfp->orderItem->item_code)->first();
                                                        $parentName = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name')->first();
                                                    @endphp
                                                    {{ $categoryName->name }}@if(isset($parentName)), {{$parentName}} @endif
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ number_format($rfp->quote_quantity) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->quote_price_per_quantity }} {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->orderItem->size }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->shipping_time_in_days }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ number_format($rfp->total_cost, 2) }} {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ strip_tags($rfp->note_for_customer) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->created_at->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ \Carbon\Carbon::parse($rfp->expiry_date)->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @if($rfp->qoute_status_updated == 'Rejected')
                                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                            {{__('portal.Rejected')}}
                                                        </a>
                                                    @else
                                                        @if($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 1)
                                                            <a class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-600 transition ease-in-out duration-150">
                                                                {{__('portal.You have asked for extension in expiry date for this quotation.')}}
                                                            </a>
                                                        @elseif($rfp->expiry_date >= \Carbon\Carbon::now())
                                                            {{-- Below php tag is checking whether any extension request is send to supplier for any quotation or not if yes buyer cannot respond to any quotation --}}
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if(!$present)
                                                                <a href="{{ route('QoutationsBuyerReceivedQouteID', $rfp->id) }}"
                                                                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Respond')}}
                                                                </a>
                                                            @endif
                                                        @elseif($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 0)
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if($present)
                                                                {{--  Show Nothing if extension request is send against any quotation --}}
                                                            @else
                                                                <a href="{{ route('QuotationExpiredStatusUpdate', $rfp->id) }}" onclick="request()" title="{{__('portal.Request to extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Quotation Expired')}}
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif

                                @elseif($packageType->package_id == 2)
                                    @php
                                        $modificationModificationNeeded = $collection->qoutes()->where('qoute_status', 'ModificationNeeded')->first();
                                        $modificationModified = $collection->qoutes()->where('qoute_status', 'Modified')->first();
                                    @endphp
                                    @if(isset($modificationModificationNeeded) || isset($modificationModified))
                                        <div class="text-center"> <span class="py-4 px-6 block hover:text-red-500 focus:outline-none 'text-blue-500 border-b-2 font-medium border-blue-500' text-center text-bold text-red-700"> {{__('portal.See Modification needed tab')}}</span></div>
                                    @else
                                        @foreach ($collection->qoutes->where('qoute_status', 'Qouted')->sortBy('total_cost')->take(3) as $rfp)
                                            <tr>
                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @php
                                                        $categoryName = \App\Models\Category::where('id', $rfp->orderItem->item_code)->first();
                                                        $parentName = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name')->first();
                                                    @endphp
                                                    {{ $categoryName->name }}@if(isset($parentName)), {{$parentName}} @endif
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ number_format($rfp->quote_quantity) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->quote_price_per_quantity }} {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->orderItem->size }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->shipping_time_in_days }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ number_format($rfp->total_cost, 2) }} {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ strip_tags($rfp->note_for_customer) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->created_at->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ \Carbon\Carbon::parse($rfp->expiry_date)->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @if($rfp->qoute_status_updated == 'Rejected')
                                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                            {{__('portal.Rejected')}}
                                                        </a>
                                                    @else
                                                        @if($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 1)
                                                            <a class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-600 transition ease-in-out duration-150">
                                                                {{__('portal.You have asked for extension in expiry date for this quotation.')}}
                                                            </a>
                                                        @elseif($rfp->expiry_date >= \Carbon\Carbon::now())
                                                            {{-- Below php tag is checking whether any extension request is send to supplier for any quotation or not if yes buyer cannot respond to any quotation --}}
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if(!$present)
                                                                <a href="{{ route('QoutationsBuyerReceivedQouteID', $rfp->id) }}"
                                                                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Respond')}}
                                                                </a>
                                                            @endif
                                                        @elseif($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 0)
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if($present)
                                                                {{--  Show Nothing if extension request is send against any quotation --}}
                                                            @else
                                                                <a href="{{ route('QuotationExpiredStatusUpdate', $rfp->id) }}" onclick="request()" title="{{__('portal.Request to extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Quotation Expired')}}
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                @elseif($packageType->package_id == 3 || $packageType->package_id == 4)
                                    @php
                                        $modificationModificationNeeded = $collection->qoutes()->where('qoute_status', 'ModificationNeeded')->first();
                                        $modificationModified = $collection->qoutes()->where('qoute_status', 'Modified')->first();
                                    @endphp
                                    @if(isset($modificationModificationNeeded) || isset($modificationModified))
                                        <div class="text-center"> <span class="py-4 px-6 block hover:text-red-500 focus:outline-none 'text-blue-500 border-b-2 font-medium border-blue-500' text-center text-bold text-red-700"> {{__('portal.See Modification needed tab')}}</span></div>
                                    @else
                                        @foreach ($collection->qoutes->where('qoute_status', 'Qouted')->sortBy('total_cost')->take(5) as $rfp)
                                            <tr>
                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @php
                                                        $categoryName = \App\Models\Category::where('id', $rfp->orderItem->item_code)->first();
                                                        $parentName = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name')->first();
                                                    @endphp
                                                    {{ $categoryName->name }}@if(isset($parentName)), {{$parentName}} @endif
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ number_format($rfp->quote_quantity) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->quote_price_per_quantity }} {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->orderItem->size }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->shipping_time_in_days }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ number_format($rfp->total_cost, 2) }} {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ strip_tags($rfp->note_for_customer) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ $rfp->created_at->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    {{ \Carbon\Carbon::parse($rfp->expiry_date)->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @if($rfp->qoute_status_updated == 'Rejected')
                                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                            {{__('portal.Rejected')}}
                                                        </a>
                                                    @else
                                                        @if($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 1)
                                                            <a class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-600 transition ease-in-out duration-150">
                                                                {{__('portal.You have asked for extension in expiry date for this quotation.')}}
                                                            </a>
                                                        @elseif($rfp->expiry_date >= \Carbon\Carbon::now())
                                                            {{-- Below php tag is checking whether any extension request is send to supplier for any quotation or not if yes buyer cannot respond to any quotation --}}
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if(!$present)
                                                                <a href="{{ route('QoutationsBuyerReceivedQouteID', $rfp->id) }}"
                                                                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Respond')}}
                                                                </a>
                                                            @endif
                                                        @elseif($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 0)
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if($present)
                                                                {{--  Show Nothing if extension request is send against any quotation --}}
                                                            @else
                                                                <a href="{{ route('QuotationExpiredStatusUpdate', $rfp->id) }}" onclick="request()" title="{{__('portal.Request to extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Quotation Expired')}}
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="mt-5">
            <a href="{{ route('QoutationsBuyerReceived') }}" style="background-color: #145EA8"
               class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                {{__('portal.Back')}}
            </a>
        </div>
    </x-app-layout>

    <script>
        function request() {
            if(!confirm('Are you sure to request Quotation extension?')){
                event.preventDefault();
            }
        }
    </script>
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
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Quotations List')}} @if (!$collection->qoutes->count()) {{__('portal.seems empty')}} @endif </h2>

        <div class="bg-white">
            @include('buyer.qouteMenu')
        </div>

        @if ($collection->qoutes->count())
            <div class="flex flex-col bg-white ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.ID')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Category Name')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Quantity')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Unit Price')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Size')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Shipping Time')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Total Cost')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Note')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Created At')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Quotation valid upto')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center font-medium text-gray-500 tracking-wider" style="background-color: #FCE5CD;">
                                            {{__('portal.Action')}}
                                        </th>

                                    </tr>
                                </thead>
                                @php $packageType = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first(); @endphp
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if($packageType->package_id == 1)
                                    @php
                                        /*$modification = $collection->qoutes()->where('qoute_status', 'ModificationNeeded')->orWhere('qoute_status', 'Modified')->first();*/

                                        /* Changed query and added two because of orWhere clause Error in single query */
                                        $modificationModificationNeeded = $collection->qoutes()->where('qoute_status', 'ModificationNeeded')->first();
                                        $modificationModified = $collection->qoutes()->where('qoute_status', 'Modified')->first();
                                    @endphp
                                    {{--                                    @if(isset($modification) )--}}
                                    @if(isset($modificationModificationNeeded) || isset($modificationModified))
                                        {{-- @foreach ($collection->qoutes->where('qoute_status', 'ModificationNeeded') as $rfp)
                                             <tr>
                                                 <td class="px-6 text-center py-4 whitespace-nowrap">
                                                     {{ $loop->iteration }}
                                                 </td>

                                                 <td class="px-6 text-center py-4 whitespace-nowrap">
                                                     {{ $rfp->quote_quantity }}
                                                 </td>

                                                 <td class="px-6 text-center py-4 whitespace-nowrap">
                                                     {{ $rfp->quote_price_per_quantity }} {{__('portal.SAR')}}
                                                 </td>

                                                 <td class="px-6 text-center py-4 whitespace-nowrap">
                                                     {{ $rfp->orderItem->size }}
                                                 </td>

                                                 <td class="px-6 text-center py-4 whitespace-nowrap">
                                                     {{ $rfp->sample_information }}
                                                 </td>

                                                 <td class="px-6 text-center py-4 whitespace-nowrap">
                                                     {{ $rfp->shipping_time_in_days }}
                                                 </td>

                                                 <td class="px-6 text-center py-4 whitespace-nowrap">
                                                     {{ $rfp->total_cost }} {{__('portal.SAR')}}
                                                 </td>

                                                 <td class="px-6 text-center py-4 whitespace-nowrap">
                                                     {{ strip_tags($rfp->note_for_customer) }}
                                                 </td>

                                                 <td class="px-6 text-center py-4 whitespace-nowrap">
                                                     {{ $rfp->created_at->format('d-m-Y') }}
                                                 </td>

                                                 <td class="px-6 text-center py-4 whitespace-nowrap">
                                                     <a href="{{ route('QoutationsBuyerReceivedQouteID', $rfp->id) }}"
                                                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                         Respond
                                                     </a>
                                                 </td>

                                             </tr>
                                         @endforeach--}}
                                        <div class="text-center"> <span class="py-4 px-6 block hover:text-red-500 focus:outline-none 'text-blue-500 border-b-2 font-medium border-blue-500' text-center text-bold text-red-700"> {{__('portal.See Modification needed tab')}}</span></div>
                                    @else
                                        @foreach ($collection->qoutes->where('qoute_status', 'Qouted')->sortBy('total_cost')->take(2) as $rfp)
                                            <tr>
                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @php
                                                        $categoryName = \App\Models\Category::where('id', $rfp->orderItem->item_code)->first();
                                                        $parentName = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name_ar')->first();
                                                    @endphp
                                                    {{ $categoryName->name_ar }}@if(isset($parentName)), {{$parentName}} @endif
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ number_format($rfp->quote_quantity) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    <span style="font-family: sans-serif">{{ $rfp->quote_price_per_quantity }}</span> {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $rfp->orderItem->size }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $rfp->shipping_time_in_days }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    <span style="font-family: sans-serif">{{ number_format($rfp->total_cost, 2) }}</span> {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ strip_tags($rfp->note_for_customer) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $rfp->created_at->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ \Carbon\Carbon::parse($rfp->expiry_date)->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @if($rfp->qoute_status_updated == 'Rejected')
                                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent hover:text-white rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                            {{__('portal.Rejected')}}
                                                        </a>
                                                    @else
                                                        @if($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 1)
                                                            <a class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent hover:text-white rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-600 transition ease-in-out duration-150">
                                                                {{__('portal.You have asked for extension in expiry date for this quotation.')}}
                                                            </a>
                                                        @elseif($rfp->expiry_date >= \Carbon\Carbon::now())
                                                            {{-- Below php tag is checking whether any extension request is send to supplier for any quotation or not if yes buyer cannot respond to any quotation --}}
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if(!$present)
                                                                <a href="{{ route('QoutationsBuyerReceivedQouteID', $rfp->id) }}"
                                                                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md hover:text-white font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Respond')}}
                                                                </a>
                                                            @endif
                                                        @elseif($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 0)
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if($present)
                                                                {{--  Show Nothing if extension request is send against any quotation --}}
                                                            @else
                                                                <a href="{{ route('QuotationExpiredStatusUpdate', $rfp->id) }}" onclick="request()" title="{{__('portal.Request to extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:text-white border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Quotation Expired')}}
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif

                                @elseif($packageType->package_id == 2)
                                    @php
                                        $modificationModificationNeeded = $collection->qoutes()->where('qoute_status', 'ModificationNeeded')->first();
                                        $modificationModified = $collection->qoutes()->where('qoute_status', 'Modified')->first();
                                    @endphp
                                    @if(isset($modificationModificationNeeded) || isset($modificationModified))
                                        <div class="text-center"> <span class="py-4 px-6 block hover:text-red-500 focus:outline-none 'text-blue-500 border-b-2 font-medium border-blue-500' text-center text-bold text-red-700"> {{__('portal.See Modification needed tab')}}</span></div>
                                    @else
                                        @foreach ($collection->qoutes->where('qoute_status', 'Qouted')->sortBy('total_cost')->take(3) as $rfp)
                                            <tr>
                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @php
                                                        $categoryName = \App\Models\Category::where('id', $rfp->orderItem->item_code)->first();
                                                        $parentName = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name_ar')->first();
                                                    @endphp
                                                    {{ $categoryName->name_ar }}@if(isset($parentName)), {{$parentName}} @endif
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ number_format($rfp->quote_quantity) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    <span style="font-family: sans-serif">{{ $rfp->quote_price_per_quantity }}</span> {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $rfp->orderItem->size }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $rfp->shipping_time_in_days }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    <span style="font-family: sans-serif">{{ number_format($rfp->total_cost, 2) }}</span> {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ strip_tags($rfp->note_for_customer) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $rfp->created_at->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ \Carbon\Carbon::parse($rfp->expiry_date)->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @if($rfp->qoute_status_updated == 'Rejected')
                                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md hover:text-white font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                            {{__('portal.Rejected')}}
                                                        </a>
                                                    @else
                                                        @if($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 1)
                                                            <a class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md hover:text-white font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-600 transition ease-in-out duration-150">
                                                                {{__('portal.You have asked for extension in expiry date for this quotation.')}}
                                                            </a>
                                                        @elseif($rfp->expiry_date >= \Carbon\Carbon::now())
                                                            {{-- Below php tag is checking whether any extension request is send to supplier for any quotation or not if yes buyer cannot respond to any quotation --}}
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if(!$present)
                                                                <a href="{{ route('QoutationsBuyerReceivedQouteID', $rfp->id) }}"
                                                                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent hover:text-white rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Respond')}}
                                                                </a>
                                                            @endif
                                                        @elseif($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 0)
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if($present)
                                                                {{--  Show Nothing if extension request is send against any quotation --}}
                                                            @else
                                                                <a href="{{ route('QuotationExpiredStatusUpdate', $rfp->id) }}" onclick="request()" title="{{__('portal.Request to extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:text-white border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Quotation Expired')}}
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                @elseif($packageType->package_id == 3 || $packageType->package_id == 4)
                                    @php
                                        $modificationModificationNeeded = $collection->qoutes()->where('qoute_status', 'ModificationNeeded')->first();
                                        $modificationModified = $collection->qoutes()->where('qoute_status', 'Modified')->first();
                                    @endphp
                                    @if(isset($modificationModificationNeeded) || isset($modificationModified))
                                        <div class="text-center"> <span class="py-4 px-6 block hover:text-red-500 focus:outline-none 'text-blue-500 border-b-2 font-medium border-blue-500' text-center text-bold text-red-700"> {{__('portal.See Modification needed tab')}}</span></div>
                                    @else
                                        @foreach ($collection->qoutes->where('qoute_status', 'Qouted')->sortBy('total_cost')->take(5) as $rfp)
                                            <tr>
                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @php
                                                        $categoryName = \App\Models\Category::where('id', $rfp->orderItem->item_code)->first();
                                                        $parentName = \App\Models\Category::where('id', $categoryName->parent_id)->pluck('name_ar')->first();
                                                    @endphp
                                                    {{ $categoryName->name_ar }}@if(isset($parentName)), {{$parentName}} @endif
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ number_format($rfp->quote_quantity) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    <span style="font-family: sans-serif">{{ $rfp->quote_price_per_quantity }}</span> {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $rfp->orderItem->size }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $rfp->shipping_time_in_days }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    <span style="font-family: sans-serif">{{ number_format($rfp->total_cost, 2) }}</span> {{__('portal.SAR')}}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ strip_tags($rfp->note_for_customer) }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ $rfp->created_at->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap" style="font-family: sans-serif">
                                                    {{ \Carbon\Carbon::parse($rfp->expiry_date)->format('d-m-Y') }}
                                                </td>

                                                <td class="px-6 text-center py-4 whitespace-nowrap">
                                                    @if($rfp->qoute_status_updated == 'Rejected')
                                                        <a class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent hover:text-white rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                            {{__('portal.Rejected')}}
                                                        </a>
                                                    @else
                                                        @if($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 1)
                                                            <a class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent hover:text-white rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-600 transition ease-in-out duration-150">
                                                                {{__('portal.You have asked for extension in expiry date for this quotation.')}}
                                                            </a>
                                                        @elseif($rfp->expiry_date >= \Carbon\Carbon::now())
                                                            {{-- Below php tag is checking whether any extension request is send to supplier for any quotation or not if yes buyer cannot respond to any quotation --}}
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if(!$present)
                                                                <a href="{{ route('QoutationsBuyerReceivedQouteID', $rfp->id) }}"
                                                                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent hover:text-white rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Respond')}}
                                                                </a>
                                                            @endif
                                                        @elseif($rfp->expiry_date < \Carbon\Carbon::now() && $rfp->request_status == 0)
                                                            @php $requestStatus = $collection->qoutes->where('qoute_status', 'Qouted')->where('qoute_status_updated', '!=', 'Rejected')->sortBy('total_cost')->take(5)->pluck('id'); $present = \App\Models\Qoute::whereIn('id', $requestStatus)->where('request_status', 1)->first(); @endphp
                                                            @if($present)
                                                                {{--  Show Nothing if extension request is send against any quotation --}}
                                                            @else
                                                                <a href="{{ route('QuotationExpiredStatusUpdate', $rfp->id) }}" onclick="request()" title="{{__('portal.Request to extend quotation expiry date')}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:text-white border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                                    {{__('portal.Quotation Expired')}}
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="mt-5">
            <a href="{{ route('QoutationsBuyerReceived') }}" style="background-color: #145EA8"
               class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                {{__('portal.Back')}}
            </a>
        </div>
    </x-app-layout>

    <script>
        function request() {
            if(!confirm('Are you sure to request Quotation extension?')){
                event.preventDefault();
            }
        }
    </script>
@endif
