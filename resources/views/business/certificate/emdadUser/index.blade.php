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
            {{ __('Business New Certificate(s) Requests') }}
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
                                // 'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        } );
                    });

                </script>
                <div class="py-3">
                    <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                    </div>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <x-jet-validation-errors class="mb-4" />
                    @if ($businessCertificates->count())
                        <!-- This example requires Tailwind CSS v2.0+ -->
                            <h2 class="text-2xl font-bold text-center">Business New Certificate(s) Requests</h2>
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
                                                        User name
                                                    </th>

                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        Company Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                        View
                                                    </th>

                                                    @if(auth()->user()->hasRole('IT Admin'))
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                            Legal office status
                                                        </th>
                                                    @endif

                                                    @if(auth()->user()->hasRole('Legal Approval Officer 1') || auth()->user()->hasRole('IT Admin'))
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="text-align:center;">
                                                            Action
                                                        </th>
                                                    @endif
                                                </tr>
                                                </thead>

                                                <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($businessCertificates as $businessCertificate)
                                                    <tr>
                                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                                            <div class="text-sm text-gray-900">{{ $loop->iteration }}</div>
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                                            <div class="text-sm text-gray-900">{{ $businessCertificate->business->user->name }}</div>
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                                            <div class="text-sm text-gray-900">
                                                                {{ isset($businessCertificate->business->business_name) ? $businessCertificate->business->business_name : 'N/A'  }}
                                                            </div>
                                                        </td>

                                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                                            <div class="text-sm text-gray-900">
                                                                <a href="{{route('certificateShow', $businessCertificate->id)}}" target="_blank">
                                                                    <svg class="w-6 h-6 inline" fill="none" stroke="red"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                        </path>
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </td>

                                                        @if(auth()->user()->hasRole('IT Admin'))
                                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                <div class="text-sm text-gray-900">
                                                                    @if($businessCertificate->legal_officer_status == 0)
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100  text-yellow-800">Pending</span>
                                                                    @elseif($businessCertificate->legal_officer_status == 1)
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">Accepted</span>
                                                                    @elseif($businessCertificate->legal_officer_status == 2)
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100  text-red-800">Rejected</span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                <div class="text-sm text-gray-900">
                                                                    <a class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1"
                                                                       href="{{route('certificateBusinessStatusUpdate', $businessCertificate->id)}}" style="transition: all .15s ease"> Update
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        @endif

                                                        @if(auth()->user()->hasRole('Legal Approval Officer 1'))
                                                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                                                @if($businessCertificate->legal_officer_status == 0)
                                                                    <div class="text-sm text-gray-900">
                                                                        <a class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1"
                                                                           href="{{route('certificateStatusUpdate', [ 'id' => $businessCertificate->id,  'status' => 1])}}" style="transition: all .15s ease"> Accept
                                                                        </a>

                                                                        <a class="bg-red-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1"
                                                                           href="{{route('certificateStatusUpdate', ['id' => $businessCertificate->id, 'status' =>  2])}}" style="transition: all .15s ease"> Reject
                                                                        </a>
                                                                    </div>
                                                                @elseif($businessCertificate->legal_officer_status == 1)
                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100  text-green-800">Accepted</span>
                                                                @elseif($businessCertificate->legal_officer_status == 2)
                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100  text-red-800">Rejected</span>
                                                                @endif
                                                            </td>
                                                        @endif
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
                                <strong class="mr-1">No record found...!</strong>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
