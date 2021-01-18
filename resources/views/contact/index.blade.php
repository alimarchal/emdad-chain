<x-app-layout>
    <div class="flex flex-wrap overflow-hidden bg-white p-4 mt-5 rounded">
        <div class="w-full overflow-hidden">
            <!-- Column Content -->
            <h2 class="text-2xl font-bold text-center uppercase">Contact form requests</h2>

            <div class="mt-4">
                {{--                <h4 class="text-gray-600">Simple Table</h4>--}}
                <div class="mt-6">
                    <div class="bg-white shadow rounded-md overflow-hidden my-6">
                        <table class="text-left w-full border-collapse">
                            <thead class="border-b">
                            <tr>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">#</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Name</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Email</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Phone</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Subject</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Message</th>
                                {{-- <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Status</th> --}}
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Date</th>
                            </thead>
                            <tbody>
                            @foreach($requests as $req)
                                <tr class="hover:bg-gray-200">
                                    <td class="py-4 px-6 border-b text-gray-700 text-lg">{{$loop->iteration}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$req->name}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$req->email}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$req->phone}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$req->subject}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$req->message}}</td>
                                    {{-- <td class="py-4 px-6 border-b text-gray-500">{{$req->status}}</td> --}}
                                    <td class="py-4 px-6 border-b text-gray-500">{{ \Carbon\Carbon::parse($req->created_at)->format('d/m/Y')}}</td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                        
                    </div>
                    
                    {{ $requests->links() }}
                </div>
            </div>


        </div>
    </div>
</x-app-layout>




