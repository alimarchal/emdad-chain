<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payments') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold py-2 text-center m-2">Payments to supplier history</h2>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">{{ session('message') }}</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                @if ($payments->count())

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
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Invoice #
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Bank Name
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount Received
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount to pay
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date Deposited
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Buyer Business Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Supplier Business Name
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Delivery Status
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>

                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                View
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-black">
                                                        {{ $payment->invoice_id }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $payment->bank_name }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        {{ number_format($payment->amount_received,2,'.') }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @php
                                                         // Calculating and Subtracting 1.5 % emdad charges that is applied to supplier payment
                                                        $dpo = \App\Models\DraftPurchaseOrder::where('id', $payment->draft_purchase_order_id)->first();
                                                        $total_amount = ($dpo->quantity * $dpo->unit_price) + $dpo->shipment_cost;
                                                        $emdadCharges = ($total_amount * (1.5 / 100));
                                                        $total_vat = ($total_amount * ($dpo->vat / 100));
                                                        $sum = ($total_amount + $total_vat) - $emdadCharges ;
                                                        @endphp
                                                        {{ number_format($sum,2,'.') }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        {{ Carbon\Carbon::parse($payment->amount_date)->format('d-m-Y') }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @php $buyerBusinessName = \App\Models\Business::where('id',$payment->buyer_business_id)->first(); @endphp
                                                        {{$buyerBusinessName->business_name}}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @php $supplierBusinessName = \App\Models\Business::where('id',$payment->supplier_business_id)->first(); @endphp
                                                        {{$supplierBusinessName->business_name}}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @php $delivery = \App\Models\Delivery::where('id',$payment->delivery_id)->first(); @endphp
                                                        @if(isset($delivery->status) == 1)
                                                            Delivered
                                                        @elseif(isset($delivery->status) == 2)
                                                            Assigned
                                                        @elseif(isset($delivery->status) == 3)
                                                            On the Way
                                                        @elseif(isset($delivery->status) == 4)
                                                            Returned
                                                        @elseif(isset($delivery->shipment_status) == 0)
                                                            Not Delivered
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @if($payment->supplier_payment_status == 0)
                                                            Un-paid
                                                        @elseif($payment->supplier_payment_status == 1)
                                                            Verification pending
                                                        @elseif($payment->supplier_payment_status == 2)
                                                            Rejected
                                                        @elseif($payment->supplier_payment_status == 3)
                                                            Confirmed
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @if(isset($delivery->status) == 1)
                                                            <a href="{{ route('admin_supplier_payment_view',$payment->id) }}" class="hover:underline hover:text-blue-800 text-blue-500" target="_blank">
                                                                <svg class="w-6 h-6 inline" fill="none" stroke="red"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                    </path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
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
