<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    
    @include('users.sessionMessage')

    <div class="mt-5" style="text-align: center;">
        
        <a href="{{ route('business.index', 'status=1') }} " class="inline-flex items-center justify-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white 
        uppercase tracking-widest hover:bg-pink-200 focus:outline-none focus:border-red-700 
        focus:shadow-outline-red active:bg-pink-600 transition ease-in-out duration-150" name="pproved">
            Pending
        </a>

        <a href="{{ route('business.index', 'status=3') }} " class="inline-flex items-center 
        justify-center px-4 py-2 bg-yellow-400 bg-opacity-75 border border-transparent rounded-md font-semibold 
        text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none 
        focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out 
        duration-150" name="pproved">
            Approved
        </a>
        <a href="{{ route('business.index', 'status=4') }}" class="inline-flex items-center 
         justify-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold
          text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none 
          focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out 
          duration-150">
            Rejected
        </a>
    </div>

    <div class="flex flex-col bg-white rounded " style="margin-top: 15px;">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr class="bg-green-500 text-center text-black font-bold">
                                <th scope="col" class="px-6 py-3 text-xs  tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs  tracking-wider">
                                    Name
                                </th>

                                <th scope="col" class="px-6 py-3 text-xs  tracking-wider">
                                    Business type
                                </th>


                                <th scope="col" class="px-6 py-3 text-xs tracking-wider">
                                    Warehouses
                                </th>
                               
                                <th scope="col" class="px-6 py-3 text-xs tracking-wider">
                                    PurchaseOrderInfo

                                </th>
                                <th scope="col" class="px-6 py-3 text-xs tracking-wider">
                                    Action
                                </th>





                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($businesses as $business)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap  bg-pink-400 text-center">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="hover:bg-pink-200 px-6 py-4 whitespace-nowrap bg-green-200 text-center">

                                        <a href="{{ route('business.show', $business->id) }}" 
                                            class="text-white hover:text-red-700  md:text-blue-600" name="name"> {{ $business->business_name }}
                                        </a>

                                    </td>

                                    <td class="bg-green-400 text-center px-6 py-4 whitespace-nowrap">
                                        {{ $business->business_type }}
                                    </td>

                                    
                                    <td class="px-6 py-4 whitespace-nowrap bg-blue-100">
                                        @foreach($business->warehouse as $warehouse) 
                                       
                                      <a href="{{ route('businessWarehouseShow', $warehouse->id) }}" 
                                        class="text-blue-700 hover:underline">  {{ $warehouse->name }}</a> ,<br>
                                   
                                        @endforeach
                                    </td>
                                    <td class="bg-indigo-600 bg-opacity-25 text-center">
                                        @foreach($business->poinfo as $Puinfo)
                                        <a href="{{ route('purchaseOrderInfo.show', $Puinfo->id)}}" class="inline-flex items-center
                                             justify-center px-4 py-2 text-blue-700 hover:underline" name="pproved">
                                           PoInfo
                                               </a>
                                               @endforeach
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap bg-green-200 text-center">

                                        @if ($business->status == 1)

                                            {{-- businessApprovalUpdate --}}

                                            {{-- <a href="{{ route('businessApprovalUpdate', $business->id) }}"  class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150" name="status">
                                Approve
                            </a>
                            <a href="{{ route('businessApprovalRejected', $business->id) }}"  class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150" name="status ">
                                Reject
                            </a> --}}

                                            <div class="flex justify-center rounded-lg text-lg mb-3" role="group">
                                                <a href="{{ route('business.index', 'changestatus' . '=' . $business->id) }}" class="bg-blue-500 text-white hover:bg-blue-400 rounded-l-lg px-4 py-2 mx-0 outline-none focus:shadow-outline">Approve</a>
                                                <a href="{{ route('business.index', 'rejectstatus' . '=' . $business->id) }}" class="bg-red-500 text-white hover:bg-blue-400  px-4 py-2 mx-0 outline-none focus:shadow-outline">Reject</a>

                                            </div>

                                        @elseif($business->status=='')

                                            {{-- <button class="w-20 flex items-center justify-center rounded-md bg-blue-500 text-white" type="submit">Null status</button> --}}
                                        @elseif($business->status==4)

                                            <button class="w-70 h-10 flex items-center justify-center rounded-md bg-pink-800 text-white p-5" type="submit"> Rejected</button>

                                        @else
                                            <button class="w-70 h-10 flex items-center justify-center rounded-md bg-yellow-300 text-white p-5" type="submit"> Approved</button>
                                        @endif



                                    </td>
                                 



                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>

    </div>
    </div>







</x-app-layout>
