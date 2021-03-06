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
                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
            </button>
        </div>
    @endif
 {{--    <h2 class="text-2xl font-bold py-2 text-center m-15">Items List @if (!$collection->count()) seems empty @endif
    </h2> --}}


     <!-- This example requires Tailwind CSS v2.0+ -->
        @php $total = 0; @endphp
        <div class="flex flex-col bg-white rounded ">
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
                                    Role Name
                                </th>

                             

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                                              </td>
                               <td class="px-6 py-4 whitespace-nowrap">
                                    
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                       <a href="{{route('role.update')}}" class="hover:text-blue-900 hover:underline text-blue-900"></a>
                                    </td>

                                  {{--  <td>
                
                            <a href="{{route('edit',$role->id)}} ">Edit</a>
             <i class="fas fa-user-edit">    </i>
                                   </td> --}}


                                </tr>

                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    <div class="mt-5">
        <a href="{{route('PlacedRFQ.index')}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Back
        </a>
         <a href="{{route('role.create')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Add new Role
        </a>
    </div>

    <div class="mt-5">
       
    </div>
   


</x-app-layout>
