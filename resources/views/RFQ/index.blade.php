<x-app-layout>
    <div class="flex flex-wrap overflow-hidden bg-white p-4 mt-5 rounded">
        <div class="w-full overflow-hidden">
            <!-- Column Content -->
            <h2 class="text-2xl font-bold text-center">My RFQs</h2>

            <div class="mt-4">
                {{--                <h4 class="text-gray-600">Simple Table</h4>--}}
                <div class="mt-6">
                    <div class="bg-white shadow rounded-md overflow-hidden my-6">
                        <table class="text-left w-full border-collapse">
                            <thead class="border-b">
                            <tr>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">#</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Item Name</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Description</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Unit</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Size</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Quantity</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Brand</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Last Price</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Remarks</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">Delivery Period</th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                    </svg>
                                </th>
                                <th class="py-3 px-5 bg-indigo-800 font-medium uppercase text-sm text-gray-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rfq as $rfp)
                                <tr class="hover:bg-gray-200">
                                    <td class="py-4 px-6 border-b text-gray-700 text-lg">{{$loop->iteration}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$rfp->item_name}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$rfp->description}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$rfp->unit_of_measurement}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$rfp->size}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$rfp->quantity}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$rfp->brand}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$rfp->last_price}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$rfp->remarks}}</td>
                                    <td class="py-4 px-6 border-b text-gray-500">{{$rfp->delivery_period}}</td>

                                    <td class="py-4 px-6 border-b text-gray-500">
                                        @if ($rfp->file_path)
                                            <a href="{{Storage::url($rfp->file_path)}}">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                </svg>
                                            </a>
                                        @else
                                            #N/A
                                        @endif

                                    </td>
                                    <td class="py-4 px-6 border-b text-gray-500">

                                        <a href="#" class="text-indigo-600 inline-block hover:text-indigo-900" title="EDIT">
                                            <svg width="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <a href="#" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE" onsubmit="alert('Are you sure')">
                                            <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="red">
                                                <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                                                <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>


