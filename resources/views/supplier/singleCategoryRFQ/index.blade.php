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
    <h2 class="text-2xl font-bold py-2 text-center m-2">Items List @if (!$eOrders->count()) seems empty @endif
    </h2>

    <!-- Remaining Quotation count for Basic and Silver Business Packages -->
    @php
        $quotations = \App\Models\Qoute::where('supplier_business_id', auth()->user()->business_id)->whereDate('created_at', \Carbon\Carbon::today())->count();
        $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();

        $package = \App\Models\Package::where('id', $business_package->package_id)->first();
        if ($package->id != 7)
        {
            $count = $package->quotations - $quotations;
        }
    @endphp


    @if($business_package->package_id == 5 || $business_package->package_id == 6 )
        <div class="flex flex-wrap" style="justify-content: flex-start">
            <h1 class="text-1xl mt-0 pb-0 text-center"> New RFQ(s) response remaining for the day: </h1>
            <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$count}} </h1>
        </div>
    @endif
    <hr>

    <div class="bg-white">
        <nav class="flex flex-col sm:flex-row">
            <a href="{{ route('singleCategoryRFQs') }}" class="py-4 px-6 block hover:text-blue-500 focus:outline-none {{ request()->routeIs('singleCategoryRFQs') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                New
            </a>
            <a href="{{ route('singleCategoryQuotedRFQQuoted') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQQuoted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                @php $quotedCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where([['qoute_status', 'Qouted'],['qoute_status_updated', null]])->count(); @endphp
                Quoted <span class="text-red-400">({{$quotedCount}})</span>
            </a>
            <a href="{{ route('singleCategoryQuotedModifiedRFQ') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryQuotedModifiedRFQ') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                @php $quotedCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where(['qoute_status' => 'Modified'])->count(); @endphp
                Modified <span class="text-red-400">({{$quotedCount}})</span>
            </a>
            <a href="{{ route('singleCategoryQuotedRFQRejected') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                @php $rejectedCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where('qoute_status_updated', 'Rejected')->count(); @endphp
                Rejected <span class="text-red-400">({{$rejectedCount}})</span>
            </a>
            <a href="{{ route('singleCategoryQuotedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                @php $modificationCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where('qoute_status_updated', 'ModificationNeeded')->count(); @endphp
                Modification needed <span class="text-red-400">({{$modificationCount}})</span>
            </a>
            <a href="{{ route('singleCategoryQuotedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('singleCategoryQuotedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                @php $pendingCount = \App\Models\Qoute::where(['supplier_user_id'=> auth()->user()->id, 'rfq_type' => 0])->where('qoute_status', 'RFQPendingConfirmation')->count(); @endphp
                Pending Confirmation <span class="text-red-400">({{$pendingCount}})</span>
            </a>
        </nav>
    </div>

    @if ($eOrders->count())
        <div class="flex flex-col bg-white rounded ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Sr #
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Category Name
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Company Name
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Requested On
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    View
                                </th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $eOrders =array();
                                $eOrderItems = \App\Models\EOrderItems::where(['status' => 'pending', 'rfq_type' => 0])
                                                                        ->where('bypass', 0)
                                                                        ->whereDate('quotation_time', '>=', \Carbon\Carbon::now())
                                                                        ->whereIn('item_code', $business_categories)
                                                                        ->get();
                            @endphp
                            @foreach ($eOrderItems as $eOrderItem)
                                @php
                                    $eOrderPresent[] = \App\Models\EOrders::where(['id' => $eOrderItem->e_order_id])->first();

                                    $eOrders = $eOrderPresent;
                                @endphp
                            @endforeach

                            @foreach (array_unique($eOrders) as $order)
                                    @if(isset($quotationCount) && $quotationCount != 0 && $quotationCount != null)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php $eOrder = \App\Models\EOrderItems::where('e_order_id', $order->id)->first(); @endphp
                                                {{ $eOrder->item_name }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$eOrder->item_code)->first()->parent_id))->first()->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($eOrder->company_name_check == 1) {{ $eOrder->business->business_name }} @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $order->created_at->format('d-m-Y') }} <br>
                                            </td>
                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                <a href="{{ route('viewRFQsOfSingleCategory' , $order->id) }}">
                                                    <svg class="w-6 h-6 inline" fill="none" stroke="red"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    <span class="inline"></span>
                                                </a>
                                            </td>

                                        </tr>
                                    @elseif($quotationCount == null)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php $eOrder = \App\Models\EOrderItems::where('e_order_id', $order->id)->first(); @endphp
                                                {{ $eOrder->item_name }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$eOrder->item_code)->first()->parent_id))->first()->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($eOrder->company_name_check == 1) {{ $eOrder->business->business_name }} @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $order->created_at->format('d-m-Y') }} <br>
                                            </td>
                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                <a href="{{ route('viewRFQsOfSingleCategory' , $order->id) }}">
                                                    <svg class="w-6 h-6 inline" fill="none" stroke="red"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    <span class="inline"></span>
                                                </a>
                                            </td>

                                        </tr>
                                    @else
                                        <div class="py-12">
                                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                                                        <div class="text-black text-2xl" style="text-align: center">
                                                            Your have reached daily generate quotation limit.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
