
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Proforma Invoices') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold py-2 text-center m-2">Invoices History</h2>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">{{ session('message') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if ($proformaInvoices->count())
                    <!-- This example requires Tailwind CSS v2.0+ -->
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    #
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Delivery Note
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    P.O.
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Category Name
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    P.O Date
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    @if (auth()->user()->registration_type == 'Buyer')
                                                        Claim manual payment
                                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                                        Payment Status
                                                    @endif
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    View
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($proformaInvoices as $dn)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        Note-{{ $dn->id }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                      PO-{{ $dn->purchase_order->id }}
                                                    </td>


                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                       {{ $dn->purchase_order->item_name }}
                                                        {{-- <a href="{{ route('po.show', $dn->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{ $dn->item_name }}</a> --}}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                       {{ Carbon\Carbon::parse($dn->purchase_order->po_date)->format('d-m-Y') }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        @if (auth()->user()->registration_type == 'Buyer')
                                                            @if ($dn->invoice_status == 0)
                                                                Waiting for payment
                                                            @elseif($dn->invoice_status == 1)
                                                                Waiting for Emdad confirmation
                                                            @elseif($dn->invoice_status == 3)
                                                                Manual payment Confirmed
                                                            @else
                                                                Payment rejected
                                                            @endif
                                                        @elseif(auth()->user()->registration_type == 'Supplier')
                                                            @if ($dn->invoice_status == 0)
                                                                Waiting for payment
                                                            @elseif($dn->invoice_status == 1)
                                                                Waiting for confirmation
                                                            @elseif($dn->invoice_status == 3)
                                                                Create Delivery Note
                                                            @else
                                                                Payment rejected
                                                            @endif
                                                        @else
                                                            N/A
                                                        @endif

                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">

                                                    @if (auth()->user()->registration_type == 'Buyer')
                                                        @if($dn->invoice_status == '0' || $dn->invoice_status == '2')
                                                            @if($dn->invoice_status == '0')
                                                                <a href=" {{ route('bank-payments.create', $dn->id) }}" class="text-blue-600 hover:underline" target="_blank">
                                                                    Manual Payment
                                                                </a> |

                                                                    <form action="{{route('invoicePayment.stepOne')}}" method="POST" >
                                                                        @csrf
                                                                        <input type="hidden" name="invoice_id" value="{{$dn->id}}">
                                                                        <button class="text-blue-600 hover:underline">Online Payment</button>
                                                                    </form>


                                                            @elseif($dn->invoice_status == '2')
                                                                <a href=" {{ route('bank-payments.edit', $dn->id) }}" class="text-blue-600 hover:underline" target="_blank">
                                                                    Proceed
                                                                </a>
                                                            @endif
                                                        @elseif($dn->invoice_status == '1')
                                                            Emdad verification pending
                                                        @elseif($dn->invoice_status == '2')
                                                            Emdad rejected manual payment
                                                        @elseif($dn->bankPayment->supplier_payment_status == 3)
                                                            Payment received by supplier
                                                        @elseif($dn->invoice_status == '3')
                                                            Payment in Transit, on hold, with Emdad
                                                        @endif

                                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                                        @if($dn->invoice_status == '0')
                                                            Waiting for payment
                                                        @elseif($dn->invoice_status == '1')
                                                        @php $bankPaymentId = \App\Models\BankPayment::where('invoice_id', $dn->id)->first(); @endphp
{{--                                                        <a href="{{ route('bank-payments.show', $bankPaymentId->id) }}" class="text-blue-600 hover:underline" target="_blank">--}}
{{--                                                            View Payment--}}
                                                            Emdad verification pending
                                                        @elseif($dn->invoice_status == '2')
                                                            Manual payment rejected
                                                        @elseif($dn->invoice_status == '3')
                                                            Payment in Transit, Received by Emdad
                                                        @endif
                                                    @endif


                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        <a href="{{ route('invoiceView',$dn->id) }}" class="hover:underline hover:text-blue-800 text-blue-500">View</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <!-- More rows... -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>

                    @else
                        <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">No record found...!</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                </div>


            </div>
        </div>


    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Proforma Invoices') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">{{ session('message') }}</strong>
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if ($proformaInvoices->count())
                    <!-- This example requires Tailwind CSS v2.0+ -->
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    #
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    تذكرة التوصيل
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    أمر شراء
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    اسم المنتج
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    تاريخ أمر الشراء
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    الحالة
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    معاينة
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($proformaInvoices as $dn)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        Note-{{ $dn->id }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        PO-{{ $dn->purchase_order->id }}
                                                    </td>


                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $dn->purchase_order->item_name }}
                                                        {{-- <a href="{{ route('po.show', $dn->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{ $dn->item_name }}</a> --}}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ Carbon\Carbon::parse($dn->purchase_order->po_date)->format('d-m-Y') }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        @if ($dn->status == 0)
                                                            بانتظار الدفع
                                                        @else
                                                            إنشاء مذكرة توصيل
                                                        @endif

                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        View
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <!-- More rows... -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>

                    @else
                        <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-1">No record found...!</strong> Something seriously bad happened...
                            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                </div>


            </div>
        </div>


    </x-app-layout>
@endif
