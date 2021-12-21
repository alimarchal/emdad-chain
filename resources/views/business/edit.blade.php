@section('headerScripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script src="{{url('js/mapInput.js')}}"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        #datepicker {
            padding: 10px;
            cursor: default;
            /*text-transform: uppercase;*/
            font-size: 13px;
            background: #FFFFFF;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            border: solid 1px #d2d6dc;
            box-shadow: none;
        }
    </style>

    <script>

        $(document).ready(function() {
            var $j = jQuery.noConflict();
            $( "#datepicker" ).datepicker({
                dateFormat: 'mm/dd/yy',
                changeMonth: true,
                changeYear: true,
                minDate: 0,
                clear: true,
            });
        });
    </script>
@endsection

@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Business Information') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <form action="{{ route('business.update', $business->id) }}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Edit Business Information')}}</h3>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/3" for="business_name">{{__('portal.Business Name')}} @include('misc.required')</label>
                                <label for="nid_num" class="block font-medium text-sm text-gray-700 w-1/3" >{{ __('register.National ID Number') }} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/3">{{__('portal.National ID Card Photo')}} @include('misc.required')</label>
                                <label for="nid_exp_date" class="block font-medium text-sm text-gray-700 w-1/3">{{ __('register.National ID Expiry Date') }} @include('misc.required')</label>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_name" type="text" name="business_name" class="border p-2 w-1/3" value="{{$business->business_name}}" required></x-jet-input>
                                <x-jet-input id="nid_num" class="block mt-1  w-1/3" type="text" pattern="\d*" maxlength="10" name="nid_num" :value="$business->user->nid_num" required/>
                                <x-jet-input id="nid_photo" type="file" name="nid_photo_1" class="form-input rounded-md shadow-sm block mt-1  w-1/3" required></x-jet-input>
                                <input type="text" id="datepicker" data-provide="datepicker" class="block mt-1 w-1/3" name="nid_exp_date" value="{{$business->user->nid_exp_date}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" readonly>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="business_type">{{__('portal.Category (Select If you want to change)')}}</x-jet-label>
                                {{--<x-jet-label class="w-1/2" for="business_type">{{__('portal.Existing Category')}}:</x-jet-label>--}}
                            </div>
                            <div class="flex mt-3 mb-4">
                                @include('category.category.index')
                                {{-- <ol class="pl-3">
                                    @foreach ($business->categories as $key)
                                        <li>{{ $loop->iteration }} - {{ \App\Models\Category::find($key->category_number)->name }}</li>
                                    @endforeach
                                </ol> --}}
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="chamber_reg_number">{{__('portal.Commercial Registration Number')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="chamber_reg_path" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">{{__('portal.Chamber Certificate/File')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="vat_reg_certificate_number">{{__('portal.VAT Number')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="vat_reg_certificate_path">{{__('portal.VAT Certificate (If available)')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2 w-1/2" value="{{ $business->chamber_reg_number }}"></x-jet-input>
                                <x-jet-input id="chamber_reg_path" type="file" name="chamber_reg_path_1" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2" value="{{ $business->vat_reg_certificate_number }}"></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_path" type="file" name="vat_reg_certificate_path_1" class="border p-2 w-1/2"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-label class="w-1/2" for="website">{{__('portal.Website')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="business_email">{{__('portal.Business Email')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="website" name="website" class="border p-2 w-1/2" value="{{ $business->website }}"></x-jet-input>
                                <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2" value="{{ $business->business_email }}"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="phone">{{__('portal.Phone')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">{{__('portal.Mobile')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">{{__('portal.Country')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">{{__('portal.City')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="phone" type="text" name="phone" class="border p-2 w-1/2" value="{{ $business->phone }}"></x-jet-input>
                                <x-jet-input id="mobile" type="text" name="mobile" class="border p-2 w-1/2" value="{{ $business->mobile }}"></x-jet-input>

                                <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach (\App\Models\User::countries() as $country)
                                        <option value="{{ $country }}" {{ $business->country == $country ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                                <select name="city" id="city" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach (\App\Models\City::all() as $city)
                                        <option value="{{ $city->name_en }}" {{ $business->city == $city->name_en ? 'selected' : '' }}>{{ $city->name_en }} - {{$city->name_ar}}</option>
                                    @endforeach
                                </select>
                                {{--                            <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2" value="{{ $business->city }}"></x-jet-input>--}}
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="address">{{__('portal.Address')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="longitude">{{__('portal.Longitude')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="latitude">{{__('portal.Latitude')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="iban">{{__('portal.IBAN')}}#</x-jet-label>
                                <x-jet-label class="w-1/2" for="bank_name">{{__('portal.Bank Name')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ $business->address }}"></x-jet-input>
                                <x-jet-input id="longitude" type="text" name="longitude"  required readonly  class="border p-2 w-1/2" value="{{ $business->longitude }}"></x-jet-input>
                                <x-jet-input id="latitude" type="text" name="latitude"  required readonly  class="border p-2 w-1/2" value="{{ $business->latitude }}"></x-jet-input>

                                <x-jet-input id="phone" type="text" name="iban" class="border p-2 w-1/2" value="{{ $business->iban }}"></x-jet-input>


                                <select id="bank_name" name="bank_name" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach(\App\Models\Bank::all() as $bank_name)
                                        <option value="{{ $bank_name->name }}" @if($business->bank_name == $bank_name->name) selected @endif>{{ $bank_name->name }} - {{ $bank_name->ar_name }} </option>
                                    @endforeach
                                </select>

                            </div>



                            <br>
                            <p>{{__('portal.Please use the map marker for your office location.')}}</p>
                            <br>
                            <div id="map" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>
                            <br>


                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url">Company logo</label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_photo_url" type="file" name="business_photo_url_1" class="border p-2 w-1/2" value="{{ $business->business_photo_url }}"></x-jet-input>
                            </div>
                            <x-jet-button class="float-right mt-4 mb-4">{{__('portal.Update')}}</x-jet-button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Business Information') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <form action="{{ route('business.update', $business->id) }}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Edit Business Information')}}</h3>
                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/3" for="business_name">{{__('portal.Business Name')}} @include('misc.required')</label>
                                <label for="nid_num" class="block font-medium text-sm text-gray-700 w-1/3" >{{ __('register.National ID Number') }} @include('misc.required')</label>
                                <label class="block font-medium text-sm text-gray-700 w-1/3">{{__('portal.National ID Card Photo')}} @include('misc.required')</label>
                                <label for="nid_exp_date" class="block font-medium text-sm text-gray-700 w-1/3">{{ __('register.National ID Expiry Date') }} @include('misc.required')</label>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_name" type="text" name="business_name" class="border p-2 w-1/3" value="{{$business->business_name}}" required></x-jet-input>
                                <x-jet-input id="nid_num" class="block mt-1  w-1/3" type="text" pattern="\d*" maxlength="10" name="nid_num" :value="$business->user->nid_num" required/>
                                <x-jet-input id="nid_photo" type="file" name="nid_photo_1" style="font-family: sans-serif" class="form-input rounded-md shadow-sm block mt-1  w-1/3" required></x-jet-input>
                                <input type="text" id="datepicker" data-provide="datepicker" class="block mt-1 w-1/3" name="nid_exp_date" value="{{$business->user->nid_exp_date}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" readonly>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="business_type">{{__('portal.Category (Select If you want to change)')}}</x-jet-label>
                                {{--<x-jet-label class="w-1/2" for="business_type">{{__('portal.Existing Category')}}:</x-jet-label>--}}
                            </div>
                            <div class="flex mt-3 mb-4">
                                @include('category.category.index')
                                {{-- <ol class="pl-3">
                                    @foreach ($business->categories as $key)
                                        <li>{{ $loop->iteration }} - {{ \App\Models\Category::find($key->category_number)->name }}</li>
                                    @endforeach
                                </ol> --}}
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="chamber_reg_number">{{__('portal.Commercial Registration Number')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="chamber_reg_path" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">{{__('portal.Chamber Certificate/File')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="vat_reg_certificate_number">{{__('portal.VAT Number')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="vat_reg_certificate_path">{{__('portal.VAT Certificate (If available)')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2 w-1/2" value="{{ $business->chamber_reg_number }}"></x-jet-input>
                                <x-jet-input id="chamber_reg_path" type="file" name="chamber_reg_path_1" class="border p-2 w-1/2"></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2" value="{{ $business->vat_reg_certificate_number }}"></x-jet-input>
                                <x-jet-input id="vat_reg_certificate_path" type="file" name="vat_reg_certificate_path_1" class="border p-2 w-1/2"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-label class="w-1/2" for="website">{{__('portal.Website')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="business_email">{{__('portal.Business Email')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="website" name="website" class="border p-2 w-1/2" value="{{ $business->website }}"></x-jet-input>
                                <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2" value="{{ $business->business_email }}"></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="phone">{{__('portal.Phone')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="mobile">{{__('portal.Mobile')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="country">{{__('portal.Country')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="city">{{__('portal.City')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="phone" type="text" name="phone" class="border p-2 w-1/2" value="{{ $business->phone }}"></x-jet-input>
                                <x-jet-input id="mobile" type="text" name="mobile" class="border p-2 w-1/2" value="{{ $business->mobile }}"></x-jet-input>

                                <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach (\App\Models\User::countries() as $country)
                                        <option value="{{ $country }}" {{ $business->country == $country ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                                <select name="city" id="city" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach (\App\Models\City::all() as $city)
                                        <option value="{{ $city->name_en }}" {{ $business->city == $city->name_en ? 'selected' : '' }}>{{ $city->name_en }} - {{$city->name_ar}}</option>
                                    @endforeach
                                </select>
                                {{--                            <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2" value="{{ $business->city }}"></x-jet-input>--}}
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="address">{{__('portal.Address')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="longitude">{{__('portal.Longitude')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="latitude">{{__('portal.Latitude')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="iban">{{__('portal.IBAN')}}#</x-jet-label>
                                <x-jet-label class="w-1/2" for="bank_name">{{__('portal.Bank Name')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ $business->address }}"></x-jet-input>
                                <x-jet-input id="longitude" type="text" name="longitude"  required readonly  class="border p-2 w-1/2" value="{{ $business->longitude }}"></x-jet-input>
                                <x-jet-input id="latitude" type="text" name="latitude"  required readonly  class="border p-2 w-1/2" value="{{ $business->latitude }}"></x-jet-input>

                                <x-jet-input id="phone" type="text" name="iban" class="border p-2 w-1/2" value="{{ $business->iban }}"></x-jet-input>


                                <select id="bank_name" name="bank_name" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                    <option value="">{{__('portal.Select')}}</option>
                                    @foreach(\App\Models\Bank::all() as $bank_name)
                                        <option value="{{ $bank_name->name }}" @if($business->bank_name == $bank_name->name) selected @endif>{{ $bank_name->name }} - {{ $bank_name->ar_name }} </option>
                                    @endforeach
                                </select>

                            </div>



                            <br>
                            <p>{{__('portal.Please use the map marker for your office location.')}}</p>
                            <br>
                            <div id="map" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>
                            <br>


                            <div class="flex space-x-5 mt-3">
                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url">Company logo</label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="business_photo_url" type="file" name="business_photo_url_1" class="border p-2 w-1/2" value="{{ $business->business_photo_url }}"></x-jet-input>
                            </div>
                            <x-jet-button class="float-right mt-4 mb-4">{{__('portal.Update')}}</x-jet-button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
