@section('headerScripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
    <script src="{{url('js/mapInput.js')}}"></script>
@endsection

@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Business Warehouse') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
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
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
                        <form action="{{route('businessWarehouse.update',$businessWarehouse->id)}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Step # 3: Business Warehouse')}}</h3>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-2/3" for="name">{{__('portal.Warehouse Name')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="warehouse_name" type="text" name="warehouse_name" class="border p-2 w-1/2" value="{{$businessWarehouse->warehouse_name}}" required></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="name">{{__('portal.Responsible person')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="designation" style="padding-left: 29px;">{{__('portal.Designation')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="warehouse_email">{{__('portal.Warehouse Email')}} @include('misc.required')</x-jet-label>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <select id="name" name="name" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach(\App\Models\User::where('business_id',auth()->user()->business_id)->get() as $user)
                                        <option {{($businessWarehouse->name == $user->name ? 'selected' : '')}} value="{{$user->name}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <i class="fa fa-user-plus mt-2" title="{{__('portal.Add User')}}" ></i>
                                <select id="designation" name="designation" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    <option {{($businessWarehouse->designation == 'CEO' ? 'selected' : '')}} value="CEO">{{__('portal.CEO')}}</option>
                                    @foreach(\App\Models\User::where('business_id',auth()->user()->business_id)->get() as $user)
                                        @if($user->id != auth()->user()->id)
                                            <option {{($businessWarehouse->designation == $user->designation ? 'selected' : '')}} value="{{$user->designation}}">{{$user->designation}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-jet-input id="warehouse_email" type="email" name="warehouse_email" class="border p-2 w-1/2" value="{{$businessWarehouse->warehouse_email}}"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="landline">{{__('portal.Landline')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">{{__('portal.Mobile')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">{{__('portal.Country')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">{{__('portal.City')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="address">{{__('portal.Address')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="chamber_reg_number" type="text" name="landline" class="border p-2 w-1/2" value="{{$businessWarehouse->landline}}"></x-jet-input>
                                <x-jet-input id="mobile" type="number"
                                             oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                             name="mobile" class="border p-2 w-1/2" maxlength="9" value="{{$businessWarehouse->mobile}}" required></x-jet-input>
                                <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach(\App\Models\User::countries() as $country)
                                        <option value="{{$country}}" {{($businessWarehouse->country == $country)?'selected':''}}>{{$country}}</option>
                                    @endforeach
                                </select>
                                <select name="city" id="city" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach (\App\Models\City::all() as $city)
                                        <option {{($businessWarehouse->city ==  $city->name_en ? 'selected' : '')}} value="{{ $city->name_en }}">{{ $city->name_en . ' - ' . $city->name_ar }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input id="city" type="text" name="address" class="border p-2 w-1/2" value="{{$businessWarehouse->address}}"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="longitude">{{__('portal.Longitude')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="latitude">{{__('portal.Latitude')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="warehouse_type">{{__('portal.Warehouse Type')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="cold_storage">{{__('portal.Cold Storage')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="longitude" type="text" readonly name="longitude" class="border p-2 w-1/2" value="{{$businessWarehouse->longitude}}"></x-jet-input>
                                <x-jet-input id="latitude" name="latitude" readonly type="text" class="border p-2 w-1/2" value="{{$businessWarehouse->latitude}}"></x-jet-input>
                                <select name="warehouse_type" id="warehouse_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">{{__('portal.Select')}}</option>
                                    <option value="Powered" {{($businessWarehouse->warehouse_type == "Powered")?'selected':''}}>{{__('portal.Powered')}}</option>
                                    <option value="Off Grid" {{($businessWarehouse->warehouse_type == "Off Grid")?'selected':''}}>{{__('portal.Off Grid')}}</option>
                                    <option value="Non-Powered" {{($businessWarehouse->warehouse_type == "Non-Powered")?'selected':''}}>{{__('portal.Non-Powered')}}</option>
                                </select>
                                <select name="cold_storage" id="cold_storage" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    <option value="1"  {{($businessWarehouse->cold_storage == "1")?'selected':''}} >{{__('portal.Yes')}}</option>
                                    <option value="0"  {{($businessWarehouse->cold_storage == "0")?'selected':''}} >{{__('portal.No')}}</option>
                                </select>
                            </div>

                            <br>
                            <p class="text-blue-700">{{__('portal.Please use the map marker for your warehouse location.')}}</p>
                            <br>
                            <div id="map" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>
                            <br>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="gate_type">{{__('portal.Gate Type')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="fork_lift">{{__('portal.Fork Lift')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="total_warehouse_manpower">{{__('portal.Total Warehouse Manpower')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <select name="gate_type" id="gate_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">{{__('portal.Select')}}</option>
                                    <option value="Automatic" {{($businessWarehouse->gate_type == "Automatic")?'selected':''}} >{{__('portal.Automatic')}}</option>
                                    <option value="Manual" {{($businessWarehouse->gate_type == "Manual")?'selected':''}} >{{__('portal.Manual')}}</option>
                                </select>
                                <select name="fork_lift" id="fork_lift" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">{{__('portal.Select')}}</option>
                                    <option value="1" {{($businessWarehouse->fork_lift == "1")?'selected':''}} >{{__('portal.Available')}}</option>
                                    <option value="0" {{($businessWarehouse->fork_lift == "0")?'selected':''}} >{{__('portal.Not Available')}}</option>
                                </select>
                                <x-jet-input id="total_warehouse_manpower" type="text" name="total_warehouse_manpower" class="border p-2 w-1/2" value="{{$businessWarehouse->total_warehouse_manpower}}"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                @if(auth()->user()->registration_type == 'Supplier')
                                <x-jet-label class="w-1/2" for="number_of_delivery_vehicles">{{__('portal.Number of Delivery Vehicles')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="number_of_drivers">{{__('portal.Number of Drivers')}} @include('misc.required')</x-jet-label>
                                @endif
                                <x-jet-label class="w-1/4" for="working_time">{{__('portal.From (Delivery Receiving Time)')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/4" for="working_time">{{__('portal.To (Delivery Receiving Time)')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                @if(auth()->user()->registration_type == 'Supplier')
                                <select name="number_of_delivery_vehicles" id="number_of_delivery_vehicles" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">{{__('portal.Select')}}</option>
                                    @for($count = 1; $count <= 100; $count++)
                                        <option value="{{$count}}" {{($businessWarehouse->number_of_delivery_vehicles == $count)?'selected':''}} >{{$count}}</option>
                                    @endfor
                                </select>
                                <select name="number_of_drivers" id="number_of_drivers" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">{{__('portal.Select')}}</option>
                                    @for($count = 1; $count <= 100; $count++)
                                        <option value="{{$count}}" {{($businessWarehouse->number_of_drivers == $count)?'selected':''}}>{{$count}}</option>
                                    @endfor
                                </select>
                                @endif
                                @php $working_time = explode('-',$businessWarehouse->working_time);
                                        $working_time_1 = $working_time[0];
                                        $working_time_2 = $working_time[1];
                                @endphp
                                <select name="working_time" id="working_time" class="form-select rounded-md shadow-sm border p-2 w-1/4" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @for($count = 0; $count <= 23; $count++)
                                        <option {{(trim($working_time_1) == $count.":00" ? 'selected' : '')}} value="{{$count}}:00">{{$count}}:00</option>
                                    @endfor
                                </select>

                                <select name="working_time_1" id="working_time_1" class="form-select rounded-md shadow-sm border p-2 w-1/4" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @for($count = 0; $count <= 23; $count++)
                                        <option {{(trim($working_time_2) == $count.":00" ? 'selected' : '')}} value="{{$count}}:00">{{$count}}:00</option>
                                    @endfor
                                </select>
{{--                                <x-jet-input id="working_time" type="text" name="working_time" value="{{$businessWarehouse->working_time}}" class="border p-2 w-1/2"></x-jet-input>--}}
                            </div>
                            <div class="control-group after-add-more">

                            </div>

                            {{--                        @if(auth()->user()->hasRole('SuperAdmin'))--}}
                            <x-jet-button class="float-right mt-4 mb-4">{{__('portal.Update')}}</x-jet-button>
                            {{--                        @endif--}}
                            {{--                        <a href="{{url('businessWarehouse/'.$businessWarehouse->business_id . '/show')}}" class=" float-right mt-5 px-5 m-2 text-blue-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-blue-700">Back</a>--}}
                            <a href="{{url('businessWarehouse/'.$businessWarehouse->business_id . '/show')}}" style="background-color: #145EA8" class="inline-flex float-right items-center mt-4 mr-2 px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                {{__('portal.Back')}}
                            </a>
                        </form>
                        <div class="flex space-x-2">
                        </div>
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Business Warehouse') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
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
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <img src="{{url('registration_step/2.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
                        <form action="{{route('businessWarehouse.update',$businessWarehouse->id)}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Step # 3: Business Warehouse')}}</h3>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-2/3" for="name">{{__('portal.Warehouse Name')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="warehouse_name" type="text" name="warehouse_name" class="border p-2 w-1/2" value="{{$businessWarehouse->warehouse_name}}" required></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="name">{{__('portal.Responsible person')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="designation" style="padding-right: 44px;">{{__('portal.Designation')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="warehouse_email">{{__('portal.Warehouse Email')}} @include('misc.required')</x-jet-label>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <select id="name" name="name" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach(\App\Models\User::where('business_id',auth()->user()->business_id)->get() as $user)
                                        <option {{($businessWarehouse->name == $user->name ? 'selected' : '')}} value="{{$user->name}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <i class="fa fa-user-plus mt-2" title="{{__('portal.Add User')}}" style="padding-right: 11px;"></i>
                                <select id="designation" name="designation" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    <option {{($businessWarehouse->designation == 'CEO' ? 'selected' : '')}} value="CEO">{{__('portal.CEO')}}</option>
                                    @foreach(\App\Models\User::where('business_id',auth()->user()->business_id)->get() as $user)
                                        @if($user->id != auth()->user()->id)
                                            <option {{($businessWarehouse->designation == $user->designation ? 'selected' : '')}} value="{{$user->designation}}">{{$user->designation}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-jet-input id="warehouse_email" type="email" name="warehouse_email" class="border p-2 w-1/2" value="{{$businessWarehouse->warehouse_email}}"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="landline">{{__('portal.Landline')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">{{__('portal.Mobile')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">{{__('portal.Country')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">{{__('portal.City')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="address">{{__('portal.Address')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="chamber_reg_number" type="text" name="landline" class="border p-2 w-1/2" value="{{$businessWarehouse->landline}}"></x-jet-input>
                                <x-jet-input id="mobile" type="number"
                                             oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                             name="mobile" class="border p-2 w-1/2" value="{{$businessWarehouse->mobile}}" maxlength="9"  style="margin-right: 5px;" required></x-jet-input>
                                <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach(\App\Models\User::countries() as $country)
                                        <option value="{{$country}}" {{($businessWarehouse->country == $country)?'selected':''}}>{{$country}}</option>
                                    @endforeach
                                </select>
                                <select name="city" id="city" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach (\App\Models\City::all() as $city)
                                        <option {{($businessWarehouse->city ==  $city->name_en ? 'selected' : '')}} value="{{ $city->name_en }}">{{ $city->name_ar }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input id="city" type="text" name="address" class="border p-2 w-1/2" value="{{$businessWarehouse->address}}"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="longitude">{{__('portal.Longitude')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="latitude">{{__('portal.Latitude')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="warehouse_type">{{__('portal.Warehouse Type')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="cold_storage">{{__('portal.Cold Storage')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="longitude" type="text" readonly name="longitude" class="border p-2 w-1/2" value="{{$businessWarehouse->longitude}}"></x-jet-input>
                                <x-jet-input id="latitude" name="latitude" readonly type="text" class="border p-2 w-1/2" value="{{$businessWarehouse->latitude}}" style="margin-right: 5px;"></x-jet-input>
                                <select name="warehouse_type" id="warehouse_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">{{__('portal.Select')}}</option>
                                    <option value="Powered" {{($businessWarehouse->warehouse_type == "Powered")?'selected':''}}>{{__('portal.Powered')}}</option>
                                    <option value="Off Grid" {{($businessWarehouse->warehouse_type == "Off Grid")?'selected':''}}>{{__('portal.Off Grid')}}</option>
                                    <option value="Non-Powered" {{($businessWarehouse->warehouse_type == "Non-Powered")?'selected':''}}>{{__('portal.Non-Powered')}}</option>
                                </select>
                                <select name="cold_storage" id="cold_storage" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    <option value="1"  {{($businessWarehouse->cold_storage == "1")?'selected':''}} >{{__('portal.Yes')}}</option>
                                    <option value="0"  {{($businessWarehouse->cold_storage == "0")?'selected':''}} >{{__('portal.No')}}</option>
                                </select>
                            </div>

                            <br>
                            <p class="text-blue-700">{{__('portal.Please use the map marker for your warehouse location.')}}</p>
                            <br>
                            <div id="map" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>
                            <br>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="gate_type">{{__('portal.Gate Type')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="fork_lift">{{__('portal.Fork Lift')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="total_warehouse_manpower">{{__('portal.Total Warehouse Manpower')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <select name="gate_type" id="gate_type" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">{{__('portal.Select')}}</option>
                                    <option value="Automatic" {{($businessWarehouse->gate_type == "Automatic")?'selected':''}} >{{__('portal.Automatic')}}</option>
                                    <option value="Manual" {{($businessWarehouse->gate_type == "Manual")?'selected':''}} >{{__('portal.Manual')}}</option>
                                </select>
                                <select name="fork_lift" id="fork_lift" class="form-input rounded-md shadow-sm border p-2 w-1/2" style="margin-right: 5px;">
                                    <option value="">{{__('portal.Select')}}</option>
                                    <option value="1" {{($businessWarehouse->fork_lift == "1")?'selected':''}} >{{__('portal.Available')}}</option>
                                    <option value="0" {{($businessWarehouse->fork_lift == "0")?'selected':''}} >{{__('portal.Not Available')}}</option>
                                </select>
                                <x-jet-input id="total_warehouse_manpower" type="text" name="total_warehouse_manpower" class="border p-2 w-1/2" value="{{$businessWarehouse->total_warehouse_manpower}}"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                @if(auth()->user()->registration_type == 'Supplier')
                                <x-jet-label class="w-1/2" for="number_of_delivery_vehicles">{{__('portal.Number of Delivery Vehicles')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/2" for="number_of_drivers">{{__('portal.Number of Drivers')}} @include('misc.required')</x-jet-label>
                                @endif
                                <x-jet-label class="w-1/4" for="working_time">{{__('portal.From (Delivery Receiving Time)')}} @include('misc.required')</x-jet-label>
                                <x-jet-label class="w-1/4 px-2" for="working_time">{{__('portal.To (Delivery Receiving Time)')}} @include('misc.required')</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                @if(auth()->user()->registration_type == 'Supplier')
                                <select name="number_of_delivery_vehicles" id="number_of_delivery_vehicles" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                    <option value="">{{__('portal.Select')}}</option>
                                    @for($count = 1; $count <= 100; $count++)
                                        <option value="{{$count}}" {{($businessWarehouse->number_of_delivery_vehicles == $count)?'selected':''}} >{{$count}}</option>
                                    @endfor
                                </select>
                                <select name="number_of_drivers" id="number_of_drivers" class="form-input rounded-md shadow-sm border p-2 w-1/2" style="margin-right: 5px;">
                                    <option value="">{{__('portal.Select')}}</option>
                                    @for($count = 1; $count <= 100; $count++)
                                        <option value="{{$count}}" {{($businessWarehouse->number_of_drivers == $count)?'selected':''}}>{{$count}}</option>
                                    @endfor
                                </select>
                                @endif
                                @php $working_time = explode('-',$businessWarehouse->working_time);
                                    $working_time_1 = $working_time[0];
                                    $working_time_2 = $working_time[1];
                                @endphp
                                <select name="working_time" id="working_time" class="form-select mb-2 rounded-md shadow-sm block w-1/4" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @for($count = 0; $count <= 23; $count++)
                                        <option {{(trim($working_time_1) == $count.":00" ? 'selected' : '')}} value="{{$count}}:00">{{$count}}:00</option>
                                    @endfor
                                </select>

                                <select name="working_time_1" id="working_time_1" class="form-select mb-2 rounded-md shadow-sm block w-1/4" style="margin-right: 6px;" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @for($count = 0; $count <= 23; $count++)
                                        <option {{(trim($working_time_2) == $count.":00" ? 'selected' : '')}} value="{{$count}}:00">{{$count}}:00</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="control-group after-add-more">

                            </div>

                            {{--                        @if(auth()->user()->hasRole('SuperAdmin'))--}}
                            <x-jet-button class="float-right mt-4 mb-4">{{__('portal.Update')}}</x-jet-button>
                            {{--                        @endif--}}
                            {{--                        <a href="{{url('businessWarehouse/'.$businessWarehouse->business_id . '/show')}}" class=" float-right mt-5 px-5 m-2 text-blue-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-blue-700">Back</a>--}}
                            <a href="{{url('businessWarehouse/'.$businessWarehouse->business_id . '/show')}}" style="background-color: #145EA8" class="inline-flex float-right items-center mt-4 mr-2 px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                {{__('portal.Back')}}
                            </a>
                        </form>
                        <div class="flex space-x-2">
                        </div>
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
