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
        <h2 class="text-2xl font-bold py-2 text-center m-2">Items List @if (!$collection->count()) seems empty @endif
        </h2>

        <!-- Remaining Quotation count for Basic and Silver Business Packages -->
        @php
            $quotations = \App\Models\Qoute::where('supplier_business_id', auth()->user()->business_id)->whereDate('created_at', \Carbon\Carbon::today())->count();
            $business_package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();

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

        <!-- This example requires Tailwind CSS v2.0+ -->
        <!-- component -->
        <div class="bg-white">
            <nav class="flex flex-col sm:flex-row">
                <a href="{{ route('viewRFQs') }}" class="py-4 px-6 block hover:text-blue-500 focus:outline-none {{ request()->routeIs('viewRFQs') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    New
                </a>
                <a href="{{ route('QoutedRFQQouted') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutedRFQQouted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                    @php $quotedCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where([['qoute_status', 'Qouted'],['qoute_status_updated', null]])->count(); @endphp
                    Quoted <span class="text-red-400">({{$quotedCount}})</span>
                </a>
                <a href="{{ route('QuotedModifiedRFQ') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QuotedModifiedRFQ') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                    @php $quotedCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1, 'qoute_status' => 'Modified'])->count(); @endphp
                    Modified <span class="text-red-400">({{$quotedCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQRejected') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutedRFQRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $rejectedCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status_updated', 'Rejected')->count(); @endphp
                    Rejected <span class="text-red-400">({{$rejectedCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $modificationCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status_updated', 'ModificationNeeded')->count(); @endphp
                    Modification needed <span class="text-red-400">({{$modificationCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 focus:outline-none  {{ request()->routeIs('QoutedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $pendingCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status', 'RFQPendingConfirmation')->count(); @endphp
                    Pending Confirmation <span class="text-red-400">({{$pendingCount}})</span>
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
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                            </path>
                                        </svg>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Category Name
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Company Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Quantity
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Requested On
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Action
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($collection as $rfp)
                                    @php
                                        $getQoutes = $rfp->qoutes;
                                        $user_id = auth()->user()->id;
                                        $qoute = $getQoutes->where('supplier_user_id',$user_id);
                                    @endphp
                                    @if ($qoute->isEmpty())
                                        @if(isset($quotationCount) && $quotationCount != 0 && $quotationCount != null)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $rfp->id }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($rfp->file_path)
                                                        <a href="{{ Storage::url($rfp->file_path) }}">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $rfp->item_name }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$rfp->item_code)->first()->parent_id))->first()->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($rfp->company_name_check == 1) {{ $rfp->business->business_name }} @endif
    {{--                                            {{ $rfp->business }}--}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $rfp->quantity }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $rfp->created_at->format('d-m-Y') }} <br>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="{{ url('viewRFQs/'.$rfp->id) }}" class=" px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                        Response
                                                    </a>
                                                </td>

                                            </tr>
                                        @elseif($quotationCount == null)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $rfp->id }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($rfp->file_path)
                                                        <a href="{{ Storage::url($rfp->file_path) }}">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $rfp->item_name }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$rfp->item_code)->first()->parent_id))->first()->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($rfp->company_name_check == 1) {{ $rfp->business->business_name }} @endif
                                                    {{--                                            {{ $rfp->business }}--}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $rfp->quantity }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $rfp->created_at->format('d-m-Y') }} <br>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="{{ url('viewRFQs/'.$rfp->id) }}" class=" px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                        Response
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
                                    @endif

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
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                            </path>
                                        </svg>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        Product Name
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        Company Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        العدد
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        Requested On
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 tracking-wider">
                                        نشاط
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($collection as $rfp)
                                    @php
                                        $getQoutes = $rfp->qoutes;
                                        $user_id = auth()->user()->id;
                                        $qoute = $getQoutes->where('supplier_user_id',$user_id);
                                    @endphp
                                    @if ($qoute->isEmpty())
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($rfp->file_path)
                                                    <a href="{{ Storage::url($rfp->file_path) }}">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                @else
                                                    #N/A
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->item_name }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{--                                        {{ $rfp->business->business_name }}--}}
                                                {{--                                        {{ $rfp->business }}--}}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->created_at->format('d-m-Y') }} <br>
                                            </td>


                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ url('viewRFQs/'.$rfp->id) }}" class=" px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    Response
                                                </a>
                                            </td>

                                        </tr>
                                    @endif

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
                عودة
            </a>
        </div>





    </x-app-layout>
@endif
