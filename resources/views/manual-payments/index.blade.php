<x-app-layout>
    <div class="py-6">
        <h2 class="text-2xl text-center font-bold pb-2">
            @if(auth()->user()->registration_type == 'Buyer')
            All Unpaid Invoices
            @elseif(auth()->user()->registration_type == 'Supplier')
            All invoices (through manual payments)
            @endif
        </h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('users.sessionMessage')
            <!-- component -->

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-0 rounded-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Invoice Number
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Invoice Date
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    @if(auth()->user()->registration_type == 'Buyer') Supplier Business name @elseif(auth()->user()->registration_type == 'Supplier') Buyer Business name @endif
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                @if(auth()->user()->registration_type == 'Buyer')
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    @if(auth()->user()->registration_type == 'Buyer') Claim @elseif(auth()->user()->registration_type == 'Supplier') Confirm @endif manual payment
                                </th>
                                @endif
                                @if(auth()->user()->registration_type == 'Supplier')
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Payments View
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($collection as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-black text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-black text-center">
                                    @if (auth()->user()->registration_type == 'Buyer')
                                        <a href="{{ route('invoice.show',$item->id) }}" class="text-blue-600 hover:underline" target="_blank">{{$item->id}}</a>
                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                        <a href="{{ route('invoice.show',$item->invoice_id) }}" class="text-blue-600 hover:underline" target="_blank">{{$item->invoice_id}}</a>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-black text-center">
                                    @if (auth()->user()->registration_type == 'Buyer')
                                        @php $invoiceDate = \App\Models\Invoice::where('id', $item->id)->first(); @endphp
                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                         @php $invoiceDate = \App\Models\Invoice::where('id', $item->invoice_id)->first(); @endphp
                                    @endif
                                    {{\Carbon\Carbon::parse($item->created_at)->format('d-M-Y')}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-black text-center">
                                    @if(auth()->user()->registration_type == 'Buyer')
                                        @php $businessName = \App\Models\Business::where('id', $item->supplier_business_id)->first(); @endphp
                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                        @php $businessName = \App\Models\Business::where('id', $item->buyer_business_id)->first(); @endphp
                                    @endif

                                    {{$businessName->business_name}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-black text-center">
                                    @if (auth()->user()->registration_type == 'Buyer')
                                        @if ($item->invoice_status == '0')
                                            Un-Paid
                                        @elseif ($item->invoice_status == '1')
                                            Supplier Verification Pending
                                        @elseif ($item->invoice_status == '2')
                                            Supplier Rejected
                                        @elseif ($item->invoice_status == '3')
                                            Supplier Confirmed
                                        @endif
                                    @elseif(auth()->user()->registration_type == 'Supplier')
                                        @if ($item->status == '0')
                                            Un-Paid
                                        @elseif ($item->status == '1')
                                            Verification Pending
                                        @elseif ($item->status == '2')
                                            Rejected
                                        @elseif ($item->status == '3')
                                            Confirmed
                                        @endif
                                    @endif

                                </td>
                                @if (auth()->user()->registration_type == 'Buyer')

                                <td class="px-6 py-4 whitespace-nowrap text-black text-center">
{{--                                    @if (auth()->user()->registration_type == 'Buyer')--}}
{{--                                        <a href="@if($item->status == '0') {{ route('bank-payments.create', $item->id) }} @endif" class="text-blue-600 hover:underline" target="_blank">--}}
{{--                                    @elseif(auth()->user()->registration_type == 'Supplier')--}}
{{--                                        <a href="@if($item->status == '0') {{ route('bank-payments.create', $item->invoice_id) }} @endif" class="text-blue-600 hover:underline" target="_blank">--}}
{{--                                    @endif--}}
                                        <a href="@if($item->invoice_status == '0') {{ route('bank-payments.create', $item->id) }} @endif" class="text-blue-600 hover:underline" target="_blank">
                                         Proceed
                                        </a>
                                </td>
                                @endif

                               @if(auth()->user()->registration_type == 'Supplier')
                                    <td class="px-6 py-4 whitespace-nowrap text-black">
                                        <a href="{{ route('bank-payments.show', $item->id) }}" class="text-blue-600 hover:underline" target="_blank">
                                            View Payment
                                        </a>
                                    </td>
                                @endif

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
