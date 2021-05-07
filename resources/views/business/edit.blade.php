@section('headerScripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script src="{{url('js/mapInput.js')}}"></script>
@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            @include('users.sessionMessage')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action="{{ route('business.update', $business->id) }}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Edit Business Information</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="business_name">Business Name</x-jet-label>
{{--                            <x-jet-label class="w-1/2" for="num_of_warehouse">Number of Warehouse</x-jet-label>--}}
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="business_name" type="text" name="business_name" class="border p-2 w-1/2" value="{{ $business->business_name }}"></x-jet-input>
{{--                            <select name="num_of_warehouse" id="num_of_warehouse" class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{ $business->num_of_warehouse }}">--}}
{{--                                <option value="">None</option>--}}
{{--                                @for ($count = 1; $count <= 100; $count++)--}}
{{--                                    <option value="{{ $count }}" {{ $business->num_of_warehouse == $count ? 'selected' : '' }}>{{ $count }}</option>--}}
{{--                                @endfor--}}
{{--                            </select>--}}
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="business_type">Category (Select If you want to change)</x-jet-label>
                            <x-jet-label class="w-1/2" for="business_type">Existing Category:</x-jet-label>
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
                            <x-jet-label class="w-1/2" for="chamber_reg_number">Chamber Registration Number</x-jet-label>
                            <x-jet-label class="w-1/2" for="chamber_reg_path" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">Chamber Certificate/File</x-jet-label>
                            <x-jet-label class="w-1/2" for="vat_reg_certificate_number">VAT Number</x-jet-label>
                            <x-jet-label class="w-1/2" for="vat_reg_certificate_path">VAT Certificate (If available)</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2 w-1/2" value="{{ $business->chamber_reg_number }}"></x-jet-input>
                            <x-jet-input id="chamber_reg_path" type="file" name="chamber_reg_path_1" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2" value="{{ $business->vat_reg_certificate_number }}"></x-jet-input>
                            <x-jet-input id="vat_reg_certificate_path" type="file" name="vat_reg_certificate_path_1" class="border p-2 w-1/2"></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-label class="w-1/2" for="website">Website</x-jet-label>
                            <x-jet-label class="w-1/2" for="business_email">Business Email</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">

                            <x-jet-input id="website" name="website" class="border p-2 w-1/2" value="{{ $business->website }}"></x-jet-input>
                            <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2" value="{{ $business->business_email }}"></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="phone">Phone</x-jet-label>
                            <x-jet-label class="w-1/2" for="mobile">Mobile</x-jet-label>
                            <x-jet-label class="w-1/2" for="country">Country</x-jet-label>
                            <x-jet-label class="w-1/2" for="city">City</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="phone" type="text" name="phone" class="border p-2 w-1/2" value="{{ $business->phone }}"></x-jet-input>
                            <x-jet-input id="mobile" type="text" name="mobile" class="border p-2 w-1/2" value="{{ $business->mobile }}"></x-jet-input>

                            <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                @foreach (\App\Models\User::countries() as $country)
                                    <option value="{{ $country }}" {{ $business->country == $country ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                            <select name="city" id="city" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                @foreach (\App\Models\City::all() as $city)
                                    <option value="{{ $city }}" {{ $business->city == $city ? 'selected' : '' }}>{{ $city->name_en }} - {{$city->name_ar}}</option>
                                @endforeach
                            </select>
{{--                            <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2" value="{{ $business->city }}"></x-jet-input>--}}
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="address">Address</x-jet-label>
                            <x-jet-label class="w-1/2" for="longitude">Longitude</x-jet-label>
                            <x-jet-label class="w-1/2" for="latitude">Latitude</x-jet-label>
                            <x-jet-label class="w-1/2" for="iban">IBAN#</x-jet-label>
                            <x-jet-label class="w-1/2" for="bank_name">Bank Name</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2">{{ $business->address }}</x-jet-input>
                            <x-jet-input id="longitude" type="text" name="longitude"  required readonly  class="border p-2 w-1/2" value="{{ $business->longitude }}"></x-jet-input>
                            <x-jet-input id="latitude" type="text" name="latitude"  required readonly  class="border p-2 w-1/2" value="{{ $business->latitude }}"></x-jet-input>

                            <x-jet-input id="phone" type="text" name="iban" class="border p-2 w-1/2" value="{{ $business->iban }}"></x-jet-input>


                            <select id="bank_name" name="bank_name" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                <option value="">None</option>
                                @foreach(\App\Models\Bank::all() as $bank_name)
                                    <option value="{{ $bank_name->name }}" @if($business->bank_name == $bank_name) selected @endif>{{ $bank_name->name }} - {{ $bank_name->ar_name }} </option>
                                @endforeach
                            </select>

                        </div>



                        <br>
                        <p>Please use the map marker for your office location.</p>
                        <br>
                        <div id="map" style="width:100%;height:400px; ">
                            <div style="width: 100%; height: 100%" id="address-map"></div>
                        </div>
                        <br>


                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url">Company logo</label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="business_photo_url" required type="file" name="business_photo_url_1" class="border p-2 w-1/2" value="{{ $business->business_photo_url }}"></x-jet-input>
                        </div>
                        <x-jet-button class="float-right mt-4 mb-4">Update</x-jet-button>

                    </form>


                </div>
            </div>


        </div>


    </div>
</x-app-layout>
