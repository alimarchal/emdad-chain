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
    <h2 class="text-2xl font-bold py-2 text-center m-15">RFQ List</h2>

    <!-- This example requires Tailwind CSS v2.0+ -->

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
                                Date
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                Status
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                RFQ #
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                Client Name
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-center text-xs font-medium text-gray-500 tracking-wider" width="120">
                                Action
                            </th>


                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($PlacedRFQ as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$loop->iteration}}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap" >
                                    {{$item->created_at->format('d-m-Y')}}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap" >
                                    {{$item->status}}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item->business_id)
                                        <a href="{{route('RFQItemsByID',$item->id)}}" class="hover:underline hover:text-blue-900 text-blue-900">
                                            {{ $item->business_id }}-{{$item->id}}
                                        </a>
                                    @else
                                        <a href="{{route('RFQItemsByID',$item->id)}}" class="hover:underline hover:text-blue-900 text-blue-900">
                                            {{ $item->business_id }}-{{$item->id}}
                                        </a>
                                    @endif

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if (\App\Models\Business::find($item->business_id))
                                        <a href="{{url('business/'.$item->business_id)}}" class="hover:underline hover:text-blue-900 text-blue-900">
                                            {{\App\Models\Business::find($item->business_id)->first()->business_name}}
                                        </a>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{route('RFQItemsByID',$item->id)}}" class="text-blue-600 hover:underline" >
                                        VIEW
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
</x-app-layout>
