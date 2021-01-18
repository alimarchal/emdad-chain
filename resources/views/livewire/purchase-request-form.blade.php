{{--<div class="copy hidden">--}}
{{--    <div class="control-group">--}}
{{--        <hr class="mt-5">--}}
{{--        <a class="float-left float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray remove disabled:opacity-25 transition ease-in-out duration-150 float-left mb-4 bg-red-500">Delete</a>--}}
{{--        <div class="px-4 py-5 bg-white sm:p-6">--}}
{{--            <h2 class="text-2xl font-bold text-center">Request for Proposal (RFP)</h2>--}}
{{--            <x-jet-validation-errors class="mb-4"/>--}}
{{--            @if (session('message'))--}}
{{--                <div class="mb-4 font-medium text-sm text-red-600">--}}
{{--                    {{ session('message') }}--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <div class="flex flex-wrap overflow-hidden">--}}


{{--                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">--}}
{{--                    <label class="block font-medium text-sm text-gray-700 mb-1" for="item_name">--}}
{{--                        Item Name--}}
{{--                    </label>--}}
{{--                    @include('category.rfp2')--}}


{{--                </div>--}}

{{--                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">--}}
{{--                    <label class="block font-medium text-sm text-gray-700 mb-1" for="description">--}}
{{--                        Description--}}
{{--                    </label>--}}
{{--                    <input class="form-input rounded-md shadow-sm block w-full  " id="description" type="text" autocomplete="description">--}}
{{--                </div>--}}


{{--                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">--}}
{{--                    <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measure_measurement">--}}
{{--                        Unit of Measurement--}}
{{--                    </label>--}}
{{--                    <select name="unit_of_measure_measurement" id="unit_of_measure_measurement" class="form-select shadow-sm block w-full">--}}
{{--                        <option value="">--Please Select--</option>--}}
{{--                        <option value="30 Days">30 Days</option>--}}
{{--                        <option value="60 Days">60 Days</option>--}}
{{--                        <option value="90 Days">90 Days</option>--}}
{{--                        <option value="Standard Order">Standard Order</option>--}}
{{--                    </select>--}}
{{--                </div>--}}


{{--                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">--}}
{{--                    <label class="block font-medium text-sm text-gray-700 mb-1" for="size">--}}
{{--                        Size--}}
{{--                    </label>--}}
{{--                    <select name="size" id="size" class="form-select shadow-sm block w-full">--}}
{{--                        <option value="">--Please Select--</option>--}}
{{--                        <option value="30 Days">30 Days</option>--}}
{{--                        <option value="60 Days">60 Days</option>--}}
{{--                        <option value="90 Days">90 Days</option>--}}
{{--                        <option value="Standard Order">Standard Order</option>--}}
{{--                    </select>--}}
{{--                </div>--}}


{{--                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">--}}
{{--                    <label class="block font-medium text-sm text-gray-700 mb-1" for="quantity">--}}
{{--                        Quantity--}}
{{--                    </label>--}}
{{--                    <select name="quantity" id="quantity" class="form-select shadow-sm block w-full">--}}
{{--                        <option value="">--Please Select--</option>--}}
{{--                        <option value="30 Days">30 Days</option>--}}
{{--                        <option value="60 Days">60 Days</option>--}}
{{--                        <option value="90 Days">90 Days</option>--}}
{{--                        <option value="Standard Order">Standard Order</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">--}}
{{--                    <label class="block font-medium text-sm text-gray-700 mb-1" for="brand">--}}
{{--                        Brand--}}
{{--                    </label>--}}
{{--                    <select name="brand" id="brand" class="form-select shadow-sm block w-full">--}}
{{--                        <option value="">--Please Select--</option>--}}
{{--                        <option value="30 Days">30 Days</option>--}}
{{--                        <option value="60 Days">60 Days</option>--}}
{{--                        <option value="90 Days">90 Days</option>--}}
{{--                        <option value="Standard Order">Standard Order</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">--}}
{{--                    <label class="block font-medium text-sm text-gray-700 mb-1" for="last_price">--}}
{{--                        Last Price--}}
{{--                    </label>--}}
{{--                    <input class="form-input rounded-md shadow-sm block w-full" id="last_price" type="number" min="0" autocomplete="last_price">--}}
{{--                </div>--}}


{{--                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">--}}
{{--                    <label class="block font-medium text-sm text-gray-700 mb-1" for="remarks">--}}
{{--                        Remarks--}}
{{--                    </label>--}}
{{--                    <input class="form-input rounded-md shadow-sm block w-full" id="remarks" type="text" autocomplete="remarks">--}}
{{--                </div>--}}

{{--                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">--}}
{{--                    <!-- Column Content -->--}}
{{--                    <label class="block font-medium text-sm text-gray-700 mb-1" for="delivery_period">--}}
{{--                        Delivery Period--}}
{{--                    </label>--}}
{{--                    <select name="delivery_period" id="delivery_period" class="form-select shadow-sm block w-full">--}}
{{--                        <option value="">--Please Select--</option>--}}
{{--                        <option value="30 Days">30 Days</option>--}}
{{--                        <option value="60 Days">60 Days</option>--}}
{{--                        <option value="90 Days">90 Days</option>--}}
{{--                        <option value="Standard Order">Standard Order</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">--}}
{{--                    <label class="block font-medium text-sm text-gray-700 mb-1" for="file">--}}
{{--                        Attachment (any picture)--}}
{{--                    </label>--}}
{{--                    <input class="form-input rounded-md shadow-sm block w-full" id="file" type="file" autocomplete="name">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div>

    @if ($add)
        @for($i = 1; $i <= $add; $i++)
            <hr class="mt-5">
            <a class="float-left float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray remove disabled:opacity-25 transition ease-in-out duration-150 float-left mb-4 bg-red-500">Delete</a>
            <div class="px-4 py-5 bg-white sm:p-6">
                <h2 class="text-2xl font-bold text-center">Request for Proposal (RFP)</h2>
                <x-jet-validation-errors class="mb-4"/>
                @if (session('message'))
                    <div class="mb-4 font-medium text-sm text-red-600">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="flex flex-wrap overflow-hidden">


                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">
                        <label class="block font-medium text-sm text-gray-700 mb-1" for="item_name">
                            Item Name
                        </label>
                        @include('category.rfp2')


                    </div>

                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">
                        <label class="block font-medium text-sm text-gray-700 mb-1" for="description">
                            Description
                        </label>
                        <input class="form-input rounded-md shadow-sm block w-full  " id="description" type="text" autocomplete="description">
                    </div>


                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">
                        <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measure_measurement">
                            Unit of Measurement
                        </label>
                        <select name="unit_of_measure_measurement" id="unit_of_measure_measurement" class="form-select shadow-sm block w-full">
                            <option value="">--Please Select--</option>
                            <option value="30 Days">30 Days</option>
                            <option value="60 Days">60 Days</option>
                            <option value="90 Days">90 Days</option>
                            <option value="Standard Order">Standard Order</option>
                        </select>
                    </div>


                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">
                        <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                            Size
                        </label>
                        <select name="size" id="size" class="form-select shadow-sm block w-full">
                            <option value="">--Please Select--</option>
                            <option value="30 Days">30 Days</option>
                            <option value="60 Days">60 Days</option>
                            <option value="90 Days">90 Days</option>
                            <option value="Standard Order">Standard Order</option>
                        </select>
                    </div>


                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">
                        <label class="block font-medium text-sm text-gray-700 mb-1" for="quantity">
                            Quantity
                        </label>
                        <select name="quantity" id="quantity" class="form-select shadow-sm block w-full">
                            <option value="">--Please Select--</option>
                            <option value="30 Days">30 Days</option>
                            <option value="60 Days">60 Days</option>
                            <option value="90 Days">90 Days</option>
                            <option value="Standard Order">Standard Order</option>
                        </select>
                    </div>

                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">
                        <label class="block font-medium text-sm text-gray-700 mb-1" for="brand">
                            Brand
                        </label>
                        <select name="brand" id="brand" class="form-select shadow-sm block w-full">
                            <option value="">--Please Select--</option>
                            <option value="30 Days">30 Days</option>
                            <option value="60 Days">60 Days</option>
                            <option value="90 Days">90 Days</option>
                            <option value="Standard Order">Standard Order</option>
                        </select>
                    </div>

                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">
                        <label class="block font-medium text-sm text-gray-700 mb-1" for="last_price">
                            Last Price
                        </label>
                        <input class="form-input rounded-md shadow-sm block w-full" id="last_price" type="number" min="0" autocomplete="last_price">
                    </div>


                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">
                        <label class="block font-medium text-sm text-gray-700 mb-1" for="remarks">
                            Remarks
                        </label>
                        <input class="form-input rounded-md shadow-sm block w-full" id="remarks" type="text" autocomplete="remarks">
                    </div>

                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">
                        <!-- Column Content -->
                        <label class="block font-medium text-sm text-gray-700 mb-1" for="delivery_period">
                            Delivery Period
                        </label>
                        <select name="delivery_period" id="delivery_period" class="form-select shadow-sm block w-full">
                            <option value="">--Please Select--</option>
                            <option value="30 Days">30 Days</option>
                            <option value="60 Days">60 Days</option>
                            <option value="90 Days">90 Days</option>
                            <option value="Standard Order">Standard Order</option>
                        </select>
                    </div>

                    <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/4 p-1">
                        <label class="block font-medium text-sm text-gray-700 mb-1" for="file">
                            Attachment (any picture)
                        </label>
                        <input class="form-input rounded-md shadow-sm block w-full" id="file" type="file" autocomplete="name">
                    </div>
                </div>
            </div>
        @endfor
    @endif


    <button wire:click="like" type="button"
            class="float-left float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray remove disabled:opacity-25 transition ease-in-out duration-150 float-left mb-4 bg-red-500">
        Like Post
    </button>
</div>
