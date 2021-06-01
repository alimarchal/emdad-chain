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
            SMS List
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-4">
                @if (session()->has('message'))
                    <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">{{ session('message') }}</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <script>
                    $(document).ready(function () {
                        $('#roles-table').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        });
                    });

                </script>

                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        {{--                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
                        {{--                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">--}}
                        <h2 class="text-2xl font-bold text-center mt-4">SMS List</h2>
                        @if ($sms->count())
                        <!-- This example requires Tailwind CSS v2.0+ -->
                            <div class="flex flex-col">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                            <table class="min-w-full divide-y divide-gray-200" id="roles-table">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Category
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Arabic Message
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        English Message
                                                    </th>
                                                    <th scope="col" class="text-center px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Action
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($sms as $sm)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            {{ $sm->category }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $sm->arabic_message }}
                                                        </td>

                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $sm->english_message }}
                                                        </td>

                                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                            <a href="{{ route('smsMessages.edit', $sm->id) }}" class="text-indigo-600 inline-block hover:text-indigo-900" title="EDIT">
                                                                <svg width="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                                </svg>
                                                            </a>
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
                                <strong class="mr-1">No users yet..!</strong>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                        <div class="flex justify-end my-4">
                            <a href="{{route('smsMessages.create')}}" class="inline-flex px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Create SMS
                            </a>
                        </div>
                    </div>
                </div>

            </div>



            @if ($sms->count() >= 50)
                <div class="px-4 py-5 mt-3 bg-white sm:p-6 rounded-sm">
                    <div class="col-span-12 sm:col-span-12">
                        {{ $sms->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>


</x-app-layout>
