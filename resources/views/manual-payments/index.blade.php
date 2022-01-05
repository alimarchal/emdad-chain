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
        <div class="py-6">
            <h2 class="text-2xl text-center font-bold pb-2">
                @if(auth()->user()->registration_type == 'Buyer')
                    {{__('portal.All Unpaid Invoices')}}
                @elseif(auth()->user()->registration_type == 'Supplier')
                    {{--                All invoices (through manual payments)--}}
                    {{__('portal.List of Unpaid invoices')}}
                @endif
            </h2>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-0 rounded-sm">
                        <table class="min-w-full divide-y divide-gray-200" id="manual-payments">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm text-center text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm text-center text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Invoice')}} #
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm text-center text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Invoice Date')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm text-center text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        @if(auth()->user()->registration_type == 'Buyer') {{__('portal.Supplier Business name')}} @elseif(auth()->user()->registration_type == 'Supplier') {{__('portal.Buyer Business name')}} @endif
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm text-center text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Requisition Type')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm text-center text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Status')}}
                                    </th>
                                    @if(auth()->user()->registration_type == 'Buyer')
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm text-center text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
{{--                                            @if(auth()->user()->registration_type == 'Buyer') {{__('portal.Claim')}} @elseif(auth()->user()->registration_type == 'Supplier') {{__('portal.Confirm')}} @endif {{__('portal.Manual Payment')}}--}}
                                             {{__('portal.Payment')}}
                                        </th>
                                    @endif
                                           {{--     @if(auth()->user()->registration_type == 'Supplier')
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Payments View
                                                    </th>
                                                @endif--}}
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($collection as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            @if (auth()->user()->registration_type == 'Buyer')
                                                @if($item->rfq_type == 1)
                                                    <a href="{{ route('invoice.show',$item->id) }}" class="text-blue-600 hover:underline">{{__('portal.Inv.')}}-{{$item->id}}</a>
                                                @elseif($item->rfq_type == 0)
                                                    <a href="{{ route('singleCategoryInvoiceShow',$item->id) }}" class="text-blue-600 hover:underline">{{__('portal.Inv.')}}-{{$item->id}}</a>
                                                @endif
                                            @elseif(auth()->user()->registration_type == 'Supplier')
                                                {{--                                        <a href="{{ route('invoice.show',$item->invoice_id) }}" class="text-blue-600 hover:underline" target="_blank">{{$item->invoice_id}}</a>--}}
                                                @if($item->rfq_type == 1)
                                                    <a href="{{ route('invoice.show',$item->id) }}" class="text-blue-600 hover:underline">{{__('portal.Inv.')}}-{{$item->id}}</a>
                                                @elseif($item->rfq_type == 0)
                                                    <a href="{{ route('singleCategoryInvoiceShow',$item->id) }}" class="text-blue-600 hover:underline">{{__('portal.Inv.')}}-{{$item->id}}</a>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            @if (auth()->user()->registration_type == 'Buyer')
                                                @php $invoiceDate = \App\Models\Invoice::where('id', $item->id)->first(); @endphp
                                            @elseif(auth()->user()->registration_type == 'Supplier')
                                                {{--@php $invoiceDate = \App\Models\Invoice::where('id', $item->invoice_id)->first(); @endphp--}}
                                                @php $invoiceDate = \App\Models\Invoice::where('id', $item->id)->first(); @endphp
                                            @endif
                                            {{\Carbon\Carbon::parse($item->created_at)->format('d-M-Y')}}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            @if(auth()->user()->registration_type == 'Buyer')
                                                @php $businessName = \App\Models\Business::where('id', $item->supplier_business_id)->first(); @endphp
                                            @elseif(auth()->user()->registration_type == 'Supplier')
                                                @php $businessName = \App\Models\Business::where('id', $item->buyer_business_id)->first(); @endphp
                                            @endif

                                            @if(isset($businessName->business_name)) {{$businessName->business_name}} @else <span class="text-center">--</span> @endif
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            @if($item->rfq_type == 1) {{__('portal.Multiple')}} @elseif($item->rfq_type == 0) {{__('portal.Single')}} @endif
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            @if (auth()->user()->registration_type == 'Buyer')
                                                @if ($item->invoice_status == '0') <span class="text-red-800">{{__('portal.Un-Paid')}}</span> @endif
                                            @elseif(auth()->user()->registration_type == 'Supplier')
                                                @if ($item->invoice_status == '0') <span class="text-red-800">{{__('portal.Un-Paid')}}</span> @endif
                                            @endif

                                        </td>
                                        @if (auth()->user()->registration_type == 'Buyer')

                                            <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                                @if($item->invoice_status == '0')
                                                    @if($item->rfq_type == 1)
                                                        <a href=" {{ route('bank-payments.create', $item->id) }} " class="text-blue-600 hover:underline">
                                                            {{__('portal.Proceed')}}
                                                        </a> |
                                                    @elseif($item->rfq_type == 0)
                                                        <a href=" {{ route('singleCategoryBankPaymentCreate', $item->rfq_no) }}" class="text-blue-600 hover:underline">
                                                            {{__('portal.Proceed')}}
                                                        </a> |
                                                    @endif
                                                @endif
                                                @if($item->invoice_status == '0')
                                                    <form action="{{route('getPaymentCheckOutId')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="invoice_id" value="{{$item->id}}">
                                                        <button type="submit" class="text-blue-600 hover:underline" target="_blank">
                                                            {{__('portal.Make Payment Online')}}
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif

                                      {{--  @if(auth()->user()->registration_type == 'Supplier')
                                            <td class="px-6 py-4 text-center whitespace-nowrap text-black">
                                                <a href="{{ route('bank-payments.show', $item->id) }}" class="text-blue-600 hover:underline" target="_blank">
                                                    View Payment
                                                </a>
                                            </td>
                                        @endif--}}

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#manual-payments').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });

    </script>
@else
    <x-app-layout>
        <div class="py-6">
            <h2 class="text-2xl text-center font-bold pb-2">
                @if(auth()->user()->registration_type == 'Buyer')
                    {{__('portal.All Unpaid Invoices')}}
                @elseif(auth()->user()->registration_type == 'Supplier')
                    {{--                All invoices (through manual payments)--}}
                    {{__('portal.List of Unpaid invoices')}}
                @endif
            </h2>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-0 rounded-sm">
                        <table class="min-w-full divide-y divide-gray-200" id="manual-payments">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Invoice')}} #
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Invoice Date')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        @if(auth()->user()->registration_type == 'Buyer') {{__('portal.Supplier Business name')}} @elseif(auth()->user()->registration_type == 'Supplier') {{__('portal.Buyer Business name')}} @endif
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Requisition Type')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
                                        {{__('portal.Status')}}
                                    </th>
                                    @if(auth()->user()->registration_type == 'Buyer')
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-sm font-medium text-gray-500 uppercase tracking-wider" style="background-color: #FCE5CD;">
{{--                                            @if(auth()->user()->registration_type == 'Buyer') {{__('portal.Claim')}} @elseif(auth()->user()->registration_type == 'Supplier') {{__('portal.Confirm')}} @endif {{__('portal.Manual Payment')}}--}}
                                            {{__('portal.Payment')}}
                                        </th>
                                    @endif
                                    {{--     @if(auth()->user()->registration_type == 'Supplier')
                                             <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                 Payments View
                                             </th>
                                         @endif--}}
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($collection as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center" style="font-family: sans-serif">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            @if (auth()->user()->registration_type == 'Buyer')
                                                @if($item->rfq_type == 1)
                                                    <a href="{{ route('invoice.show',$item->id) }}" class="text-blue-600 hover:underline" target="_blank">{{__('portal.Inv.')}}-<span style="font-family: sans-serif">{{$item->id}}</span> </a>
                                                @elseif($item->rfq_type == 0)
                                                    <a href="{{ route('singleCategoryInvoiceShow',$item->id) }}" class="text-blue-600 hover:underline" target="_blank">{{__('portal.Inv.')}}-<span style="font-family: sans-serif">{{$item->id}}</span> </a>
                                                @endif
                                            @elseif(auth()->user()->registration_type == 'Supplier')
                                                {{--                                        <a href="{{ route('invoice.show',$item->invoice_id) }}" class="text-blue-600 hover:underline" target="_blank">{{$item->invoice_id}}</a>--}}
                                                @if($item->rfq_type == 1)
                                                    <a href="{{ route('invoice.show',$item->id) }}" class="text-blue-600 hover:underline" target="_blank">{{__('portal.Inv.')}}-<span style="font-family: sans-serif">{{$item->id}}</span> </a>
                                                @elseif($item->rfq_type == 0)
                                                    <a href="{{ route('singleCategoryInvoiceShow',$item->id) }}" class="text-blue-600 hover:underline" target="_blank">{{__('portal.Inv.')}}-<span style="font-family: sans-serif">{{$item->id}}</span> </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            @if (auth()->user()->registration_type == 'Buyer')
                                                @php $invoiceDate = \App\Models\Invoice::where('id', $item->id)->first(); @endphp
                                            @elseif(auth()->user()->registration_type == 'Supplier')
                                                {{--@php $invoiceDate = \App\Models\Invoice::where('id', $item->invoice_id)->first(); @endphp--}}
                                                @php $invoiceDate = \App\Models\Invoice::where('id', $item->id)->first(); @endphp
                                            @endif
                                            <span style="font-family: sans-serif">{{\Carbon\Carbon::parse($item->created_at)->format('d-M-Y')}}</span>
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center" style="font-family: sans-serif">
                                            @if(auth()->user()->registration_type == 'Buyer')
                                                @php $businessName = \App\Models\Business::where('id', $item->supplier_business_id)->first(); @endphp
                                            @elseif(auth()->user()->registration_type == 'Supplier')
                                                @php $businessName = \App\Models\Business::where('id', $item->buyer_business_id)->first(); @endphp
                                            @endif

                                            @if(isset($businessName->business_name)) {{$businessName->business_name}} @else <span class="text-center">--</span> @endif
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            @if($item->rfq_type == 1) {{__('portal.Multiple')}} @elseif($item->rfq_type == 0) {{__('portal.Single')}} @endif
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                            @if (auth()->user()->registration_type == 'Buyer')
                                                @if ($item->invoice_status == '0') <span class="text-red-800">{{__('portal.Un-Paid')}}</span> @endif
                                            @elseif(auth()->user()->registration_type == 'Supplier')
                                                @if ($item->invoice_status == '0') <span class="text-red-800">{{__('portal.Un-Paid')}}</span> @endif
                                            @endif

                                        </td>
                                        @if (auth()->user()->registration_type == 'Buyer')

                                            <td class="px-6 py-4 text-center whitespace-nowrap text-black text-center">
                                                @if($item->invoice_status == '0')
                                                    @if($item->rfq_type == 1)
                                                        <a href=" {{ route('bank-payments.create', $item->id) }} " class="text-blue-600 hover:underline">
                                                            {{__('portal.Proceed')}}
                                                        </a> |
                                                    @elseif($item->rfq_type == 0)
                                                        <a href=" {{ route('singleCategoryBankPaymentCreate', $item->rfq_no) }}" class="text-blue-600 hover:underline">
                                                            {{__('portal.Proceed')}}
                                                        </a> |
                                                    @endif
                                                @endif
                                                @if($item->invoice_status == '0')
                                                    <form action="{{route('getPaymentCheckOutId')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="invoice_id" value="{{$item->id}}">
                                                        <button type="submit" class="text-blue-600 hover:underline" target="_blank">
                                                            {{__('portal.Make Payment Online')}}
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif

                                        {{--  @if(auth()->user()->registration_type == 'Supplier')
                                              <td class="px-6 py-4 text-center whitespace-nowrap text-black">
                                                  <a href="{{ route('bank-payments.show', $item->id) }}" class="text-blue-600 hover:underline" target="_blank">
                                                      View Payment
                                                  </a>
                                              </td>
                                          @endif--}}

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        $(document).ready(function() {
            $('#manual-payments').DataTable( {
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
