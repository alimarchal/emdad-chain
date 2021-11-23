@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__('portal.Update Business Certificates')}}
            </h2>
        </x-slot>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('users.sessionMessage')
                @if ($errors->any())
                    <div class="mb-3 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="ml-4">{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <form action="{{ route('certificateView') }}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Certificates uploaded')}}</h3>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="vat_reg_certificate_path_1">{{__('portal.Vat certificate')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="vat_reg_certificate_path_1" type="file" name="vat_reg_certificate_path_1" class="border p-2 w-1/2"></x-jet-input>
                                <br>
                                @if(isset($business->vat_reg_certificate_path))
                                    <a href="{{(isset($business->vat_reg_certificate_path)?Storage::url($business->vat_reg_certificate_path):'')}}" class="text-blue-600 visited:text-purple-600" target="blank">{{__('portal.Old Certificate')}}</a>
                                @endif
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="chamber_reg_path_1">{{__('portal.Commercial Registration certificate')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="file_path_1" type="file" name="chamber_reg_path_1" class="border p-2 w-1/2"></x-jet-input>
                                <br>
                                @if(isset($business->chamber_reg_path))
                                    <a href="{{(isset($business->chamber_reg_path)?Storage::url($business->chamber_reg_path):'')}}" class="text-blue-600 visited:text-purple-600" target="blank">{{__('portal.Old Certificate')}}</a>
                                @endif
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="business_photo_url_1">{{__('portal.Business Logo')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="file_path_1" type="file" name="business_photo_url_1" class="border p-2 w-1/2"></x-jet-input>
                                <br>
                                @if(isset($business->business_photo_url))
                                    <a href="{{(isset($business->business_photo_url)?Storage::url($business->business_photo_url):'')}}" class="flex-1 text-blue-600 visited:text-purple-600" target="blank">{{__('portal.Old Photo')}}</a>
                                @endif
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="nid_photo">{{__('portal.National ID Card Photo')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="file_path_1" type="file" name="nid_photo_1" class="border p-2 w-1/2"></x-jet-input>
                                <br>
                                @if(isset($business->user->nid_photo))
                                    <a href="{{(isset($business->user->nid_photo)?Storage::url($business->user->nid_photo):'')}}" class="flex-1 text-blue-600 visited:text-purple-600" target="blank">
                                        {{__('portal.Old Photo')}}
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="float-right mt-4 mb-4 mr-4 inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">{{__('portal.Send request to update Certificates')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__('portal.Update Business Certificates')}}
            </h2>
        </x-slot>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                @if ($errors->any())
                    <div class="mb-3 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="mr-4">{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <form action="{{ route('certificateView') }}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Certificates uploaded')}}</h3>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="vat_reg_certificate_path_1">{{__('portal.Vat certificate')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="vat_reg_certificate_path_1" type="file" name="vat_reg_certificate_path_1" class="border p-2 w-1/2"></x-jet-input>
                                <br>
                                @if(isset($business->vat_reg_certificate_path))
                                    <a href="{{(isset($business->vat_reg_certificate_path)?Storage::url($business->vat_reg_certificate_path):'')}}" class="text-blue-600 visited:text-purple-600" target="blank" style="padding-right: 10px;">{{__('portal.Old Certificate')}}</a>
                                @endif
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="chamber_reg_path_1">{{__('portal.Commercial Registration certificate')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="file_path_1" type="file" name="chamber_reg_path_1" class="border p-2 w-1/2"></x-jet-input>
                                <br>
                                @if(isset($business->chamber_reg_path))
                                    <a href="{{(isset($business->chamber_reg_path)?Storage::url($business->chamber_reg_path):'')}}" class="text-blue-600 visited:text-purple-600" target="blank" style="padding-right: 10px;">{{__('portal.Old Certificate')}}</a>
                                @endif
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="business_photo_url_1">{{__('portal.Business Logo')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="file_path_1" type="file" name="business_photo_url_1" class="border p-2 w-1/2"></x-jet-input>
                                <br>
                                @if(isset($business->business_photo_url))
                                    <a href="{{(isset($business->business_photo_url)?Storage::url($business->business_photo_url):'')}}" class="flex-1 text-blue-600 visited:text-purple-600" target="blank" style="padding-right: 10px;">{{__('portal.Old Photo')}}</a>
                                @endif
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="nid_photo">{{__('portal.National ID Card Photo')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">

                                <x-jet-input id="file_path_1" type="file" name="nid_photo_1" class="border p-2 w-1/2"></x-jet-input>
                                <br>
                                @if(isset($business->user->nid_photo))
                                    <a href="{{(isset($business->user->nid_photo)?Storage::url($business->user->nid_photo):'')}}" class="flex-1 text-blue-600 visited:text-purple-600" target="blank" style="padding-right: 10px;">
                                        {{__('portal.Old Photo')}}
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="float-left mt-4 mb-4 mr-4 inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">{{__('portal.Send request to update Certificates')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
