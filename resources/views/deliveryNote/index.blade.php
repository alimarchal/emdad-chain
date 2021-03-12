@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Draft Purchase Orders') }}
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
                    {{--                    <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">--}}
                    {{--                        <a href="{{route('generatePDF')}}"--}}
                    {{--                           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">--}}
                    {{--                            Generate PDF--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    @if ($dpos->count())
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
                                                    Order Number
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Item Name
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    P.O Date
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    P.O Type
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($dpos as $dpo)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        EMDAD-{{ $dpo->id }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{--                                                    <a href="{{ route('deliveryNoteView',$dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{ $dpo->item_name }}</a>--}}
                                                        {{ $dpo->item_name }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $dpo->po_date }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $dpo->payment_term }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        @if($dpo->payment_term == 'Cash' || auth()->user()->can('all') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                                                            @php $proformaInvoice = \App\Models\Invoice::where('draft_purchase_order_id', $dpo->id)->where('invoice_type', 1)->first(); @endphp
                                                            @if (isset($proformaInvoice) && $proformaInvoice->invoice_status == 3)
                                                                <a>Create delivery Note</a>
                                                            @elseif(isset($proformaInvoice))
                                                                <a>Proforma invoice generated</a>
                                                            @else
                                                                <a href="{{route('generateProforma', $dpo->id)}}" class="text-blue-900 hover:underline">Generate proforma invoice</a>
                                                            @endif
                                                        @else
                                                            {{--                                                            <a>Completed</a>--}}
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        <a class="hover:text-blue-900 hover:underline text-blue-900">{{$dpo->status}}</a>
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        <a href="{{ route('deliveryNoteView',$dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">View</a>
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
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Draft Purchase Orders') }}
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
                    @if ($dpos->count())
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
                                                    رقم الطلب
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    اسم المنتج
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    تاريخ أمر الشراء
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    نوع أمر الشراء
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    الحالة
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    الحالة
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($dpos as $dpo)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        EMDAD-{{ $dpo->id }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{--                                                    <a href="{{ route('deliveryNoteView',$dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{ $dpo->item_name }}</a>--}}
                                                        {{ $dpo->item_name }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $dpo->po_date }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $dpo->payment_term }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        @if($dpo->payment_term == 'Cash' || auth()->user()->can('all') && auth()->user()->registration_type == 'Supplier' && auth()->user()->status == 3)
                                                            @php $proformaInvoice = \App\Models\ProformaInvoice::where('draft_purchase_order_id', $dpo->id)->first(); @endphp
                                                            @if (isset($proformaInvoice))
                                                                <a>Proforma invoice generated</a>
                                                            @else
                                                                <a href="{{route('generateProforma', $dpo->id)}}" class="text-blue-900 hover:underline">إنشاء فاتورة أولية</a>
                                                            @endif
                                                        @else
                                                            {{--                                                            <a>Completed</a>--}}
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        <a class="hover:text-blue-900 hover:underline text-blue-900">{{$dpo->status}}</a>
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        <a href="{{ route('deliveryNoteView',$dpo->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">View</a>
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
