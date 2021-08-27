@section('headerScripts')
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
@endsection
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Quotations List')}} @if (!$collection->count()) {{__('portal.seems empty')}} @endif </h2>

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
                <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.New RFQ(s) response remaining for the day')}}: </h1>
                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$count}} </h1>
            </div>
        @endif
        <hr>

        <div class="bg-white">
            <nav class="flex flex-col sm:flex-row">
                <a href="{{ route('viewRFQs') }}" class="py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none {{ request()->routeIs('viewRFQs') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    {{__('portal.New')}}
                </a>
                <a href="{{ route('QoutedRFQQouted') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQQouted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                    @php $quotedCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where([['qoute_status', 'Qouted'],['qoute_status_updated', null]])->count(); @endphp
                    {{__('portal.Quoted')}} <span class="text-red-400">({{$quotedCount}})</span>
                </a>
                <a href="{{ route('QuotedModifiedRFQ') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QuotedModifiedRFQ') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                    @php $quotedCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1, 'qoute_status' => 'Modified'])->count(); @endphp
                    {{__('portal.Modified')}} <span class="text-red-400">({{$quotedCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQRejected') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $rejectedCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status_updated', 'Rejected')->count(); @endphp
                    {{__('portal.Rejected')}} <span class="text-red-400">({{$rejectedCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $modificationCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status_updated', 'ModificationNeeded')->count(); @endphp
                    {{__('portal.Modification needed')}} <span class="text-red-400">({{$modificationCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $pendingCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status', 'RFQPendingConfirmation')->count(); @endphp
                    {{__('portal.Pending Confirmation')}} <span class="text-red-400">({{$pendingCount}})</span>
                </a>
            </nav>
        </div>
        @if ($collection->count())
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200" id="quotation-table">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{__('portal.ID')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{__('portal.Category Name')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{__('portal.Company Name')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{__('portal.Quantity')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{__('portal.Requested On')}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                            </svg>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                            {{__('portal.Action')}}
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
                                            @if(isset($quotationCount) && $quotationCount > 0)
                                                <tr>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->id }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->item_name }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$rfp->item_code)->first()->parent_id))->first()->name }}
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        @if($rfp->company_name_check == 1) {{ $rfp->business->business_name }} @else {{__('portal.N/A')}} @endif
        {{--                                            {{ $rfp->business }}--}}
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->quantity }}
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->created_at->format('d-m-Y') }} <br>
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        @if ($rfp->file_path)
                                                            <a href="{{ Storage::url($rfp->file_path) }}">
                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @else
                                                            {{__('portal.N/A')}}
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        <a href="{{ url('viewRFQs/'.$rfp->id) }}" class=" px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                            {{__('portal.Response')}}
                                                        </a>
                                                    </td>

                                                </tr>
                                            @elseif(is_null($quotationCount))
                                                <tr>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->id }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->item_name }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$rfp->item_code)->first()->parent_id))->first()->name }}
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        @if($rfp->company_name_check == 1) {{ $rfp->business->business_name }} @else {{__('portal.N/A')}} @endif
                                                        {{--                                            {{ $rfp->business }}--}}
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->quantity }}
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        {{ $rfp->created_at->format('d-m-Y') }} <br>
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        @if ($rfp->file_path)
                                                            <a href="{{ Storage::url($rfp->file_path) }}">
                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                                </svg>
                                                            </a>
                                                        @else
                                                            {{__('portal.N/A')}}
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                                        <a href="{{ url('viewRFQs/'.$rfp->id) }}" class=" px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                            {{__('portal.Response')}}
                                                        </a>
                                                    </td>

                                                </tr>
                                            @else
                                                <div class="py-12">
                                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                                            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                                                                <div class="text-black text-2xl" style="text-align: center">
                                                                    {{__('portal.Your have reached daily generate quotation limit.')}}
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
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#quotation-table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });
    </script>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Quotations List')}} @if (!$collection->count()) {{__('portal.seems empty')}} @endif </h2>

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
                <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.New RFQ(s) response remaining for the day')}}: </h1>
                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$count}} </h1>
            </div>
        @endif
        <hr>

        <div class="bg-white">
            <nav class="flex flex-col sm:flex-row">
                <a href="{{ route('viewRFQs') }}" class="py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none {{ request()->routeIs('viewRFQs') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    {{__('portal.New')}}
                </a>
                <a href="{{ route('QoutedRFQQouted') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQQouted') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                    @php $quotedCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where([['qoute_status', 'Qouted'],['qoute_status_updated', null]])->count(); @endphp
                    {{__('portal.Quoted')}} <span class="text-red-400">({{$quotedCount}})</span>
                </a>
                <a href="{{ route('QuotedModifiedRFQ') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QuotedModifiedRFQ') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }} ">
                    @php $quotedCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1, 'qoute_status' => 'Modified'])->count(); @endphp
                    {{__('portal.Modified')}} <span class="text-red-400">({{$quotedCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQRejected') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQRejected') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $rejectedCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status_updated', 'Rejected')->count(); @endphp
                    {{__('portal.Rejected')}} <span class="text-red-400">({{$rejectedCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQModificationNeeded') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQModificationNeeded') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $modificationCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status_updated', 'ModificationNeeded')->count(); @endphp
                    {{__('portal.Modification needed')}} <span class="text-red-400">({{$modificationCount}})</span>
                </a>
                <a href="{{ route('QoutedRFQPendingConfirmation') }}" class=" py-4 px-6 block hover:text-blue-500 font-extrabold focus:outline-none  {{ request()->routeIs('QoutedRFQPendingConfirmation') ? 'text-blue-500 border-b-2 font-medium border-blue-500' : 'text-gray-500' }}">
                    @php $pendingCount = \App\Models\Qoute::where(['supplier_user_id' => auth()->user()->id, 'rfq_type' => 1])->where('qoute_status', 'RFQPendingConfirmation')->count(); @endphp
                    {{__('portal.Pending Confirmation')}} <span class="text-red-400">({{$pendingCount}})</span>
                </a>
            </nav>
        </div>
        @if ($collection->count())
            <div class="flex flex-col bg-white rounded ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <table class="min-w-full divide-y divide-gray-200" id="quotation-table">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.ID')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Category Name')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Company Name')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Quantity')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Requested On')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Action')}}
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
                                        @if(isset($quotationCount) && $quotationCount > 0)
                                            <tr>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->id }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ \App\Models\Category::where('id', $rfp->item_code)->first()->name_ar }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$rfp->item_code)->first()->parent_id))->first()->name_ar }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if($rfp->company_name_check == 1) {{ $rfp->business->business_name }} @else {{__('portal.N/A')}} @endif
                                                    {{--                                            {{ $rfp->business }}--}}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->quantity }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->created_at->format('d-m-Y') }} <br>
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if ($rfp->file_path)
                                                        <a href="{{ Storage::url($rfp->file_path) }}">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                    @else
                                                        {{__('portal.N/A')}}
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <a href="{{ url('viewRFQs/'.$rfp->id) }}" class="px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150" style="padding-top: 6px; padding-bottom: 5px;">
                                                        {{__('portal.Response')}}
                                                    </a>
                                                </td>

                                            </tr>
                                        @elseif(is_null($quotationCount))
                                            <tr>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->id }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ \App\Models\Category::where('id', $rfp->item_code)->first()->name_ar }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$rfp->item_code)->first()->parent_id))->first()->name_ar }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if($rfp->company_name_check == 1) {{ $rfp->business->business_name }} @else {{__('portal.N/A')}} @endif
                                                    {{--                                            {{ $rfp->business }}--}}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->quantity }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->created_at->format('d-m-Y') }} <br>
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if ($rfp->file_path)
                                                        <a href="{{ Storage::url($rfp->file_path) }}">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                            </svg>
                                                        </a>
                                                    @else
                                                        {{__('portal.N/A')}}
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <a href="{{ url('viewRFQs/'.$rfp->id) }}" class="px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150" style="padding-top: 6px; padding-bottom: 5px;">
                                                        {{__('portal.Response')}}
                                                    </a>
                                                </td>

                                            </tr>
                                        @else
                                            <div class="py-12">
                                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                                                            <div class="text-black text-2xl" style="text-align: center">
                                                                {{__('portal.Your have reached daily generate quotation limit.')}}
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
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#quotation-table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "language": {
                    "sSearch": "بحث:",
                    "oPaginate": {
                        "sFirst":    	"أولا",
                        "sPrevious": 	"السابق",
                        "sNext":     	"التالي",
                        "sLast":     	"الاخير"
                    },
                    "info": "عرض _PAGE_ ل _PAGES_ من _MAX_ المدخلات",
                },
            } );
        });
    </script>
@endif
