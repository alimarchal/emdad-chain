<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>
    @include('users.sessionMessage')

    <div class="mt-5" style="text-align: center;">
        <a href="{{ route('business.index', ['status' => 1]) }} " class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Complete Businesses
        </a>
        <a href="{{ route('business.index', ['status' => 2]) }} " class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Incomplete Businesses
        </a>
    </div>

    @if(isset($businesses))
        <div class="flex flex-col mt-2">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                        <div class="mt-5" style="text-align: center;">
                            <span class="inline-flex items-center justify-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:border-red-700 transition ease-in-out duration-150">
                                List of Complete Businesses
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
                                    Status
                                </th>

                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    P.O Info
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

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        <span class="pl-4">{{ $businesses->withQueryString()->links() }}</span>
                    </div>
                </div>

            </div>

        </div>
    @elseif(isset($users))
        <div class="flex flex-col mt-2">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                        <div class="mt-5" style="text-align: center;">
                            <span class="inline-flex items-center justify-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:border-red-700 transition ease-in-out duration-150">
                                List of Incomplete Businesses
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
                                    Email
                                </th>

                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black text-center uppercase tracking-wider">
                                    Mobile
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                        <span class="text-black  md:text-blue-600">{{ $user->name }}</span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black text-center">
                                        <span class="text-blue-900 ">{{ $user->email }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-900 text-center">
                                        <span class="text-blue-900 ">{{ $user->mobile }}</span>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        <span class="pl-4">{{ $users->withQueryString()->links() }}</span>
                    </div>
                </div>

            </div>

        </div>
    @else
        No Record
    @endif
</x-app-layout>