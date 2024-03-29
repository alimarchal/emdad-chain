<x-app-layout>
    @section('headerScripts')
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
        <script src="{{url('js/mapInput.js')}}"></script>
    @endsection
    @if (session()->has('error'))
        <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
            <strong class="mr-1">{{ session('error') }}</strong>
            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
            </button>
        </div>

    @elseif (session()->has('message'))
        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" style="margin-top: 10px;" role="alert">
            <strong class="mr-1">{{ session('message') }}</strong>
            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business Information') }}
        </h2>
    </x-slot>


    <div class="mt-4">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->

            @include('users.sessionMessage')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto mb-4 m-auto"/>
                    <form action="{{route('logistics.update',$logisticsBusiness)}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        <x-jet-validation-errors class="mb-4"/>
                        @csrf
                        @method('PUT')
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Step # 2: Business Information</h3>
                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_name">Business Name @include('misc.required')</label>
                            {{--                                <label class="block font-medium text-sm text-gray-700 w-1/2" for="num_of_warehouse">Select the numbers of Warehouses @include('misc.required')</label>--}}
                            <input type="hidden" name="business_type" value="{{ auth()->user()->registration_type }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="business_name" type="text" name="business_name" class="border p-2 w-1/2" value="{{$logisticsBusiness->business_name}}" required></x-jet-input>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_number">Commercial Registration Number @include('misc.required')</label>
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="chamber_reg_path_1" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">
                                Commercial Registration Certificate @include('misc.required')</label>
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_number">VAT Number @include('misc.required')</label>
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="vat_reg_certificate_path_1">VAT Certificate (If available) @include('misc.required')</label>

                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2 w-1/2"   value="{{$logisticsBusiness->chamber_reg_number}}"  ></x-jet-input>
                            <x-jet-input id="chamber_reg_path_1" type="file" name="chamber_reg_path_1" class="border p-2 w-1/2" ></x-jet-input>
                            <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number"   value="{{$logisticsBusiness->vat_reg_certificate_number}}" class="border p-2 w-1/2"  required></x-jet-input>
                            <x-jet-input id="vat_reg_certificate_path_1" type="file" name="vat_reg_certificate_path_1"  class="border p-2 w-1/2" required></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-label class="w-1/2" for="website">Website</x-jet-label>
                            <x-jet-label class="w-1/2" for="business_email">Company Email @include('misc.required')</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-input id="website" name="website" class="border p-2 w-1/2" value="{{$logisticsBusiness->website}}" ></x-jet-input>
                            <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2" value="{{$logisticsBusiness->business_email}}" ></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="phone">Landline @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="mobile">Mobile @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="country">Country @include('misc.required')</x-jet-label>
                            <x-jet-label class="w-1/2" for="city">City @include('misc.required')</x-jet-label>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="phone" type="tel" name="phone" class="border p-2 w-1/2" value="{{$logisticsBusiness->phone}}" required></x-jet-input>
                            <x-jet-input id="mobile" type="number" name="mobile" class="border p-2 w-1/2" value="{{$logisticsBusiness->mobile}}" required></x-jet-input>
                            <select name="country" id="country" class="form-select rounded-md shadow-sm border p-2 w-1/2" required>
                                <option value="">None</option>
                                @foreach (\App\Models\User::countries() as $country)
                                    <option value="{{ $country }}" @if($logisticsBusiness->country == $country) selected @endif>{{ $country }}</option>
                                @endforeach
                            </select>

                            <select name="city" id="city" class="form-select select2 rounded-md shadow-sm border p-2 w-1/2" required>
                                @foreach (\App\Models\City::all() as $city)
                                    <option @if($logisticsBusiness->city == $city) selected @endif value="{{ $city->name_en }}">{{ $city->name_en . ' - ' . $city->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="bank_name">Bank Name @include('misc.required')</label>
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="iban">IBAN @include('misc.required')</label>
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="latitude">Latitude @include('misc.required')</label>
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="longitude">Longitude @include('misc.required')</label>
                        </div>


                        <div class="flex space-x-5 mt-3">
                            <select id="bank_name" name="bank_name" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                <option value="">None</option>
                                @foreach(\App\Models\Bank::all() as $bank_name)
                                    <option  @if($logisticsBusiness->bank_name == $bank_name->name  ) selected @endif  value="{{ $bank_name->name }}">{{ $bank_name->name }}</option>
                                @endforeach
                            </select>

                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{$logisticsBusiness->iban}}" id="iban" type="text" name="iban" required="required">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{$logisticsBusiness->latitude}}" id="latitude" required readonly type="text" name="latitude">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{$logisticsBusiness->longitude}}" id="longitude" required readonly type="text" name="longitude">
                        </div>


                        <br>
                        <p>Please use the map marker for your office location.</p>
                        <br>
                        <div id="map" style="width:100%;height:400px; ">
                            <div style="width: 100%; height: 100%" id="address-map"></div>
                        </div>
                        <br>

                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="address">
                                Address @include('misc.required')
                            </label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>{{$logisticsBusiness->address}}</textarea>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url_1">Company logo @include('misc.required')</label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="business_photo_url" type="file" name="business_photo_url_1" class="border p-2 w-1/2" required></x-jet-input>
                        </div>

                        <br>

                        <x-jet-button class="float-right mt-4 mb-4">Update</x-jet-button>

                    </form>


                </div>
            </div>


        </div>
    </div>


</x-app-layout>
