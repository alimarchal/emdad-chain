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
                    <form action="{{route('logistics.store')}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        <x-jet-validation-errors class="mb-4"/>
                        @csrf
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Packaging Solution</h3>

                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/2" for="box_quantity_pieces">
                                Quantity of Boxes / Pieces @include('misc.required')
                            </label>

                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/2" for="weight_piece">
                                Weight/Piece (Kg) @include('misc.required')
                            </label>

                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/2" for="weight_piece">
                                Forklift / Manual @include('misc.required')
                            </label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="box_quantity_pieces" type="number" step="0" min="1" placeholder="e.g 500" name="box_quantity_pieces" class="border p-2 w-1/2" value="{{old('box_quantity_pieces')}}" required></x-jet-input>
                            <x-jet-input id="weight_piece" type="number" step="0" min="1" placeholder="Weight/Piece (Kg)" name="weight_piece" class="border p-2 w-1/2" value="{{old('box_quantity_pieces')}}" required></x-jet-input>

                            <select id="bank_name" name="bank_name" class="form-input rounded-md shadow-sm border p-1 w-1/2" required>
                                <option value="">None</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/3" >
                            </label>

                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="length">
                                Length @include('misc.required')
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="width">
                                Width @include('misc.required')
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="height">
                                Height @include('misc.required')
                            </label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-lg font-bold text-gray-700 p-2 w-1/4" for="length">
                                Dimensions (cm)
                            </label>
                            <x-jet-input id="length" type="number" step="0.01" min="0" placeholder="Length" name="length" class="border p-2 w-1/4" value="{{old('length')}}">
                            </x-jet-input>
                            <x-jet-input id="width" type="number" step="0.01" min="0" placeholder="Width" name="width" class="border p-2 w-1/4" value="{{old('width')}}">
                            </x-jet-input>
                            <x-jet-input id="height" type="number" step="0.01" min="0" placeholder="Height" name="height" class="border p-2 w-1/4" value="{{old('height')}}">
                            </x-jet-input>
                        </div>


                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="length">
                                Printing @include('misc.required')
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="length">
                                Printing Design (if yes)
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="length">
                                Commodity Type  @include('misc.required')
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="length">
                               Explain @include('misc.required')
                            </label>
                        </div>


                        <div class="flex space-x-5 mt-3">

                            <select id="bank_name" name="bank_name" class="form-input rounded-md shadow-sm border p-1 w-1/2" required>
                                <option value="">None</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>

                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="iban" type="file" name="iban" required="required">

                            <select id="bank_name" name="bank_name" class="form-input rounded-md shadow-sm border p-1 w-1/2" required>
                                <option value="">None</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>

                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="iban" type="text" placeholder="Explain" name="iban" required="required">

                        </div>


                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="length">
                                MSDS <abbr title="If the shipment include DG items"> ? Upload the document</abbr>
                                @include('misc.required')
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="length">
                                Additional Information
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="length">
                                Latitude  @include('misc.required')
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="length">
                                Longitude @include('misc.required')
                            </label>
                        </div>

                        <div class="flex space-x-5 mt-3">

                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="iban" type="file" name="iban" required="required">

                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="iban" type="text" placeholder="Upload the document" name="iban" required="required">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="latitude" placeholder="Please use map marker" required readonly type="text" name="latitude">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="longitude" placeholder="Please use map marker" required readonly type="text" name="longitude">
                        </div>


                        <br>
                        <p>Please use the map marker for your solution location.</p>
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
                            <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>{{old('address')}}</textarea>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/2" for="business_photo_url_1">Company logo @include('misc.required')</label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="business_photo_url" type="file" name="business_photo_url_1" class="border p-2 w-1/2" required></x-jet-input>
                        </div>

                        <br>

                        <x-jet-button class="float-right mt-4 mb-4">Save</x-jet-button>

                    </form>


                </div>
            </div>


        </div>
    </div>


</x-app-layout>
