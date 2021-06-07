<x-app-layout>
    <h2 class="text-2xl font-bold py-2 text-center">
    </h2>



        <div class="flex flex-col bg-white rounded">
            <br>

            <div class="p-4">
                <div style="display: flex; background: #f3f3f3; height: 145px;" class="container-fluid">
                    <div style="margin-top: 20px;margin-bottom: 20px;padding-left: 20px;">
                        <img src="{{ url('imp_img.jpg') }}" alt="logo" style="height: 80px;width: 200px;"/>
                    </div>
                    <div style="margin-top: 20px;margin-bottom: 20px;padding-left: 20px;">
                        <span>JAVA coffee time</span>
                        <div>
                            <span>JAVA coffee time</span>
                        </div>
                        <div>
                            <span>JAVA coffee time</span>
                        </div>
                    </div>
                    <div style="margin-top: 20px;margin-bottom: 20px;padding-left: 20px;float: right">
                        <span>JAVA coffee time</span>
                        <div>
                            <span>JAVA coffee time</span>
                        </div>
                        <div>
                            <span>JAVA coffee time</span>
                        </div>
                    </div>
                </div>
                <hr>

{{--                <form method="POST" action="{{ route('RFQCart.store') }}" enctype="multipart/form-data" class="p-4 rounded bg-white">--}}
{{--                    @csrf--}}
{{--                    <h2 class="text-2xl font-bold mt-0 pb-0 text-center">Request for Quotation</h2><br>--}}
{{--                    <div class="w-full overflow-hidden">--}}
{{--                        <!-- Column Content -->--}}
{{--                        @include('category.rfp')--}}
{{--                    </div>--}}
{{--                    <div class="w-full overflow-hidden">--}}
{{--                        <label class="block font-medium text-sm text-gray-700 mb-1" for="description">--}}
{{--                            Description @include('misc.required')--}}
{{--                        </label>--}}
{{--                        <textarea name="description" id="description" class="w-full" style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="Enter Description.." required></textarea>--}}
{{--                        <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">--}}
{{--                        <input type="hidden" value="{{ auth()->id() }}" name="user_id">--}}
{{--                    </div>--}}

{{--                    <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-2 lg:-mx-2 xl:-mx-1">--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measurement">--}}
{{--                                Display Company Name @include('misc.required')--}}
{{--                            </label>--}}

{{--                            <select name="company_name_check" id="company_name_check" class="form-select shadow-sm block w-full" required>--}}
{{--                                <option disabled selected value="">Select</option>--}}
{{--                                <option value="0">No</option>--}}
{{--                                <option value="1">Yes</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="unit_of_measurement">--}}
{{--                                Unit of Measurement @include('misc.required')--}}
{{--                            </label>--}}

{{--                            <select name="unit_of_measurement" id="unit_of_measurement" class="form-select shadow-sm block w-full" required>--}}
{{--                                <option value="">None</option>--}}
{{--                                @foreach (\App\Models\UnitMeasurement::all() as $item)--}}
{{--                                    <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="size">--}}
{{--                                Size--}}
{{--                            </label>--}}
{{--                            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="size" min="0">--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="quantity">--}}
{{--                                Quantity (Units) @include('misc.required')--}}
{{--                            </label>--}}
{{--                            <input class="form-input rounded-md shadow-sm block w-full" id="quantity" type="number" name="quantity" min="0" autocomplete="quantity" required>--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="brand">--}}
{{--                                Brand--}}
{{--                            </label>--}}
{{--                            <input class="form-input rounded-md shadow-sm block w-full" id="brand" type="text" name="brand" min="0" autocomplete="brand">--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="last_price">--}}
{{--                                Last Price--}}
{{--                            </label>--}}
{{--                            <input class="form-input rounded-md shadow-sm block w-full" id="last_price" type="number" name="last_price" min="0" autocomplete="last_price">--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="remarks">--}}
{{--                                Remarks--}}
{{--                            </label>--}}
{{--                            <input class="form-input rounded-md shadow-sm block w-full" id="remarks" name="remarks" type="text" autocomplete="remarks">--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="required_sample">--}}
{{--                                Required Sample @include('misc.required')--}}
{{--                            </label>--}}
{{--                            <select name="required_sample" id="required_sample" class="form-select shadow-sm block w-full" required>--}}
{{--                                <option value="">None</option>--}}
{{--                                <option value="Yes">Yes</option>--}}
{{--                                <option value="No">No</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="delivery_period">--}}
{{--                                Delivery Period @include('misc.required')--}}
{{--                            </label>--}}
{{--                            <select name="delivery_period" id="delivery_period" class="form-select shadow-sm block w-full" required>--}}
{{--                                <option value="">None</option>--}}
{{--                                <option value="Immediately">Immediately</option>--}}
{{--                                <option value="Within 30 Days">30 Days</option>--}}
{{--                                <option value="Within 60 Days">60 Days</option>--}}
{{--                                <option value="Within 90 Days">90 Days</option>--}}
{{--                                <option value="Standing Order - 2 per year">Standing Order - 2 times / year</option>--}}
{{--                                <option value="Standing Order - 3 per year">Standing Order - 3 times / year</option>--}}
{{--                                <option value="Standing Order - 4 per year">Standing Order - 4 times / year</option>--}}
{{--                                <option value="Standing Order - 6 per year">Standing Order - 6 times / year</option>--}}
{{--                                <option value="Standing Order - 12 per year">Standing Order - 12 times / year</option>--}}
{{--                                <option value="Standing Order Open">Standing Order - Open</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="payment_mode">--}}
{{--                                Payment Mode  @include('misc.required')--}}
{{--                            </label>--}}
{{--                            <select name="payment_mode" id="payment_mode" class="form-select shadow-sm block w-full" required>--}}
{{--                                <option value="">None</option>--}}
{{--                                <option value="Cash">Cash</option>--}}
{{--                                --}}{{--@php--}}
{{--                                    $businessId =  auth()->user()->business->id;--}}
{{--                                    $package =    \App\Models\BusinessPackage::where('business_id', $businessId)->first();--}}
{{--                                @endphp--}}
{{--                                --}}{{--                                    @if(auth()->user()->business_package->package_id != 1)--}}
{{--                                @if($package->package_id != 1)--}}
{{--                                    <option value="Credit">Credit</option>--}}
{{--                                    <option value="Credit30days">Credit (30 Days)</option>--}}
{{--                                    <option value="Credit60days">Credit (60 Days)</option>--}}
{{--                                    <option value="Credit90days">Credit (90 Days)</option>--}}
{{--                                    <option value="Credit120days">Credit (120 Days)</option>--}}
{{--                                @endif--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="file">--}}
{{--                                Attachment (if any)--}}
{{--                            </label>--}}
{{--                            <input class="form-input rounded-md shadow-sm block w-full" id="file" type="file" name="file_path_1" autocomplete="name">--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <label class="block font-medium text-sm text-gray-700 mb-1" for="warehouse_id">--}}
{{--                                Delivery Location (Warehouse) @include('misc.required')--}}
{{--                            </label>--}}
{{--                            <select name="warehouse_id" id="warehouse_id" class="form-select shadow-sm block w-full" required>--}}
{{--                                <option value="">Select Warehouse</option>--}}
{{--                                @foreach(\App\Models\BusinessWarehouse::where('business_id', auth()->user()->business_id)->get() as $warehouse)--}}
{{--                                    <option value="{{$warehouse->id}}">{{$warehouse->name . ' Address:' . $warehouse->address }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <!-- Column Content -->--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}
{{--                            <!-- Column Content -->--}}
{{--                        </div>--}}

{{--                        <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-2 md:px-2 lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3">--}}

{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <button type="submit"--}}
{{--                            class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">--}}
{{--                        ADD ITEM--}}
{{--                    </button>--}}
{{--                    <a href="{{ route('dashboard') }}"--}}
{{--                       class="inline-flex items-center px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">--}}
{{--                        Cancel</a>--}}
{{--                </form>--}}
            </div>
            <form>
            <div class="p-4">
                <div>
                    <div style="background: #ffd966; height: 235px;padding-top: 1px;">
                        <div style="margin-top: 20px;margin-bottom: 20px;padding-left: 20px;">
                            <span>RFQ Information</span>
                            <hr style="border-top: 1px solid gray;width: 10%;">
                        </div>
                        <div style="margin-top: 20px;margin-bottom: 20px;padding-left: 20px;">
                            <span>JAVA coffee time</span>
                            <div>
                                <span>JAVA coffee time</span>
                            </div>
                            <div>
                                <span>JAVA coffee time</span>
                            </div>
                        </div>
                    </div>
{{--                    <div style="background: #ffd966; height: 235px;padding-top: 1px;">--}}
{{--                        <div style="margin-top: 20px;margin-bottom: 20px;padding-left: 20px;">--}}
{{--                            <span>RFQ Information</span>--}}
{{--                            <hr style="border-top: 1px solid gray;width: 10%;">--}}
{{--                        </div>--}}
{{--                        <div style="margin-top: 20px;margin-bottom: 20px;padding-left: 20px;">--}}
{{--                            <span>JAVA coffee time</span>--}}
{{--                            <div>--}}
{{--                                <span>JAVA coffee time</span>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <span>JAVA coffee time</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <hr>
            </div>
            </form>
        </div>
{{--        <div class="py-12">--}}
{{--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">--}}
{{--                        <div class="text-black text-2xl" style="text-align: center">--}}
{{--                            Your have reached daily RFQ generate limit.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

</x-app-layout>
