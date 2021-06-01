<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>
    @include('users.sessionMessage')

    <div class="mt-5" style="text-align: center;">
        <a href="{{ route('business.index', ['status' => 3]) }} " class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Complete Businesses
        </a>
        <a href="{{ route('business.index', ['status' => 1]) }} " class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Pending Businesses
        </a>
    </div>

    @if(isset($businesses))
        <div class="flex flex-col mt-2">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                        <div class="mt-5" style="text-align: center;">
                            <span class="inline-flex items-center justify-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:border-red-700 transition ease-in-out duration-150">
                                @if(isset($status) && $status == 1) List of Pending Businesses @else List of Complete Businesses @endif
                            </span>
                        </div>
                        <br>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr class="bg-green-500 text-center text-black font-bold">
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    Total Warehouse
                                </th>

                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    Business Status
                                </th>

                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    P.O Info
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    Legal Officer Status
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    Finance Officer Status
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($businesses as $business)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                        <a href="{{ route('business.show', $business->id) }}" class="hover:text-red-700 hover:underline text-black  md:text-blue-600">@if(isset($business->business_name)) {{ $business->business_name }} @else
                                                {{$business->name}} <br> {{$business->email}} @endif
                                        </a>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                        <a href="{{url('businessWarehouse/'. $business->id .'/show')}}" class="hover:underline text-blue-900 ">@if(isset($business->warehouse)) {{ $business->warehouse->count() }} @endif</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                        @if ($business->status == '3')
                                            Completed
                                        @else
                                            Incomplete
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                        @if(isset($business->poinfo))
                                            @foreach ($business->poinfo as $Puinfo)
                                                <a href="{{ route('purchaseOrderInfo.show', $Puinfo->id) }}" class="inline-flex items-center
                                                 justify-center px-4 py-2 text-blue-700 hover:underline" name=" approved">
                                                    PoInfo
                                                </a>
                                            @endforeach
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                        @if ($business->legal_status == 1)
                                            Pending
                                        @elseif ($business->legal_status == 3)
                                            Approved
                                        @elseif ($business->legal_status == 4)
                                            Rejected
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                        @if ($business->finance_status == 1)
                                            Pending
                                        @elseif ($business->finance_status == 3)
                                            Approved
                                        @elseif ($business->finance_status == 4)
                                            Rejected
                                        @endif
                                    </td>

                                    @if($business->status == 3)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            <span class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Accpected</span>
                                        </td>
                                    @elseif($business->status == 4)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            <span class="bg-purple-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Rejected</span>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                            <a class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 3])}}" style="transition: all .15s ease">
                                                Accept
                                            </a>
                                            <a class="bg-purple-500 text-white active:bg-purple-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" href="{{route('accountStatus', ['business_id' => $business->id, 'status_id' => 4])}}" style="transition: all .15s ease">
                                                Reject
                                            </a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        <span class="pl-4">{{ $businesses->withQueryString()->links() }}</span>
                    </div>
                </div>

            </div>

        </div>
    @else
        No Record
    @endif
</x-app-layout>
