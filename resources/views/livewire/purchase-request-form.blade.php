<div>
    {{-- //action="{{route('RFQ.store')}}" --}}
    {{-- <livewire:purchase-request-form :parentCategories="$parentCategories" :childs="$childs" :user="$user" /> --}}
    
    <form  method="POST" enctype="multipart/form-data"  wire:submit.prevent="submit">
        @csrf
        <div
        class="flex justify-center sm:-mx-1 md:-mx-1 lg:-mx-1 xl:-mx-1 bg-white mb-0 py-2 px-4 mt-5 overflow-hidden shadow">
        <h2 class="text-2xl font-bold py-2">Request for Quotation</h2>
    </div>
    <div class="flex flex-wrap -mx-px overflow-hidden sm:-mx-1 md:-mx-1 lg:-mx-1 xl:-mx-1 bg-white mb-0 py-12 px-4 mt-5 overflow-hidden shadow">
        <div class="w-full overflow-hidden">
            <!-- Column Content -->
            @include('category.rfp')
        </div>
        <br>
        <br>
        <div class="w-full overflow-hidden">
            <label class="block font-medium text-sm text-gray-700 mb-1" for="description">
                Description
            </label>
            <textarea name="description" id="description"></textarea>
            <input type="hidden" value="{{$user->business_id}}" name="business_id">
            <input type="hidden" value="{{$user->id}}" name="user_id">
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
            <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="size" min="0" autocomplete="size" required>
            {{-- <select name="size" id="size" class="form-select shadow-sm block w-full" required>
                <option value="">None</option>
                @for ($i = 1; $i < 100; $i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select> --}}
        </div>
        
        <div
        class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
        <!-- Column Content -->
        <label class="block font-medium text-sm text-gray-700 mb-1" for="quantity">
            Quantity (Units)
        </label>
        <input class="form-input rounded-md shadow-sm block w-full" id="quantity" type="number" name="quantity"
        min="0" autocomplete="quantity" required>
    </div>
    
    <div class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
        <label class="block font-medium text-sm text-gray-700 mb-1" for="brand">
            Brand
        </label>
        <input class="form-input rounded-md shadow-sm block w-full" id="brand" type="text" name="brand" min="0"
        autocomplete="brand" required>
        {{-- <select name="brand" id="brand" class="form-select shadow-sm block w-full" required>
            <option value="">None</option>
            <option value="30 Days">30 Days</option>
            <option value="60 Days">60 Days</option>
            <option value="90 Days">90 Days</option>
            <option value="Standard Order">Standard Order</option>
        </select> --}}
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
    
    
    
    <div
    class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
    <!-- Column Content -->
    <label class="block font-medium text-sm text-gray-700 mb-1" for="required_sample">
        Required Sample
    </label>
    <select name="required_sample" id="required_sample" class="form-select shadow-sm block w-full" required>
        <option value="">None</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select>
</div>


<div
class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
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

<div
class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
<label class="block font-medium text-sm text-gray-700 mb-1" for="file">
    Attachment (any picture)
</label>
<input class="form-input rounded-md shadow-sm block w-full" id="file" type="file" name="file_path_1"
autocomplete="name">
</div>



<div
class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
<!-- Column Content -->
</div>

<div
class="my-px px-px w-full overflow-hidden sm:my-1 sm:px-1 md:my-1 md:px-1 lg:my-1 lg:px-1 lg:w-1/3 xl:my-1 pb-3 xl:px-1">
<!-- Column Content -->
</div>

</div>
<div
class="flex flex-wrap -mx-px justify-end overflow-hidden sm:-mx-1 md:-mx-1 lg:-mx-1 xl:-mx-1 bg-white mb-0 py-4 px-4  overflow-hidden shadow">
<button type="submit"
class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
ADD ITEM
</button>
<a href="{{route('dashboard')}}"
class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
Cancel</a>
</div>
</form>
</div>