@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Payments') }} </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Manual Payments History')}}</h2>
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
                                                    {{__('portal.User name')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.Email ID')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.B.Type')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.Package Type')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.Amount Received')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.Date Deposited')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.Status')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.View')}}
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
                                                        {{ $payment->user->name }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                                        {{ $payment->user->email }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @if($payment->business_type == 1)
                                                            {{__('portal.Buyer')}}
                                                        @elseif($payment->business_type == 2)
                                                            {{__('portal.Supplier')}}
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @if($payment->package->id == 1 || $payment->package->id == 5) {{__('portal.Basic')}}@endif
                                                        @if($payment->package->id == 2 || $payment->package->id == 6) {{__('portal.Silver')}}@endif
                                                        @if($payment->package->id == 3 || $payment->package->id == 7) {{__('portal.Gold')}}@endif
                                                        @if($payment->package->id == 4) {{__('portal.Platinum')}}@endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        {{ $payment->amount_received }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        {{ Carbon\Carbon::parse($payment->amount_date)->format('d-m-Y') }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @if($payment->status == 0)
                                                            <span class="text-yellow-400">{{__('portal.Verification pending')}}</span>
                                                        @elseif($payment->status == 1)
                                                            <span class="text-green-500">{{__('portal.Confirmed')}}</span>
                                                        @elseif($payment->status == 2)
                                                            <span class="text-red-600">{{__('portal.Rejected')}}</span>
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        <a href="{{ route('packageManualPaymentView', $payment->id) }}" class="hover:underline hover:text-blue-800 text-blue-500">
                                                            <svg class="w-6 h-6 inline" fill="none" stroke="red"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                </path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                </path>
                                                            </svg>
                                                        </a>
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
                            <strong class="mr-1">{{__('portal.No record found...!')}}</strong>
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Payments') }} </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold py-2 text-center m-2">{{__('portal.Manual Payments History')}}</h2>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <strong class="mr-3">{{ session('message') }}</strong>
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
                                                    {{__('portal.User name')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.Email ID')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.B.Type')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.Package Type')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.Amount Received')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.Date Deposited')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.Status')}}
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{__('portal.View')}}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black" style="font-family: sans-serif">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-black" style="font-family: sans-serif">
                                                        {{ $payment->user->name }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black" style="font-family: sans-serif">
                                                        {{ $payment->user->email }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @if($payment->business_type == 1)
                                                            {{__('portal.Buyer')}}
                                                        @elseif($payment->business_type == 2)
                                                            {{__('portal.Supplier')}}
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @if($payment->package->id == 1 || $payment->package->id == 5) {{__('portal.Basic')}}@endif
                                                        @if($payment->package->id == 2 || $payment->package->id == 6) {{__('portal.Silver')}}@endif
                                                        @if($payment->package->id == 3 || $payment->package->id == 7) {{__('portal.Gold')}}@endif
                                                        @if($payment->package->id == 4) {{__('portal.Platinum')}}@endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black" style="font-family: sans-serif">
                                                        {{ $payment->amount_received }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black" style="font-family: sans-serif">
                                                        {{ Carbon\Carbon::parse($payment->amount_date)->format('d-m-Y') }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        @if($payment->status == 0)
                                                            <span class="text-yellow-400">{{__('portal.Verification pending')}}</span>
                                                        @elseif($payment->status == 1)
                                                            <span class="text-green-500">{{__('portal.Confirmed')}}</span>
                                                        @elseif($payment->status == 2)
                                                            <span class="text-red-600">{{__('portal.Rejected')}}</span>
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-black">
                                                        <a href="{{ route('packageManualPaymentView', $payment->id) }}" class="hover:underline hover:text-blue-800 text-blue-500">
                                                            <svg class="w-6 h-6 inline" fill="none" stroke="red"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                </path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                </path>
                                                            </svg>
                                                        </a>
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
                            <strong class="mr-1">{{__('portal.No record found...!')}}</strong>
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
