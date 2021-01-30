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
    @if ($message = Session::get('success'))
<div class="alert alert-success alert-block flex flex-col bg-green rounded" id="alermessage">
    
        <strong>{{ $message }}</strong>
</div>
@endif
<script>

    $(document).ready(function(){
          $('#alermessage').delay(2000).hide(0); 
    });

    </script>


    <div class="mt-5" style="text-align: center;">
        <a href="/dashboard" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Back
        </a>
         <a href="{{route('role.create')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Add new Role
        </a>
    </div>


     <!-- This example requires Tailwind CSS v2.0+ -->
        @php $total = 0; @endphp
        <div class="flex flex-col bg-white rounded " style="margin-top: 20px;">
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
                               @foreach($roles as $role)                                    </td>
                               <td class="px-6 py-4 whitespace-nowrap">
                                       {{$loop->iteration}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                       <a href="{{route('role.edit',$role->id)}}" class="hover:text-blue-900 hover:underline text-blue-900">{{$role->name}}</a>
                                    </td>

                                <td class="px-1 py-2 whitespace-nowrap">

                     {{-- <form action="{{route('role.destroy',$role->id)}} " method="POST">

                         @csrf
                         @method('DELETE')
                <input type="submit" name="submit" value="Delete" class="inline-block p-3 text-center text-white transition bg-red-500 rounded-full shadow ripple hover:shadow-lg hover:bg-red-600 focus:outline-none">
                     </form> --}}

                            </td>

                                </tr>

                               @endforeach 
                            </tbody>
                        </table>
        <div class="flex flex-col bg-white rounded ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
asdfasdfasdf
                    
                    </div>
                </div>
            </div>
        </div>
    <div class="mt-5">
        <a href="{{route('PlacedRFQ.index')}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Back
        </a>
    </div>

</x-app-layout>
