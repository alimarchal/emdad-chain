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
                    <form action="{{route('packagingSolution.update',$packagingSolution->id)}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        <x-jet-validation-errors class="mb-4"/>
                        @csrf
                        @method('PUT')
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Packaging Solution</h3>
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="logistics_businesse_id" value="{{auth()->user()->logistics_business_id}}">
                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/2" for="box_quantity_pieces">
                                Quantity of Boxes / Pieces @include('misc.required')
                            </label>

                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/2" for="weight_piece">
                                Weight/Piece (Kg) @include('misc.required')
                            </label>

                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/2" for="forklift">
                                Forklift / Manual @include('misc.required')
                            </label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="box_quantity_pieces" type="number" step="0" min="1" placeholder="e.g 500" name="box_quantity_pieces" class="border p-2 w-1/2" value="{{$packagingSolution->box_quantity_pieces}}" required></x-jet-input>
                            <x-jet-input id="weight_piece" type="number" step="0" min="1" placeholder="Weight/Piece (Kg)" name="weight_piece" class="border p-2 w-1/2" value="{{$packagingSolution->weight_piece}}" required></x-jet-input>

                            <select id="forklift" name="forklift" class="form-input rounded-md shadow-sm border p-1 w-1/2" required>
                                <option value="">None</option>
                                <option value="1" @if($packagingSolution->forklift == 1) selected @endif>Yes</option>
                                <option value="0" @if($packagingSolution->forklift == 0) selected @endif>No</option>
                            </select>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 w-1/3">
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
                            <x-jet-input id="length" type="number" step="0.01" min="0" placeholder="Length" name="length" class="border p-2 w-1/4" value="{{$packagingSolution->length}}">
                            </x-jet-input>
                            <x-jet-input id="width" type="number" step="0.01" min="0" placeholder="Width" name="width" class="border p-2 w-1/4" value="{{$packagingSolution->width}}">
                            </x-jet-input>
                            <x-jet-input id="height" type="number" step="0.01" min="0" placeholder="Height" name="height" class="border p-2 w-1/4" value="{{$packagingSolution->height}}">
                            </x-jet-input>
                        </div>


                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="printing">
                                Printing @include('misc.required')
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="printing_design">
                                <a href="{{$packagingSolution->printing_design ? Storage::url($packagingSolution->printing_design) : '#'}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Printing Design (if yes)</a>

                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="commodity_type">
                                Commodity Type @include('misc.required')
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="commodity_information">
                                Explain @include('misc.required')
                            </label>
                        </div>


                        <div class="flex space-x-5 mt-3">

                            <select id="printing" name="printing" class="form-input rounded-md shadow-sm border p-1 w-1/2" required>
                                <option value="">None</option>
                                <option value="1" @if($packagingSolution->printing == 1) selected @endif >Yes</option>
                                <option value="0" @if($packagingSolution->printing == 0) selected @endif >No</option>
                            </select>

                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="printing_design" type="file" name="printing_design_1">

                            <select id="commodity_type" name="commodity_type" class="form-input rounded-md shadow-sm border p-1 w-1/2" required>
                                <option value="">None</option>
                                <option value="General" @if($packagingSolution->commodity_type ==  "General") selected @endif>General</option>
                                <option value="Dangerous Good" @if($packagingSolution->commodity_type ==  "Dangerous Good") selected @endif>Dangerous Good</option>
                                <option value="Energy: Gas, Oil etc." @if($packagingSolution->commodity_type == "Energy: Gas, Oil etc." ) selected @endif>Energy: Gas, Oil etc.</option>
                                <option value="Medical" @if($packagingSolution->commodity_type == "Medical" ) selected @endif>Medical</option>
                                <option value="Other" @if($packagingSolution->commodity_type ==  "Other") selected @endif>Other</option>
                            </select>

                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="commodity_information" value="{{$packagingSolution->commodity_information}}" type="text" placeholder="What's inside commodity type" name="commodity_information" required="required">

                        </div>


                        <div class="flex space-x-5 mt-3">
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="msds">
                                <a href="{{$packagingSolution->msds ? Storage::url($packagingSolution->msds) : '#'}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                    MSDS <abbr title="If the shipment include DG items"> ? Upload the document</abbr>
                                    @include('misc.required')
                                </a>

                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="msds_information">
                                Additional Information (MSDS)
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="latitude">
                                Latitude @include('misc.required')
                            </label>
                            <label class="block font-medium text-sm text-gray-700 font-bold w-1/3" for="longitude">
                                Longitude @include('misc.required')
                            </label>
                        </div>

                        <div class="flex space-x-5 mt-3">

                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" id="msds" type="file" name="msds_1">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{$packagingSolution->msds_information}}" id="msds_information" type="text" placeholder="If the shipment include DG items" name="msds_information" required="required">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{$packagingSolution->latitude}}" id="latitude" placeholder="Please use map marker" required readonly type="text" name="latitude">
                            <input class="form-input rounded-md shadow-sm border p-2 w-1/2" value="{{$packagingSolution->longitude}}" id="longitude" placeholder="Please use map marker" required readonly type="text" name="longitude">
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
                            <textarea id="address" type="text" name="address" placeholder="Please type your full address" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>{{$packagingSolution->address}}</textarea>
                        </div>
                        <br>

                        <x-jet-button class="float-right mt-4 mb-4">Update</x-jet-button>

                    </form>


                </div>
            </div>


        </div>
    </div>


</x-app-layout>
