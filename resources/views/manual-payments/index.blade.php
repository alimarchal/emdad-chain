<x-app-layout>
    <div class="py-6">
        <h2 class="text-2xl text-center font-bold pb-2">All Invoices</h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('users.sessionMessage')
            <!-- component -->
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-0 rounded-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Invoice Number
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Upload Paid Invoice Amount
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
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
                                <td class="px-6 py-4 whitespace-nowrap text-black">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-black">
                                    <a href="{{ route('invoice.show',$item->id) }}" class="text-blue-600 hover:underline" target="_blank">Show Invoice</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-black">
                                    <a href="@if($item->status == '0') {{ route('bank-payments.create', $item->id) }} @endif" class="text-blue-600 hover:underline" target="_blank">
                                        Upload Informations
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-black">
                                    @if ($item->status == '0')
                                        Un-Paid
                                    @elseif ($item->status == '1')
                                        Supplier Verification Pending
                                    @elseif ($item->status == '2')
                                        Supplier Rejected
                                    @elseif ($item->status == '3')
                                        Supplier Confirmed
                                    @endif
                                </td>
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
