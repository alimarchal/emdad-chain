@if (auth()->user()->rtl == 0)
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
        <h2 class="text-2xl font-bold py-2 text-center m-15">Cart Items @if (!$eCart->count()) seems empty @endif
        </h2>

        <!-- This example requires Tailwind CSS v2.0+ -->


        @if ($eCart->count())
            @php $total = 0; @endphp
{{--            <div class="flex flex-col bg-white rounded ">--}}
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
                                        Item Name
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Brand
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Unit
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Size
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Quantity
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Last Price
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Delivery Period
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Payment Mode
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        Remarks
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider" title="Display {{auth()->user()->business->business_name}} in the RFQ">
                                        Display Company Name
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                            </path>
                                        </svg>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </th>


                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($eCart as $rfp)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->item_name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->brand }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ strip_tags($rfp->description) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->unit_of_measurement }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->size }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ number_format($rfp->last_price, 2) }} <br>
                                        </td>


                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->delivery_period }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->payment_mode }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->remarks }}
                                        </td>

                                        <td class="px-8 py-3 whitespace-nowrap">
                                            <select name="company_name_check" id="company_name_check" onchange="companyCheck({{$rfp->id}})" class="form-select shadow-sm block w-full" required title="Display {{auth()->user()->business->business_name}} in the RFQ">
                                                <option {{($rfp->company_name_check == 0) ? 'selected' : ''}} value="0">No</option>
                                                <option {{($rfp->company_name_check == 1) ? 'selected' : ''}} value="1">Yes</option>
                                            </select>
                                            <span style="display: none" id="status" class="text-green-600 text-sm-center">Status Updated.</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($rfp->file_path)
                                                <a href="{{ Storage::url($rfp->file_path) }}">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @else
                                                #N/A
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form method="POST" action="{{ route('RFQCart.destroy', $rfp->id) }}" class="inline">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE" onsubmit="alert('Are you sure')">
                                                    <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="red">
                                                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                                                        <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/>
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
                    <form action="{{ route('EOrders.store') }}" method="POST">
                        @csrf
                        @foreach ($eCart as $rfp)
                            <input type="hidden" name="item_number[]" value="{{ $rfp->id }}">
                        @endforeach

                        <input type="hidden" value="{{ auth()->user()->business->id }}" name="business_id">
                        <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                        <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            Place RFQ
                        </button>
                    </form>
                </div>
{{--            </div>--}}
        @endif


    </x-app-layout>
@else
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
        <h2 class="text-2xl font-bold py-2 text-center m-15">المنتجات في السلة @if (!$eCart->count()) seems empty @endif
        </h2>

        <!-- This example requires Tailwind CSS v2.0+ -->


        @if ($eCart->count())
            @php $total = 0; @endphp
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
                                        اسم المنتج
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        العلامة التجارية
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        الوصف
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        الوحدة
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        مقاس
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        العدد
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        السعر الأخير
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        مدة التوصيل
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        طريقة الدفع
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        ملاحظات
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                            </path>
                                        </svg>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </th>


                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($eCart as $rfp)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->item_name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->brand }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ strip_tags($rfp->description) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->unit_of_measurement }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->size }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ number_format($rfp->last_price, 2) }} <br>
                                        </td>


                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->delivery_period }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->payment_mode }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $rfp->remarks }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($rfp->file_path)
                                                <a href="{{ Storage::url($rfp->file_path) }}">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @else
                                                لاشيء مما سبق
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form method="POST" action="{{ route('RFQCart.destroy', $rfp->id) }}" class="inline">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="DELETE" onsubmit="alert('Are you sure')">
                                                    <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="red">
                                                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                                                        <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/>
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
                    <form action="{{ route('EOrders.store') }}" method="POST">
                        @csrf
                        @foreach ($eCart as $rfp)
                            <input type="hidden" name="item_number[]" value="{{ $rfp->id }}">
                        @endforeach

                        <input type="hidden" value="{{ auth()->user()->business->id }}" name="business_id">
                        <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                        <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            Place RFQ
                        </button>
                    </form>
                </div>
            </div>
        @endif


    </x-app-layout>
@endif

<script>
    function companyCheck(itemno) {
        $value = $('#company_name_check').val();
        $.ajax({
            type: 'POST',
            url: "{{ route('companyCheck') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                'rfqNo': itemno,
                'status': $value
            },
            success: function (response) {
                if (response.status === 0) {
                    alert('Not Updated Try again');
                } else if (response.status === 1) {
                    $('#status').show().delay(5000).fadeOut();
                }
            }
        });
    }
</script>
