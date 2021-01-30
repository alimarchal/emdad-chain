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

<div class="flex flex-col bg-white rounded mt-8">
  <form action="{{route('permission.update',$permission->id)}}"  method="post" class="form bg-white p-6" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')
                         @method('PATCH') 
                        <h3 class="text-2xl text-gray-900 font-semibold text-center"> Add a permission</h3>
                        <p class="text-gray-600">Business Name</p>

                      
                    
                        
                        <div class="flex space-x-5 mt-3" >
                            <input type="text" name="name" id=""  class="border p-2 w-1/2" value="{{$permission->name}}">
                            <input type="text" name="guard_name" id=""  class="border p-2 w-1/2 select-none" value="{{$permission->guard_name}}" hidden>
                           
                        </div>
                     
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150" style="margin-top: 15px;">Update</button>
                      
                    
                      

                    </form>

</div>
    <div class="mt-5">
        <a href="{{route('permission.index')}}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Back
        </a>
         <a href="{{route('permission.create')}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Add new Permission
        </a>
    </div>

    <div class="mt-5">
       
    </div>
   


</x-app-layout>
