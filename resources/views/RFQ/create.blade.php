@section('headerScripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{ url('select2/src/select2totree.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ url('select2/src/select2totree.js') }}"></script>
@endsection
<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">{{ session('message') }}</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                @if ($eCart->count())
                                    <h2 class="text-2xl font-bold py-2 text-center"> <a href="{{ route('RFQCart.index') }}"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg> Cart (@if ($eCart->count()){{ $eCart->count() }}@endif)
                                    </a></h2>
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    #
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    ITEM NAME
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    DESCRIPTION
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    UNIT
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    SIZE
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    QUANTITY
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    BRAND
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    LAST PRICE
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    REMARKS
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    DELIVERY PERIOD
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                        </path>
                                                    </svg>
                                                </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $rfp->item_name }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ strip_tags($rfp->description) }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $rfp->unit_of_measurement }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $rfp->size }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $rfp->quantity }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $rfp->brand }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $rfp->last_price }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $rfp->remarks }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $rfp->delivery_period }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <form method="POST" action="#" class="inline">
                                                            <a href="submit" class="text-indigo-600 inline-block hover:text-indigo-900" title="EDIT">
                                                                <svg width="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                            </a>
                                                        </form>
                                                        <form method="POST" action="{{ route('RFQCart.destroy', $rfp->id) }}" class="inline">
                                                            @csrf
                                                            @method('delete')

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
                                @endif
                                <hr>
                                <form method="POST" action="{{ route('RFQCart.store') }}" enctype="multipart/form-data" class="p-4 rounded bg-white">
                                    @csrf


                                    <h2 class="text-2xl font-bold mt-0 pb-0 text-center">Request for Quotation</h2><br>
                                    <div class="w-full overflow-hidden">
                                        <!-- Column Content -->
                                        @include('category.rfp')
                                    </div>
                                    <div class="w-full overflow-hidden">
                                        <label class="block font-medium text-sm text-gray-700 mb-1" for="description">
                                            Description
                                        </label>
                                        <textarea name="description" id="description"></textarea>
                                        <input type="hidden" value="{{ $user->business_id }}" name="business_id">
                                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                                    </div>

                                    <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-2 lg:-mx-2 xl:-mx-1">

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                            <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measurement">
                                                Unit of Measurement
                                            </label>

                                            <select name="unit_of_measurement" id="unit_of_measurement" class="form-select shadow-sm block w-full" required>
                                                <option value="">None</option>
                                                <option value="30 Days">30 Days</option>
                                                <option value="60 Days">60 Days</option>
                                                <option value="90 Days">90 Days</option>
                                                <option value="Standard Order">Standard Order</option>
                                            </select>
                                        </div>

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                            <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                Size
                                            </label>
                                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="size" min="0" autocomplete="size" required>
                                        </div>

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                            <label class="block font-medium text-sm text-gray-700 mb-1" for="quantity">
                                                Quantity (Units)
                                            </label>
                                            <input class="form-input rounded-md shadow-sm block w-full" id="quantity" type="number" name="quantity" min="0" autocomplete="quantity" required>
                                        </div>

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                            <label class="block font-medium text-sm text-gray-700 mb-1" for="brand">
                                                Brand
                                            </label>
                                            <input class="form-input rounded-md shadow-sm block w-full" id="brand" type="text" name="brand" min="0" autocomplete="brand" required>
                                        </div>

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                            <label class="block font-medium text-sm text-gray-700 mb-1" for="last_price">
                                                Last Price
                                            </label>
                                            <input class="form-input rounded-md shadow-sm block w-full" id="last_price" type="number" name="last_price" min="0" autocomplete="last_price" required>
                                        </div>

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                            <label class="block font-medium text-sm text-gray-700 mb-1" for="remarks">
                                                Remarks
                                            </label>
                                            <input class="form-input rounded-md shadow-sm block w-full" id="remarks" name="remarks" type="text" autocomplete="remarks" required>
                                        </div>

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                            <label class="block font-medium text-sm text-gray-700 mb-1" for="required_sample">
                                                Required Sample
                                            </label>
                                            <select name="required_sample" id="required_sample" class="form-select shadow-sm block w-full" required>
                                                <option value="">None</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                            <label class="block font-medium text-sm text-gray-700 mb-1" for="delivery_period">
                                                Delivery Period
                                            </label>
                                            <select name="delivery_period" id="delivery_period" class="form-select shadow-sm block w-full" required>
                                                <option value="">None</option>
                                                <option value="30 Days">30 Days</option>
                                                <option value="60 Days">60 Days</option>
                                                <option value="90 Days">90 Days</option>
                                                <option value="Standard Order">Standard Order</option>
                                            </select>
                                        </div>

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                            <label class="block font-medium text-sm text-gray-700 mb-1" for="file">
                                                Attachment (any picture)
                                            </label>
                                            <input class="form-input rounded-md shadow-sm block w-full" id="file" type="file" name="file_path_1" autocomplete="name">
                                        </div>

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                            <!-- Column Content -->
                                        </div>

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                            <!-- Column Content -->
                                        </div>

                                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">

                                        </div>

                                    </div>
                                    <button type="submit"
                                        class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        ADD ITEM
                                    </button>
                                    <a href="{{ route('dashboard') }}"
                                        class="inline-flex items-center px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        Cancel</a>

                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>







        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
            });

        </script>
</x-app-layout>
