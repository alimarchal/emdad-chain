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
        @if (session()->has('error'))
            <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('error') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-0 text-center m-5">{{__('portal.Cart')}} @if (!$eCart->count()) {{__('portal.seems empty')}} @endif </h2>

        @if ($eCart->count())
            @php $total = 0; @endphp
            {{--            <div class="flex flex-col bg-white rounded ">--}}
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200" id="cart">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{__('portal.Category Name')}}
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{__('portal.Brand')}}
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{__('portal.Description')}}
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{__('portal.Unit')}}
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{__('portal.Size')}}
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{__('portal.Quantity')}}
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{__('portal.Last Price')}}
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{__('portal.Delivery Period')}}
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{__('portal.Payment Mode')}}
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{__('portal.Remarks')}}
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider" title="{{__('portal.Display')}} {{auth()->user()->business->business_name}} {{__('portal.in the Requisition')}}">
                                    {{__('portal.Display Company Name')}}
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider" title="Attachment">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                        </path>
                                    </svg>
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    {{__('portal.Action')}}
                                </th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($eCart as $rfp)
                                <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @php
                                            $record = \App\Models\Category::where('id',$rfp->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp
                                        {{ $rfp->item_name }}, {{ $parent->name}}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $rfp->brand }}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ strip_tags($rfp->description) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
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
                                        {{ $rfp->delivery_period }}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $rfp->payment_mode }}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $rfp->remarks }}
                                    </td>

                                    <td class="px-3 py-3 text-center whitespace-nowrap">
                                        @if($rfp->company_name_check == 0) {{__('portal.No')}}
                                        @elseif($rfp->company_name_check == 1) {{__('portal.Yes')}}
                                        @endif
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
                                        <form method="POST" action="{{ route('single_cart_destroy', $rfp->id) }}" class="inline confirm" data-confirm = '{{__('portal.Are you sure you want to delete?')}}'>
                                            @csrf
                                            <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="{{__('portal.DELETE')}}">
                                                <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="orange">
                                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                                                    <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="p-4">
                <form action="{{ route('single_category_store') }}" method="POST">
                    @csrf
                    @foreach ($eCart as $rfp)
                        <input type="hidden" name="item_number[]" value="{{ $rfp->id }}">
                    @endforeach

                    <input type="hidden" value="{{ auth()->user()->business->id }}" name="business_id">
                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                    <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Select Ok to place requisition')}}'>
                        {{__('portal.Place RFQ')}}
                    </button>
                </form>
            </div>
            {{--            </div>--}}
        @endif


    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#cart').DataTable( {
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User List') }}
            </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block mt-2 text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ session('error') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <h2 class="text-2xl font-bold py-0 text-center m-5">{{__('portal.Cart')}} @if (!$eCart->count()) {{__('portal.seems empty')}} @endif </h2>

        @if ($eCart->count())
            @php $total = 0; @endphp
            {{--            <div class="flex flex-col bg-white rounded ">--}}
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200" id="cart">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Category Name')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Brand')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Description')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Unit')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Size')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Quantity')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Last Price')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Delivery Period')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Payment Mode')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Remarks')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider" title="{{__('portal.Display')}} {{auth()->user()->business->business_name}} {{__('portal.in the Requisition')}}">
                                        {{__('portal.Display Company Name')}}
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider" title="Attachment">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                            </path>
                                        </svg>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                        {{__('portal.Action')}}
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($eCart as $rfp)
                                <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @php
                                            $record = \App\Models\Category::where('id',$rfp->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp
                                        {{ $record->name_ar }}, {{ $parent->name_ar}}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $rfp->brand }}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ strip_tags($rfp->description) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
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
                                        @if($rfp->delivery_period =='Immediately') {{__('portal.Immediately')}}
                                        @elseif($rfp->delivery_period =='Within 30 Days') {{__('portal.30 Days')}}
                                        @elseif($rfp->delivery_period =='Within 60 Days') {{__('portal.60 Days')}}
                                        @elseif($rfp->delivery_period =='Within 90 Days') {{__('portal.90 Days')}}
                                        @elseif($rfp->delivery_period =='Standing Order - 2 per year') {{__('portal.Standing Order - 2 times / year')}}
                                        @elseif($rfp->delivery_period =='Standing Order - 3 per year') {{__('portal.Standing Order - 3 times / year')}}
                                        @elseif($rfp->delivery_period =='Standing Order - 4 per year') {{__('portal.Standing Order - 4 times / year')}}
                                        @elseif($rfp->delivery_period =='Standing Order - 6 per year') {{__('portal.Standing Order - 6 times / year')}}
                                        @elseif($rfp->delivery_period =='Standing Order - 12 per year') {{__('portal.Standing Order - 12 times / year')}}
                                        @elseif($rfp->delivery_period =='Standing Order Open') {{__('portal.Standing Order - Open')}}
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if($rfp->payment_mode == 'Cash')
                                            {{__('portal.Cash')}}
                                        @elseif($rfp->payment_mode == 'Credit')
                                            {{__('portal.Credit')}}
                                        @elseif($rfp->payment_mode == 'Credit30days')
                                            {{__('portal.Credit (30 Days)')}}
                                        @elseif($rfp->payment_mode == 'Credit60days')
                                            {{__('portal.Credit (60 Days)')}}
                                        @elseif($rfp->payment_mode == 'Credit90days')
                                            {{__('portal.Credit (90 Days)')}}
                                        @elseif($rfp->payment_mode == 'Credit120days')
                                            {{__('portal.Credit (120 Days)')}}
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $rfp->remarks }}
                                    </td>

                                    <td class="px-3 py-3 text-center whitespace-nowrap">
                                        @if($rfp->company_name_check == 0) {{__('portal.No')}}
                                        @elseif($rfp->company_name_check == 1) {{__('portal.Yes')}}
                                        @endif
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
                                        <form method="POST" action="{{ route('single_cart_destroy', $rfp->id) }}" class="inline confirm" data-confirm = '{{__('portal.Are you sure you want to delete?')}}'>
                                            @csrf
                                            <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="{{__('portal.DELETE')}}">
                                                <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="orange">
                                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                                                    <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="p-4">
                <form action="{{ route('single_category_store') }}" method="POST">
                    @csrf
                    @foreach ($eCart as $rfp)
                        <input type="hidden" name="item_number[]" value="{{ $rfp->id }}">
                    @endforeach

                    <input type="hidden" value="{{ auth()->user()->business->id }}" name="business_id">
                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                    <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150 confirm" data-confirm = '{{__('portal.Select Ok to place requisition')}}'>
                        {{__('portal.Place RFQ')}}
                    </button>
                </form>
            </div>
            {{--            </div>--}}
        @endif


    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#cart').DataTable( {
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

<script>

    $('.confirm').on('click', function (e) {
        return confirm($(this).data('confirm'));
    });
</script>
