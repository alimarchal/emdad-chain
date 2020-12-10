<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }} Mr.
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            @include('users.sessionMessage')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action="{{url('business')}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Business Warehouses</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="designation">Designation</x-jet-label>
                            <x-jet-label class="w-1/2" for="name">Name</x-jet-label>
                            <x-jet-label class="w-1/2" for="warehouse_email">Warehouse Email</x-jet-label>
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="designation" type="text" name="designation" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="name" name="name" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="warehouse_email" type="email" name="warehouse_email" class="border p-2 w-1/2"></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="landline">Landline</x-jet-label>
                            <x-jet-label class="w-1/2" for="mobile">Mobile</x-jet-label>
                            <x-jet-label class="w-1/2" for="country">Country</x-jet-label>
                            <x-jet-label class="w-1/2" for="city">City</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="chamber_reg_number" type="text" name="landline" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="mobile" type="text" name="mobile" class="border p-2 w-1/2"></x-jet-input>
                            <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                @foreach(\App\Models\User::countries() as $country)
                                    <option value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                            <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2"></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="longitude">Longitude</x-jet-label>
                            <x-jet-label class="w-1/2" for="latitude">Latitude</x-jet-label>
                            <x-jet-label class="w-1/2" for="warehouse_type">Warehouse Type</x-jet-label>
                            <x-jet-label class="w-1/2" for="cold_storage">Cold Storage</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="longitude" type="text" name="longitude" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="latitude" name="latitude" type="text" class="border p-2 w-1/2"></x-jet-input>
                            <select name="warehouse_type" id="warehouse_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                @foreach(\App\Models\User::countries() as $country)
                                    <option value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                            <select name="cold_storage" id="cold_storage" class="form-input rounded-md shadow-sm border p-2 w-1/2">
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
                            <select name="gate_type" id="gate_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                @foreach(\App\Models\User::countries() as $country)
                                    <option value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                            <select name="fork_lift" id="fork_lift" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                @foreach(\App\Models\User::countries() as $country)
                                    <option value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                            <x-jet-input id="total_warehouse_manpower" type="text" name="total_warehouse_manpower" class="border p-2 w-1/2"></x-jet-input>

                        </div>


                        <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
