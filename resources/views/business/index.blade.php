<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

   

@include('users.sessionMessage')

  <div class="mt-5" style="text-align: center;">
        <a href="{{route('business.index','status=1')}} " class="inline-flex items-center justify-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white 
        uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 
        focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150" 
        name="pproved">
           Pending businesses
        </a>
        <a href="{{route('business.index','status=Approved')}} " class="inline-flex items-center justify-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150" name="pproved">
            Show all approved business
        </a>
         <a href="{{route('business.index','status=Rejected')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Show all rejected business
        </a>
    </div>

        <div class="flex flex-col bg-white rounded " style="margin-top: 15px;">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Business Name
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Business type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Country
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        City
                                    </th>
                                     <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Number of warehouse
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Action For Business Approval
                                    </th>





                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($businesses as $business)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap ">
                              
      <a href="{{route('business.show',$business->id)}}" class="text-white hover:text-red-700  md:text-blue-600" name="name"> {{ $business->business_name }}
                             </a>
    

                        

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{  $business->business_type }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{  $business->country }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{  $business->city }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{  $business->num_of_warehouse }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">

@if($business->status ==1)
   
{{-- businessApprovalUpdate--}}

{{-- <a href="{{ route('businessApprovalUpdate', $business->id) }}"  class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150" name="status">
                                Approve
                            </a>
                            <a href="{{ route('businessApprovalRejected', $business->id) }}"  class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150" name="status ">
                                Reject
                            </a> --}}

                            <div class="flex justify-center rounded-lg text-lg mb-3" role="group">
    <a href="{{ route('business.index','changestatus'.'='. $business->id) }}" class="bg-blue-500 text-white hover:bg-blue-400 rounded-l-lg px-4 py-2 mx-0 outline-none focus:shadow-outline">Approve</a>
    <a href="{{ route('business.index','rejectstatus'.'='. $business->id) }}" class="bg-red-500 text-white hover:bg-blue-400  px-4 py-2 mx-0 outline-none focus:shadow-outline">Reject</a>
    
  </div>

 @elseif($business->status=='')

     {{--  <button class="w-20 flex items-center justify-center rounded-md bg-blue-500 text-white" type="submit">Null status</button> --}}
 @elseif($business->status=='Rejected')

    <button class="w-70 h-10 flex items-center justify-center rounded-md bg-pink-800 text-white p-5" type="submit">Business Rejected</button>

@else
       <button class="w-70 h-10 flex items-center justify-center rounded-md bg-yellow-300 text-white p-5" type="submit">Business Approved</button>
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
