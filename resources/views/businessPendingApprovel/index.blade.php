<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
            <strong class="mr-1">{{ session('message') }}</strong>
            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-blue-900" aria-hidden="true">×</span>
            </button>
        </div>
    @endif


  
        
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
                                        City
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

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $business->business_name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{  $business->business_type }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{  $business->city }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                           
@if($business->status ==1)         
         {{--      <a href="{{route('business.update', $business->id)}} " value="approve" class="w-20 flex items-center justify-center rounded-md  text-white bg-red-500 hover:bg-red-700 ..." type="submit">Approve</a> --}}
{{-- <form action="{{route('businessupdate',$business->id)}} " method="post">
    @csrf
 @method('PATCH')
  
    <input type="hidden" name="status" value="approve">
     <button class="w-20 flex items-center justify-center rounded-md bg-red-500 text-white" type="submit">Approve</button> 

</form> --}}
      {{--   <a href="{{route('aprovestatus',$business->id)}}">Update</a> --}}

<a href="{{ route('businessApprovalUpdate', $business->id) }}"  class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-600 transition ease-in-out duration-150">
                                Approve
                            </a>
                            <a href="{{ route('businessApprovalRejected', $business->id) }}"  class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Reject
                            </a>
{{-- 
<a href="{{ route('businessUpdate', $business->id) }}" class="btn btn-info">Update</a> --}}



 @elseif($business->status=='')

      <button class="w-20 flex items-center justify-center rounded-md bg-blue-500 text-white" type="submit">Null status</button> 

@else
      {{ $business->status }}     
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
