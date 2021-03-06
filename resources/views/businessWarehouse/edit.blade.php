@section('headerScripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script src="{{url('js/mapInput.js')}}"></script>
@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business Warehouse') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            @include('users.sessionMessage')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
                    <form action="{{route('businessWarehouse.update',$businessWarehouse->id)}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Step # 3: Business Warehouse</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="designation">Designation</x-jet-label>
                            <x-jet-label class="w-1/2" for="name">Name</x-jet-label>
                            <x-jet-label class="w-1/2" for="warehouse_email">Warehouse Email</x-jet-label>
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="designation" type="text" name="designation" class="border p-2 w-1/2" value="{{$businessWarehouse->designation}}"></x-jet-input>
                            <x-jet-input id="name" name="name" class="border p-2 w-1/2"  value="{{$businessWarehouse->name}}"></x-jet-input>
                            <x-jet-input id="warehouse_email" type="email" name="warehouse_email" class="border p-2 w-1/2" value="{{$businessWarehouse->warehouse_email}}"></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="landline">Landline</x-jet-label>
                            <x-jet-label class="w-1/2" for="mobile">Mobile</x-jet-label>
                            <x-jet-label class="w-1/2" for="country">Country</x-jet-label>
                            <x-jet-label class="w-1/2" for="address">Address</x-jet-label>
                            <x-jet-label class="w-1/2" for="city">City</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="chamber_reg_number" type="text" name="landline" class="border p-2 w-1/2" value="{{$businessWarehouse->landline}}"></x-jet-input>
                            <x-jet-input id="mobile" type="text" name="mobile" class="border p-2 w-1/2" value="{{$businessWarehouse->mobile}}"></x-jet-input>
                            <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                @foreach(\App\Models\User::countries() as $country)
                                    <option value="{{$country}}" {{($businessWarehouse->country == $country)?'selected':''}}>{{$country}}</option>
                                @endforeach
                            </select>
                            <x-jet-input id="city" type="text" name="address" class="border p-2 w-1/2" value="{{$businessWarehouse->address}}"></x-jet-input>
                            <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2" value="{{$businessWarehouse->city}}"></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="longitude">Longitude</x-jet-label>
                            <x-jet-label class="w-1/2" for="latitude">Latitude</x-jet-label>
                            <x-jet-label class="w-1/2" for="warehouse_type">Warehouse Type</x-jet-label>
                            <x-jet-label class="w-1/2" for="cold_storage">Cold Storage</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="longitude" type="text" readonly name="longitude" class="border p-2 w-1/2" value="{{$businessWarehouse->longitude}}"></x-jet-input>
                            <x-jet-input id="latitude" name="latitude" readonly type="text" class="border p-2 w-1/2" value="{{$businessWarehouse->latitude}}"></x-jet-input>
                            <select name="warehouse_type" id="warehouse_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                <option value="Powered" {{($businessWarehouse->warehouse_type == "Powered")?'selected':''}}>Powered</option>
                                <option value="Off Grid" {{($businessWarehouse->warehouse_type == "Off Grid")?'selected':''}}>Off Grid</option>
                                <option value="Non-Powered" {{($businessWarehouse->warehouse_type == "Non-Powered")?'selected':''}}>Non-Powered</option>
                            </select>
                            <select name="cold_storage" id="cold_storage" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                <option value="">None</option>
                                <option value="1"  {{($businessWarehouse->cold_storage == "1")?'selected':''}} >Yes</option>
                                <option value="0"  {{($businessWarehouse->cold_storage == "0")?'selected':''}} >No</option>
                            </select>
                        </div>

                        <br>
                        <p>Please use the map marker for your warehouse location.</p>
                        <br>
                        <div id="map" style="width:100%;height:400px; ">
                            <div style="width: 100%; height: 100%" id="address-map"></div>
                        </div>
                        <br>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="gate_type">Gate Type</x-jet-label>
                            <x-jet-label class="w-1/2" for="fork_lift">Fork Lift</x-jet-label>
                            <x-jet-label class="w-1/2" for="total_warehouse_manpower">Total Warehouse Manpower</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <select name="gate_type" id="gate_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                <option value="Automatic" {{($businessWarehouse->gate_type == "Automatic")?'selected':''}} >Automatic</option>
                                <option value="Manual" {{($businessWarehouse->gate_type == "Manual")?'selected':''}} >Manual</option>
                            </select>
                            <select name="fork_lift" id="fork_lift" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                <option value="1" {{($businessWarehouse->fork_lift == "1")?'selected':''}} >Available</option>
                                <option value="0" {{($businessWarehouse->fork_lift == "0")?'selected':''}} >Not Available</option>
                            </select>
                            <x-jet-input id="total_warehouse_manpower" type="text" name="total_warehouse_manpower" class="border p-2 w-1/2" value="{{$businessWarehouse->total_warehouse_manpower}}"></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-label class="w-1/2" for="number_of_delivery_vehicles">Number of Delivery Vehicles</x-jet-label>
                            <x-jet-label class="w-1/2" for="number_of_drivers">Number of Drivers</x-jet-label>
                            <x-jet-label class="w-1/2" for="working_time">Working Time</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <select name="number_of_delivery_vehicles" id="number_of_delivery_vehicles" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                @for($count = 1; $count <= 100; $count++)
                                    <option value="{{$count}}" {{($businessWarehouse->number_of_delivery_vehicles == $count)?'selected':''}} >{{$count}}</option>
                                @endfor
                            </select>
                            <select name="number_of_drivers" id="number_of_drivers" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                @for($count = 1; $count <= 100; $count++)
                                    <option value="{{$count}}" {{($businessWarehouse->number_of_drivers == $count)?'selected':''}}>{{$count}}</option>
                                @endfor
                            </select>
                            <x-jet-input id="working_time" type="text" name="working_time" value="{{$businessWarehouse->working_time}}" class="border p-2 w-1/2"></x-jet-input>
                        </div>
                        <div class="control-group after-add-more">

                        </div>

{{--                        @if(auth()->user()->hasRole('SuperAdmin'))--}}
                        <x-jet-button class="float-right mt-4 mb-4">Update</x-jet-button>
{{--                        @endif--}}
                        <a href="{{url('businessWarehouse/'.$businessWarehouse->business_id . '/show')}}" class=" float-right mt-5 px-5 m-2 text-blue-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-blue-700">Back</a>
                    </form>
                    <div class="flex space-x-2">

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
            $(".add-more").click(function () {
                var html = $(".copy").html();
                $(".after-add-more").after(html);
            });
            $("body").on("click", ".remove", function () {
                $(this).parents(".control-group").remove();
            });
        });
    </script>

</x-app-layout>
