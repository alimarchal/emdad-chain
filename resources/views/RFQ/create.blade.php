@section('headerScripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{ url('select2/src/select2totree.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ url('select2/src/select2totree.js') }}"></script>
@endsection
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <h2 class="text-2xl font-bold py-2 text-center">
        </h2>



            @if(isset($rfqCount) && $rfqCount != 0 && $rfqCount != null)
            <div class="flex flex-col bg-white rounded">
                @if ($eCart->count())
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

                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Show Company Name
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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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
                                                <select name="company_name_check" id="company_name_check" onchange="companyCheck({{$rfp->id}})" class="form-select shadow-sm block w-full" required>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                <br>
                <div class="p-4">
                    <!-- Remaining RFQ count for Basic and Silver Business Packages -->
                    @php
                            $rfq = \App\Models\EOrders::where('business_id', auth()->user()->business_id)->whereDate('created_at', \Carbon\Carbon::today())->count();

                            $business_package = \App\Models\BusinessPackage::where('business_id', auth()->user()->business_id)->first();
                            $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                            $count = $package->rfq_per_day - $rfq;
                    @endphp
                    @if($business_package->package_id == 1 || $business_package->package_id == 2 )
                        <div class="flex flex-wrap" style="justify-content: flex-start">
                            <h1 class="text-1xl mt-0 pb-0 text-center"> RFQ(s) remaining for the day: </h1>
                            <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$count}} </h1>
                        </div>
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
                            <textarea name="description" id="description" maxlength="255"></textarea>
                            <input type="hidden" value="{{ $user->business_id }}" name="business_id">
                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                        </div>

                        <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-2 lg:-mx-2 xl:-mx-1">

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measurement">
                                    Display Company Name <span class="text-red-600">*</span>
                                </label>

                                <select name="company_name_check" id="company_name_check" class="form-select shadow-sm block w-full" required>
                                    <option disabled selected value="">Select</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measurement">
                                    Unit of Measurement <span class="text-red-600">*</span>
                                </label>

                                <select name="unit_of_measurement" id="unit_of_measurement" class="form-select shadow-sm block w-full" required>
                                    <option value="">None</option>
                                    @foreach (\App\Models\UnitMeasurement::all() as $item)
                                        <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                    Size
                                </label>
                                <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="size" min="0">
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="quantity">
                                    Quantity (Units)<span class="text-red-600">*</span>
                                </label>
                                <input class="form-input rounded-md shadow-sm block w-full" id="quantity" type="number" name="quantity" min="0" autocomplete="quantity" required>
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="brand">
                                    Brand
                                </label>
                                <input class="form-input rounded-md shadow-sm block w-full" id="brand" type="text" name="brand" min="0" autocomplete="brand">
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="last_price">
                                    Last Price
                                </label>
                                <input class="form-input rounded-md shadow-sm block w-full" id="last_price" type="number" name="last_price" min="0" autocomplete="last_price">
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="remarks">
                                    Remarks
                                </label>
                                <input class="form-input rounded-md shadow-sm block w-full" id="remarks" name="remarks" type="text" autocomplete="remarks"  >
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
                                    Delivery Period<span class="text-red-600">*</span>
                                </label>
                                <select name="delivery_period" id="delivery_period" class="form-select shadow-sm block w-full" required>
                                    <option value="">None</option>
                                    <option value="Immediately">Immediately</option>
                                    <option value="Within 30 Days">30 Days</option>
                                    <option value="Within 60 Days">60 Days</option>
                                    <option value="Within 90 Days">90 Days</option>
                                </select>
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="payment_mode">
                                    Payment Mode<span class="text-red-600">*</span>
                                </label>
                                <select name="payment_mode" id="payment_mode" class="form-select shadow-sm block w-full" required>
                                    <option value="">None</option>
                                    <option value="Cash">Cash</option>
                                    @if(auth()->user()->business_package->package_id != 1)
                                    <option value="Credit">Credit</option>
                                    <option value="Credit30days">Credit (30 Days)</option>
                                    <option value="Credit60days">Credit (60 Days)</option>
                                    <option value="Credit90days">Credit (90 Days)</option>
                                    <option value="Credit120days">Credit (120 Days)</option>
                                    @endif
                                </select>
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="file">
                                    Attachment (if any)
                                </label>
                                <input class="form-input rounded-md shadow-sm block w-full" id="file" type="file" name="file_path_1" autocomplete="name">
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="warehouse_id">
                                    Delivery Location (Warehouse)<span class="text-red-600">*</span>
                                </label>
                                <select name="warehouse_id" id="warehouse_id" class="form-select shadow-sm block w-full" required>
                                    <option value="">Select Warehouse</option>
                                    @foreach(\App\Models\BusinessWarehouse::where('user_id', auth()->user()->id)->get() as $warehouse)
                                        <option value="{{$warehouse->id}}">{{$warehouse->name . ' Address:' . $warehouse->address }}</option>
                                    @endforeach
                                </select>
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
            @elseif($rfqCount == null)
            <div class="flex flex-col bg-white rounded">
                @if ($eCart->count())
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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                <br>
                <div class="p-4">
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
                                    Display Company Name <span class="text-red-600">*</span>
                                </label>

                                <select name="company_name_check" id="company_name_check" class="form-select shadow-sm block w-full" required>
                                    <option disabled selected value="">Select</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measurement">
                                    Unit of Measurement
                                </label>

                                <select name="unit_of_measurement" id="unit_of_measurement" class="form-select shadow-sm block w-full" required>
                                    <option value="">None</option>
                                    @foreach (\App\Models\UnitMeasurement::all() as $item)
                                        <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                    @endforeach
                                    <option value="Standard Order">Standard Order</option>
                                </select>
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                    Size
                                </label>
                                <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="size" min="0" autocomplete="size">
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
                                <input class="form-input rounded-md shadow-sm block w-full" id="last_price" type="number" name="last_price" min="0" autocomplete="last_price">
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
                                    <option value="Standard Order">Standing Order</option>
                                </select>
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="payment_mode">
                                    Payment Mode
                                </label>
                                <select name="payment_mode" id="payment_mode" class="form-select shadow-sm block w-full" required>
                                    <option value="">None</option>
                                    <option value="Cash">Cash</option>
                                    @if(auth()->user()->business_package->package_id != 1)
                                        <option value="Credit">Credit</option>
                                    @endif
                                </select>
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="file">
                                    Attachment (if any)
                                </label>
                                <input class="form-input rounded-md shadow-sm block w-full" id="file" type="file" name="file_path_1" autocomplete="name">
                            </div>

                            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                                <label class="block font-medium text-sm text-gray-700 mb-1" for="warehouse_id">
                                    Delivery Location (Warehouse)
                                </label>
                                <select name="warehouse_id" id="warehouse_id" class="form-select shadow-sm block w-full" required>
                                    <option value="">Select Warehouse</option>
                                    @foreach(\App\Models\BusinessWarehouse::where('user_id', auth()->user()->id)->get() as $warehouse)
                                        <option value="{{$warehouse->id}}">{{$warehouse->name . ' Address:' . $warehouse->address }}</option>
                                    @endforeach
                                </select>
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
            @else
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                            <div class="text-black text-2xl" style="text-align: center">
                                Your have reached daily RFQ generate limit.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif


        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
            });
        </script>
    </x-app-layout>
