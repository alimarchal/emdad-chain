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
    <h2 class="text-2xl font-bold py-2 text-center m-15">Cart Items @if (!$shipmentCarts->count()) seems empty @endif
    </h2>

    @if ($shipmentCarts->count())
        @php $total = 0; @endphp
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
                                    Driver Name
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Vehicle
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                    Delivery
                                </th>

                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                    Action
                                </th>


                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($shipmentCarts as $shipmentCart)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $shipmentCart->driver->name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $shipmentCart->vehicle->type }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $shipmentCart->delivery->item_name }}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <form method="POST" action="{{ route('shipmentCart.destroy', $shipmentCart->id) }}" class="inline delete">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE">
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
            <br>
            <div class="p-4">
                <form action="{{ route('shipmentItem.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="delivery_id" value="{{encrypt($shipmentCart->delivery->id)}}">
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                        Place Shipment
                    </button>
                </form>
            </div>
    @endif

</x-app-layout>

<script>
    $(".delete").on("submit", function(){
        return confirm("Are you sure you want to delete?");
    });
</script>
