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

                    <form action="{{route('businessWarehouse.store')}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Step # 3: Business Warehouse </h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="name">Name @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="designation">Designation @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="warehouse_email">Warehouse Email @include('misc.required')</x-jet-label>
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                            <input type="hidden" name="business_id" value="{{auth()->user()->business_id}}">
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <select id="name" name="name" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                <option value="">None</option>
                                @foreach(\App\Models\User::where('business_id',auth()->user()->business_id)->get() as $user)
                                    <option value="{{$user->name}}">{{$user->name}}</option>
                                @endforeach
                            </select>

                            <select id="designation" name="designation" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                <option value="">None</option>
                                <option value="CEO">CEO</option>
                                @foreach(\App\Models\User::where('business_id',auth()->user()->business_id)->get() as $user)
                                    @if($user->id != auth()->user()->id)
                                        <option value="{{$user->designation}}">{{$user->designation}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-jet-input id="warehouse_email" type="email" name="warehouse_email" class="border p-2 w-1/2"></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="landline">Landline @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="mobile">Mobile @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="country">Country @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="address">Address @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="city">City @include('misc.required')</x-jet-label>
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
                            <x-jet-input id="address" type="text" name="address" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2"></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="longitude">Longitude</x-jet-label>
                            <x-jet-label class="w-1/2" for="latitude">Latitude</x-jet-label>
                            <x-jet-label class="w-1/2" for="warehouse_type">Warehouse Type @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="cold_storage">Cold Storage @include('misc.required')</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="longitude" type="text" name="longitude" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="latitude" name="latitude" type="text" class="border p-2 w-1/2"></x-jet-input>
                            <select name="warehouse_type" id="warehouse_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                <option value="example">Example</option>
                            </select>
                            <select name="cold_storage" id="cold_storage" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                <option value="">None</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="gate_type">Gate Type @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="fork_lift">Fork Lift @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="total_warehouse_manpower">Total Warehouse Manpower @include('misc.required')</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <select name="gate_type" id="gate_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                <option value="Example">Example</option>
                            </select>
                            <select name="fork_lift" id="fork_lift" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                            <x-jet-input id="total_warehouse_manpower" type="text" name="total_warehouse_manpower" class="border p-2 w-1/2"></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-label class="w-1/2" for="number_of_delivery_vehicles">Number of Delivery Vehicles @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="number_of_drivers">Number of Drivers @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="working_time">Working Time @include('misc.required')</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <select name="number_of_delivery_vehicles" id="number_of_delivery_vehicles" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                @for($count = 1; $count <= 100; $count++)
                                    <option value="{{$count}}">{{$count}}</option>
                                @endfor
                            </select>
                            <select name="number_of_drivers" id="number_of_drivers" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                @for($count = 1; $count <= 100; $count++)
                                    <option value="{{$count}}">{{$count}}</option>
                                @endfor
                            </select>
                            <x-jet-input id="working_time" type="text" name="working_time" class="border p-2 w-1/2"></x-jet-input>
                        </div>
                        <div class="control-group after-add-more">

                        </div>

                        <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>
                    </form>


                    {{-- <livewire:business-warehouse/> --}}
                    {{-- <x-jet-button class="float-left add-more mt-4 mb-4 bg-green-500">Add More</x-jet-button> --}}

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