@else
    <x-app-layout>
        <h2 class="text-2xl font-bold py-2 text-center">
        </h2>

        <div class="flex flex-col bg-white rounded" style="direction: rtl">

            @if ($eCart->count())
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            <br>
            <div class="p-4">


                <hr>

                <form method="POST" action="{{ route('RFQCart.store') }}" enctype="multipart/form-data" class="p-4 rounded bg-white">
                    @csrf
                    <h2 class="text-2xl font-bold mt-0 pb-0 text-center">طلب عرض السعر</h2><br>
                    <div class="w-full overflow-hidden">
                        <!-- Column Content -->
                        @include('category.rfp')
                    </div>
                    <div class="w-full overflow-hidden">
                        <label class="block font-medium text-sm text-gray-700 mb-1" for="description">
                            وصف
                        </label>
                        <textarea name="description" id="description"></textarea>
                        <input type="hidden" value="{{ $user->business_id }}" name="business_id">
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                    </div>

                    <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-2 lg:-mx-2 xl:-mx-1">

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measurement">
                                وحدة القياس
                            </label>

                            <select name="unit_of_measurement" id="unit_of_measurement" class="form-select shadow-sm block w-full" required>
                                <option value="">None</option>
                                @foreach (\App\Models\UnitMeasurement::all() as $item)
                                    <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                @endforeach
                                <option value="Standard Order">Standard Order</option>
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                مقاس
                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="size" min="0" autocomplete="size">
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="quantity">
                                العدد (للوحدة)
                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="quantity" type="number" name="quantity" min="0" autocomplete="quantity" required>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="brand">
                                العلامة التجارية
                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="brand" type="text" name="brand" min="0" autocomplete="brand" required>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="last_price">
                                السعر الأخير
                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="last_price" type="number" name="last_price" min="0" autocomplete="last_price" required>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="remarks">
                                ملاحظات
                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="remarks" name="remarks" type="text" autocomplete="remarks" required>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="required_sample">
                                مطلوب عينة
                            </label>
                            <select name="required_sample" id="required_sample" class="form-select shadow-sm block w-full" required>
                                <option value="">None</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="delivery_period">
                                مدة التوصيل
                            </label>
                            <select name="delivery_period" id="delivery_period" class="form-select shadow-sm block w-full" required>
                                <option value="">None</option>
                                <option value="30 Days">30 Days</option>
                                <option value="60 Days">60 Days</option>
                                <option value="90 Days">90 Days</option>
                                <option value="Standard Order">Standing Order</option>
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="payment_mode">
                                طريقة الدفع
                            </label>
                            <select name="payment_mode" id="payment_mode" class="form-select shadow-sm block w-full" required>
                                <option value="">None</option>
                                <option value="Cash">Cash</option>
                                <option value="Credit">Credit</option>
                            </select>
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="file">
                                المرفقات (إن وجد)
                            </label>
                            <input class="form-input rounded-md shadow-sm block w-full" id="file" type="file" name="file_path_1" autocomplete="name">
                        </div>

                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">
                            <label class="block font-medium text-sm text-gray-700 mb-1" for="warehouse_id">
                                موقع التوصيل (المستودع)
                            </label>
                            <select name="warehouse_id" id="warehouse_id" class="form-select shadow-sm block w-full" required>
                                <option value="">Select Warehouse</option>
                                @foreach(\App\Models\BusinessWarehouse::where('user_id', auth()->user()->id)->get() as $warehouse)
                                    <option value="{{$warehouse->id}}">{{$warehouse->name . ' Address:' . $warehouse->address }}</option>
                                @endforeach
                            </select>
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
                        إضافة منتج
                    </button>
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        إلغاء</a>
                </form>
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
@endif

<script>
    function companyCheck(itemno)
    {
        $value = $('#company_name_check').val();
        $.ajax({
            type : 'POST',
            url:"{{ route('companyCheck') }}",
            data:{
                "_token": "{{ csrf_token() }}",
                'rfqNo':itemno,
                'status':$value
            },
            success: function (response) {
                if(response.status === 0){
                    alert('Not Updated Try again');
                }
                else if(response.status === 1) {
                    $('#status').show().delay(5000).fadeOut();
                }
            }
        });
    }
</script>
