<div class="copy hidden">
    <div class="control-group">
        {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
        <hr class="mt-5">
        <a class="float-left float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray remove disabled:opacity-25 transition ease-in-out duration-150 float-left mt-4 mb-4 bg-red-500">Delete</a>
        <br>
        <br>
        <hr class="mb-3 mt-4">
        <div class="flex space-x-5 mt-3">
            <x-jet-label class="w-1/2" for="designation">Designation</x-jet-label>
            <x-jet-label class="w-1/2" for="name">Name</x-jet-label>
            <x-jet-label class="w-1/2" for="warehouse_email">Warehouse Email</x-jet-label>
            <input type="hidden" name="user_id[]" value="{{Auth::user()->id}}">
        </div>
        <div class="flex space-x-5 mt-3">
            <x-jet-input id="designation" type="text" name="designation[]" class="border p-2 w-1/2"></x-jet-input>
            <x-jet-input id="name" name="name[]" class="border p-2 w-1/2"></x-jet-input>
            <x-jet-input id="warehouse_email" type="email" name="warehouse_email[]" class="border p-2 w-1/2"></x-jet-input>
        </div>
        <div class="flex space-x-5 mt-3">
            <x-jet-label class="w-1/2" for="landline">Landline</x-jet-label>
            <x-jet-label class="w-1/2" for="mobile">Mobile</x-jet-label>
            <x-jet-label class="w-1/2" for="country">Country</x-jet-label>
            <x-jet-label class="w-1/2" for="city">City</x-jet-label>
        </div>
        <div class="flex space-x-5 mt-3">
            <x-jet-input id="chamber_reg_number" type="text" name="landline[]" class="border p-2 w-1/2"></x-jet-input>
            <x-jet-input id="mobile" type="text" name="mobile[]" class="border p-2 w-1/2"></x-jet-input>
            <select name="country[]" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                <option value="">None</option>
                @foreach(\App\Models\User::countries() as $country)
                    <option value="{{$country}}">{{$country}}</option>
                @endforeach
            </select>
            <x-jet-input id="city" type="text" name="city[]" class="border p-2 w-1/2"></x-jet-input>
        </div>
        <div class="flex space-x-5 mt-3">
            <x-jet-label class="w-1/2" for="longitude">Longitude</x-jet-label>
            <x-jet-label class="w-1/2" for="latitude">Latitude</x-jet-label>
            <x-jet-label class="w-1/2" for="warehouse_type">Warehouse Type</x-jet-label>
            <x-jet-label class="w-1/2" for="cold_storage">Cold Storage</x-jet-label>
        </div>
        <div class="flex space-x-5 mt-3">
            <x-jet-input id="longitude" type="text" name="longitude[]" class="border p-2 w-1/2"></x-jet-input>
            <x-jet-input id="latitude" name="latitude[]" type="text" class="border p-2 w-1/2"></x-jet-input>
            <select name="warehouse_type[]" id="warehouse_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                <option value="">None</option>
                @foreach(\App\Models\User::countries() as $country)
                    <option value="{{$country}}">{{$country}}</option>
                @endforeach
            </select>
            <select name="cold_storage[]" id="cold_storage" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                <option value="">None</option>
                @foreach(\App\Models\User::countries() as $country)
                    <option value="{{$country}}">{{$country}}</option>
                @endforeach
            </select>
        </div>
        <div class="flex space-x-5 mt-3">
            <x-jet-label class="w-1/2" for="gate_type">Gate Type</x-jet-label>
            <x-jet-label class="w-1/2" for="fork_lift">Fork Lift</x-jet-label>
            <x-jet-label class="w-1/2" for="total_warehouse_manpower">Total Warehouse Manpower</x-jet-label>
        </div>
        <div class="flex space-x-5 mt-3">
            <select name="gate_type[]" id="gate_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                <option value="">None</option>
                @foreach(\App\Models\User::countries() as $country)
                    <option value="{{$country}}">{{$country}}</option>
                @endforeach
            </select>
            <select name="fork_lift[]" id="fork_lift" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                <option value="">None</option>
                <option value="1">Available</option>
                <option value="0">Not Available</option>
            </select>
            <x-jet-input id="total_warehouse_manpower" type="text" name="total_warehouse_manpower[]" class="border p-2 w-1/2"></x-jet-input>
        </div>

        <div class="flex space-x-5 mt-3">

            <x-jet-label class="w-1/2" for="number_of_delivery_vehicles">Number of Delivery Vehicles</x-jet-label>
            <x-jet-label class="w-1/2" for="number_of_drivers">Number of Drivers</x-jet-label>
            <x-jet-label class="w-1/2" for="working_time">Working Time</x-jet-label>
        </div>
        <div class="flex space-x-5 mt-3">
            <select name="number_of_delivery_vehicles[]" id="number_of_delivery_vehicles" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                <option value="">None</option>
                @for($count = 1; $count <= 100; $count++)
                    <option value="{{$count}}">{{$count}}</option>
                @endfor
            </select>
            <select name="number_of_drivers[]" id="number_of_drivers" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                <option value="">None</option>
                @for($count = 1; $count <= 100; $count++)
                    <option value="{{$count}}">{{$count}}</option>
                @endfor
            </select>
            <x-jet-input id="working_time" type="text" name="working_time[]" class="border p-2 w-1/2"></x-jet-input>
        </div>
    </div>
</div>