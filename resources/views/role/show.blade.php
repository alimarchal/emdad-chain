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
                            $('#alermessage').delay(2000).hide(0);
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
                            <a href="{{ route('role.create') }}"
                               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Add Role
                            </a>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
{{--                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">--}}
                                    <h2 class="text-2xl font-bold text-center">Roles List</h2>
                                    <x-jet-validation-errors class="mb-4" />
                                    @if ($roles->count())
                                    <!-- This example requires Tailwind CSS v2.0+ -->
                                        <div class="flex flex-col">
                                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                        <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                                    #
                                                                </th>
                                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                                    Title
                                                                </th>
                                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                                    Permissions
                                                                </th>
                                                            </tr>
                                                            </thead>

                                                            <tbody class="bg-white divide-y divide-gray-200">
                                                                @foreach ($roles as $role)
                                                                        <tr>
                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                <div class="text-sm text-gray-900">{{ $loop->iteration }}</div>
                                                                            </td>
                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                <div class="flex items-center">
                                                                                    <div class="flex-shrink-0 h-10 w-10">
                                                                                        <img class="h-3xl w-24 rounded-full" src="{{ empty($role->profile_photo_path) ? Storage::url('images.png') : Storage::url($role->profile_photo_path) }}" alt="Profile Picture">
                                                                                        <!-- https://images.unsplash.com/photo-1584824486539-53bb4646bdbc?&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60 -->
                                                                                    </div>
                                                                                    <div class="ml-4">
                                                                                        <div class="text-sm font-medium text-gray-900">
                                                                                            {{ $role->name }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                                @if(!empty($role->getAllPermissions()))
                                                                                    @foreach($role->getAllPermissions() as $v)
                                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">
                                                                                            {{$v->name }}
                                                                                        </span>
                                                                                    @endforeach
                                                                                @endif
                                                                            </td>
                                                                        </tr>

                                                                @endforeach
                                                            </tbody>

                                                            <!-- More rows... -->
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
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>

            </div>

            @if ($roles->count() >= 50)
                <div class="px-4 py-5 mt-3 bg-white sm:p-6 rounded-sm">
                    <div class="col-span-12 sm:col-span-12">
                        {{ $roles->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>


</x-app-layout>
