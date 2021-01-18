@section('headerScripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{url('select2/src/select2totree.css')}}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{url('select2/src/select2totree.js')}}"></script>
@endsection
<x-app-layout>

    <form action="{{route('RFQ.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center sm:-mx-1 md:-mx-1 lg:-mx-1 xl:-mx-1 bg-white mb-0 py-2 px-4 mt-5 overflow-hidden shadow">
            <h2 class="text-2xl font-bold py-2">Request for Quotation</h2>
        </div>
        <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-1 lg:-mx-1 xl:-mx-1 bg-white mb-0 py-12 px-4 mt-5 overflow-hidden shadow">


            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <!-- Column Content -->
                <div class="px-2">
                    <label class="block font-medium text-sm text-gray-700 mb-1" for="item_name">
                        Item Name
                    </label>

                    @include('category.rfp')

                    <input type="hidden" value="{{$user->business_id}}" name="business_id">
                    <input type="hidden" value="{{$user->id}}" name="user_id">
                </div>
            </div>

            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <!-- Column Content -->
                <label class="block font-medium text-sm text-gray-700 mb-1" for="description">
                    Description
                </label>
                <input class="form-input rounded-md shadow-sm block w-full" id="description" type="text" autocomplete="description" name="description" required>
            </div>

            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <!-- Column Content -->
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

            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <!-- Column Content -->
                <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                    Size
                </label>
                <select name="size" id="size" class="form-select shadow-sm block w-full" required>
                    <option value="">None</option>
                    @for ($i = 1; $i < 100; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <!-- Column Content -->
                <label class="block font-medium text-sm text-gray-700 mb-1" for="quantity">
                    Quantity
                </label>
                <select name="quantity" id="quantity" class="form-select shadow-sm block w-full" required>
                    <option value="">None</option>
                    @for ($i = 1; $i < 100; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <label class="block font-medium text-sm text-gray-700 mb-1" for="brand">
                    Brand
                </label>
                <select name="brand" id="brand" class="form-select shadow-sm block w-full" required>
                    <option value="">None</option>
                    <option value="30 Days">30 Days</option>
                    <option value="60 Days">60 Days</option>
                    <option value="90 Days">90 Days</option>
                    <option value="Standard Order">Standard Order</option>
                </select>
            </div>

            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <!-- Column Content -->
                <label class="block font-medium text-sm text-gray-700 mb-1" for="last_price">
                    Last Price
                </label>
                <input class="form-input rounded-md shadow-sm block w-full" id="last_price" type="number" name="last_price" min="0" autocomplete="last_price" required>
            </div>

            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <!-- Column Content -->
                <label class="block font-medium text-sm text-gray-700 mb-1" for="remarks">
                    Remarks
                </label>
                <input class="form-input rounded-md shadow-sm block w-full" id="remarks" name="remarks" type="text" autocomplete="remarks" required>
            </div>

            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <!-- Column Content -->
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

            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <label class="block font-medium text-sm text-gray-700 mb-1" for="file">
                    Attachment (any picture)
                </label>
                <input class="form-input rounded-md shadow-sm block w-full" id="file" type="file" name="file_path_1" autocomplete="name">
            </div>

            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <!-- Column Content -->
            </div>

            <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
                <!-- Column Content -->
            </div>

        </div>
        <div class="flex flex-wrap -mx-px justify-end overflow-hidden sm:-mx-1 md:-mx-1 lg:-mx-1 xl:-mx-1 bg-white mb-0 py-4 px-4  overflow-hidden shadow">
            <button type="submit"
                    class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                ADD ITEM
            </button>
            <a href="{{route('dashboard')}}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                Cancel
            </a>
        </div>
    </form>

</x-app-layout>


