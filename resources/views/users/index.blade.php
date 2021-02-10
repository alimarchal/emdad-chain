@section('headerScripts')
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">{{ session('message') }}</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                    <script>
                        $(document).ready(function() {
                            $('#roles-table').DataTable( {
                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ]
                            } );
                        });

                    </script>

                    <div class="py-3">
                        <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                            <a href="{{ route('users.create') }}"
                               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Add User
                            </a>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            {{--                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
                            {{--                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">--}}
                            <h2 class="text-2xl font-bold text-center">Roles List</h2>
                                @if ($users->count())
                                    <!-- This example requires Tailwind CSS v2.0+ -->
                                    <div class="flex flex-col">
                                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                    <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Name
                                                                </th>
                                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Title
                                                                </th>
                                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Status
                                                                </th>
                                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Approved
                                                                </th>
                                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Email Verified
                                                                </th>
                                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Role
                                                                </th>
                                                                <th scope="col" class="px-6 py-3 bg-gray-50">
                                                                    <span class="sr-only">Edit</span>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            @foreach ($users as $user)
                                                                <tr>
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="flex items-center">
                                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                                <img class="h-3xl w-24 rounded-full" src="{{ empty($user->profile_photo_path) ? Storage::url('images.png') : Storage::url($user->profile_photo_path) }}" alt="Profile Picture">
                                                                                <!-- https://images.unsplash.com/photo-1584824486539-53bb4646bdbc?&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60 -->
                                                                            </div>
                                                                            <div class="ml-4">
                                                                                <div class="text-sm font-medium text-gray-900">
                                                                                    {{ $user->name }}
                                                                                </div>
                                                                                <div class="text-sm text-gray-500">
                                                                                    {{ $user->email }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="text-sm text-gray-900">{{ $user->designation }}</div>
                                                                        @if ($user->designation)
                                                                            <div class="text-sm text-gray-500">Designation: {{ $user->designation }}</div>
                                                                        @endif
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->is_active == 1 ? 'bg-green-100' : 'bg-red-100' }}  text-green-800">
                                                                            {{ $user->is_active == 1 ? 'Active' : 'In-Active' }}
                                                                        </span>
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->profile_approved == 1 ? 'bg-green-100' : 'bg-red-100' }}  text-black-800">
                                                                            {{ $user->profile_approved == 1 ? 'Yes' : 'No' }}
                                                                        </span>
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ !is_null($user->email_verified_at) ? 'bg-green-100' : 'bg-red-100' }}  text-green-800">
                                                                            {{ !is_null($user->email_verified_at) ? 'Verified' : 'Not-Verified' }}
                                                                        </span>
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                        @foreach($user->roles()->pluck('name') as $role)
                                                                            <span class="badge badge-info">{{ $role }}</span>
                                                                        @endforeach
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">

                                                                        <a href="{{ route('users.show', $user->id) }}" class="text-indigo-600 inline-block hover:text-indigo-900" title="VIEW">
                                                                            <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="blue">
                                                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                                            </svg>
                                                                        </a>
                                                                        <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 inline-block hover:text-indigo-900" title="EDIT">
                                                                            <svg width="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                            </svg>
                                                                        </a>
                                                                        <form action="{{ route('users.destroy', $user->id) }}" method="post" class="inline-block">
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
                                                            <!-- More rows... -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                @else
                                    <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                        <strong class="mr-1">No record found...!</strong> Something seriously bad happened...
                                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @endif
                        </div>
                    </div>


            </div>

            @if ($users->count() >= 50)
                <div class="px-4 py-5 mt-3 bg-white sm:p-6 rounded-sm">
                    <div class="col-span-12 sm:col-span-12">
                        {{ $users->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>


</x-app-layout>
