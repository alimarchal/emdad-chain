@section('headerScripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script src="{{url('js/mapInput.js')}}"></script>
@endsection
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Business Warehouse') }}
            </h2>
        </x-slot>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- component -->
                @if ($errors->any())
                    <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
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
                                        <option {{(old('name') == $user->name ? 'selected' : '')}} value="{{$user->name}}">{{$user->name}}</option>
                                    @endforeach
                                </select>

                                <select id="designation" name="designation" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">None</option>
                                    <option {{(old('designation') == 'CEO' ? 'selected' : '')}} value="CEO">CEO</option>
                                    @foreach(\App\Models\User::where('business_id',auth()->user()->business_id)->get() as $user)
                                        @if($user->id != auth()->user()->id)
                                            <option {{(old('designation') == $user->designation ? 'selected' : '')}} value="{{$user->designation}}">{{$user->designation}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-jet-input id="warehouse_email" type="email" name="warehouse_email" class="border p-2 w-1/2" value="{{old('warehouse_email')}}" required></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="landline">Landline @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">Mobile @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">Country @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">City @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="address">Address @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="chamber_reg_number" type="text" name="landline" class="border p-2 w-1/2" value="{{old('landline')}}" required></x-jet-input>
                                <x-jet-input id="mobile" type="text" name="mobile" class="border p-2 w-1/2" value="{{old('mobile')}}" required></x-jet-input>
                                <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">None</option>
                                    @foreach(\App\Models\User::countries() as $country)
                                        <option {{(old('country') == $country ? 'selected' : '')}} value="{{$country}}">{{$country}}</option>
                                    @endforeach
                                </select>
                                <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2" value="{{old('city')}}" required></x-jet-input>
                                <x-jet-input id="address" type="text" name="address" class="border p-2 w-1/2" value="{{old('address')}}" required></x-jet-input>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="latitude">Latitude  @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="longitude">Longitude  @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="warehouse_type">Warehouse Type @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="cold_storage">Cold Storage @include('misc.required')</x-jet-label>
                            </div>


                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="latitude"  required readonly name="latitude" type="text" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="longitude" required readonly  type="text" name="longitude" class="border p-2 w-1/2"></x-jet-input>
                                <select name="warehouse_type" id="warehouse_type" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">None</option>
                                    <option {{old('warehouse_type') == 'Powered' ? 'selected' : '' }} value="Powered">Powered</option>
                                    <option {{old('warehouse_type') == 'Off Grid' ? 'selected' : '' }} value="Off Grid">Off Grid</option>
                                    <option {{old('warehouse_type') == 'Non-Powered' ? 'selected' : '' }} value="Non-Powered">Non-Powered</option>
                                </select>
                                <select name="cold_storage" id="cold_storage" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option {{old('cold_storage') == '' ? 'selected' : '' }} value="">None</option>
                                    <option {{old('cold_storage') == '1' ? 'selected' : '' }} value="1">Yes</option>
                                    <option  {{old('cold_storage') == '0' ? 'selected' : '' }} value="0">No</option>
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
                                <x-jet-label class="w-1/2" for="gate_type">Gate Type @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="fork_lift">Fork Lift @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="total_warehouse_manpower">Total Warehouse Manpower @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <select name="gate_type" id="gate_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">None</option>
                                    <option {{(old('gate_type') == 'Automatic' ? 'selected' : '') }} value="Automatic">Automatic</option>
                                    <option {{(old('gate_type') == 'Manual' ? 'selected' : '') }} value="Manual">Manual</option>
                                </select>
                                <select name="fork_lift" id="fork_lift" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">None</option>
                                    <option {{(old('fork_lift') == '1' ? 'selected' : '' )}} value="1">Available</option>
                                    <option {{(old('fork_lift') == '0' ? 'selected' : '' )}} value="0">Not Available</option>
                                </select>
                                <x-jet-input id="total_warehouse_manpower" type="text" name="total_warehouse_manpower" class="border p-2 w-1/2" value="{{old('total_warehouse_manpower')}}" required></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                @if(auth()->user()->registration_type == 'Supplier')
                                    <x-jet-label class="w-1/2" for="number_of_delivery_vehicles">Number of Delivery Vehicles @include('misc.required')</x-jet-label>
                                    <x-jet-label class="w-1/2" for="number_of_drivers">Number of Drivers @include('misc.required')</x-jet-label>
                                @endif
                                <x-jet-label class="w-1/4" for="working_time">From (Delivery Receiving Time) @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/4" for="working_time">To (Delivery Receiving Time) @include('misc.required')</x-jet-label>
                            </div>


                            <div class="flex space-x-5 mt-3">
                                @if(auth()->user()->registration_type == 'Supplier')
                                    <select name="number_of_delivery_vehicles" id="number_of_delivery_vehicles" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                        <option value="">None</option>
                                        @for($count = 1; $count <= 100; $count++)
                                            <option {{(old('number_of_delivery_vehicles') == $count ? 'selected' : '')}} value="{{$count}}">{{$count}}</option>
                                        @endfor
                                    </select>
                                    <select name="number_of_drivers" id="number_of_drivers" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                        <option value="">None</option>
                                        @for($count = 1; $count <= 100; $count++)
                                            <option {{(old('number_of_drivers') == $count ? 'selected' : '')}} value="{{$count}}">{{$count}}</option>
                                        @endfor
                                    </select>
                                @endif

                                <select name="working_time" id="working_time" class="form-select rounded-md shadow-sm border p-2 w-1/4" required>
                                    <option value="">None</option>
                                    @for($count = 0; $count <= 23; $count++)
                                        <option {{(old('working_time') == $count.":00" ? 'selected' : '')}} value="{{$count}}:00">{{$count}}:00</option>
                                    @endfor
                                </select>

                                <select name="working_time_1" id="working_time_1" class="form-select rounded-md shadow-sm border p-2 w-1/4" required>
                                    <option value="">None</option>
                                    @for($count = 0; $count <= 23; $count++)
                                        <option {{(old('working_time_1') == $count.":00" ? 'selected' : '')}} value="{{$count}}:00">{{$count}}:00</option>
                                    @endfor
                                </select>
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
@else
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
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm" style="direction: rtl">

                        <form action="{{route('businessWarehouse.store')}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">الخطوة الثالثة: المستودعات</h3>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="name">الاسم@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="designation">الوصف@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="warehouse_email">البريد الإلكتروني للمستودع@include('misc.required')</x-jet-label>
                                <input type="hidden" name="user_id[]" value="{{Auth::user()->id}}">
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <select id="name" name="name[]" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">None</option>
                                    @foreach(\App\Models\User::where('business_id',auth()->user()->business_id)->get() as $user)
                                        <option value="{{$user->name . ':' . $user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>

                                <select id="designation" name="designation[]" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">None</option>
                                    <option value="CEO">CEO</option>
                                    @foreach(\App\Models\User::where('business_id',auth()->user()->business_id)->get() as $user)
                                        @if($user->id != auth()->user()->id)
                                            <option value="{{$user->designation}}">{{$user->designation}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-jet-input id="warehouse_email" type="email" name="warehouse_email[]" class="border p-2 w-1/2"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="landline">رقم الهاتف الثابت@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">رقم الجوال@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">الدولة@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="address">العنوان@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">المدينة@include('misc.required')</x-jet-label>
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
                                <x-jet-input id="address" type="text" name="address" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="city" type="text" name="city[]" class="border p-2 w-1/2"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="longitude">خط الطول</x-jet-label>
                                <x-jet-label class="w-1/2" for="latitude">خط العرض</x-jet-label>
                                <x-jet-label class="w-1/2" for="warehouse_type">نوع المستودع@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="cold_storage">تخزين مبرّ@include('misc.required')د</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="longitude" required readonly type="text" name="longitude[]" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="latitude" required readonly name="latitude[]" type="text" class="border p-2 w-1/2"></x-jet-input>
                                <select name="warehouse_type[]" id="warehouse_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">None</option>
                                    <option value="example">Example</option>
                                </select>
                                <select name="cold_storage[]" id="cold_storage" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">None</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="gate_type">نوع البوابة@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="fork_lift">رافعة شوكية@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="total_warehouse_manpower">مجموع العاملين في المستودع@include('misc.required')</x-jet-label>
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
                                <x-jet-input id="total_warehouse_manpower" type="text" name="total_warehouse_manpower[]" class="border p-2 w-1/2"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                @if(auth()->user()->registration_type == 'Supplier')
                                <x-jet-label class="w-1/2" for="number_of_delivery_vehicles">عدد عربات التوصيل@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="number_of_drivers">عدد السائقين@include('misc.required')</x-jet-label>
                                @endif
                                <x-jet-label class="w-1/2" for="working_time">أوقات العمل@include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="working_time">To @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                @if(auth()->user()->registration_type == 'Supplier')
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
                                @endif
                                <select name="working_time" id="working_time" class="form-select rounded-md shadow-sm border p-2 w-1/4" required>
                                    <option value="">None</option>
                                    @for($count = 0; $count <= 23; $count++)
                                        <option value="{{$count}}:00">{{$count}}:00</option>
                                    @endfor
                                </select>

                                <select name="working_time_1" id="working_time_1" class="form-select rounded-md shadow-sm border p-2 w-1/4" required>
                                    <option value="">None</option>
                                    @for($count = 0; $count <= 23; $count++)
                                        <option value="{{$count}}:00">{{$count}}:00</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="control-group after-add-more">

                            </div>

                            <br>
                            <div id="map" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>

                            <x-jet-button class="float-right mt-4 mb-4">حفظ، التالي</x-jet-button>
                        </form>


{{--                        <livewire:business-warehouse/>--}}
{{--                        <x-jet-button class="float-left add-more mt-4 mb-4 bg-green-500">أضف أخرى</x-jet-button>--}}

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
@endif
