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
        $(document).ready(function() {
            $('#alermessage').delay(2000).hide(0);
        });

    </script>
    {{-- <h2 class="text-2xl font-bold py-2 text-center m-15">Items List @if (!$collection->count()) seems empty @endif
    </h2> --}}


    <div class="mt-5" style="text-align: center;">
        <a href="{{ route('dashboard') }}"
            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Back
        </a>
        <a href="{{ route('permission.create') }}"
            class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
            Add new Permission
        </a>
    </div>



    <!-- This example requires Tailwind CSS v2.0+ -->
    @php $total = 0; @endphp
    <div class="flex flex-col bg-white rounded m-20" style="margin-top: 20px;">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 justify-content: center;">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class=" shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full  divide-gray-200 ">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-30 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Permession Name
                                </th>
                                <th scope="col" class="px-6 py-30 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Action
                                </th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 ">
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap ml-10">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ml-10">
                                        <a href="{{ route('permission.edit', $permission->id) }}" class="hover:text-blue-900 hover:underline text-blue-900">{{ $permission->name }}</a>
                                    </td>

                                    <td class="whitespace-nowrap ml-10">

                                        <a href="{{ route('permission.show', $permission->id) }}" class="text-indigo-600 inline-block hover:text-indigo-900" title="VIEW">
                                            <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="blue">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('permission.edit', $permission->id) }}" class="text-indigo-600 inline-block hover:text-indigo-900" title="EDIT">
                                            <svg width="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('permission.destroy', $permission->id) }}" method="post" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE" onsubmit="alert('Are you sure')">
                                                <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="red">
                                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                                    <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





    <div class="mt-5">

    </div>



</x-app-layout>
