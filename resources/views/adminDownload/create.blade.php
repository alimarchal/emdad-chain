@section('headerScripts')
@endsection
@if(auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Downloads Information') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
                <a href="{{ route('adminDownload') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Downloadables List')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if($errors->any())
                    <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        @if($errors->first('name_en'))<li><strong class="mr-1"> {{__('portal.Name is required')}} </strong></li> &nbsp;@endif
                        @if($errors->first('name_ar'))<li><strong class="mr-1"> {{__('portal.Arabic Name is required')}} </strong></li> &nbsp;@endif
                        @if($errors->first('icon'))<li><strong class="mr-1"> {{__('portal.Icon must be of type: png, jpeg ,jpg')}} </strong></li> &nbsp;@endif
                        @if($errors->first('file'))<li><strong class="mr-1"> {{__('portal.File must be of type: excel, powerpoint or pdf')}} </strong></li> @endif
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <form action="{{route('adminDownloadStore')}}" method="POST" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Files Information')}}</h3>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="name_en">{{__('portal.Name')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="name_ar">{{__('portal.Arabic Name')}}</x-jet-label>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="name_en" type="text" name="name_en" required class="border p-2 w-1/2" value="{{old('name_en')}}"></x-jet-input>
                                <x-jet-input id="name_ar" type="text" name="name_ar" required class="border p-2 w-1/2" value="{{old('name_ar')}}" required></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="icon" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">{{__('portal.Icon')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="file" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">{{__('portal.File Upload')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="icon" type="file" name="icon" class="border p-2 w-1/2" value="" required></x-jet-input>
                                <x-jet-input id="file" type="file" name="file" class="border p-2 w-1/2" value="" required></x-jet-input>
                            </div>

                            <br>

                            <x-jet-button class="float-right mt-4 mb-4">{{__('portal.Create')}}</x-jet-button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Downloads Information') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="mt-5" style=" margin-right: 30px; margin-bottom: 10px ">
                <a href="{{ route('adminDownload') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                    {{__('portal.Downloadables List')}}
                </a>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if($errors->any())
                    <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        @if($errors->first('name_en'))<li><strong class="mr-1"> {{__('portal.Name is required')}} </strong></li> &nbsp;@endif
                        @if($errors->first('name_ar'))<li><strong class="mr-1"> {{__('portal.Arabic Name is required')}} </strong></li> &nbsp;@endif
                        @if($errors->first('icon'))<li><strong class="mr-1"> {{__('portal.Icon must be of type: png, jpeg ,jpg')}} </strong></li> &nbsp;@endif
                        @if($errors->first('file'))<li><strong class="mr-1"> {{__('portal.File must be of type: excel, powerpoint or pdf')}} </strong></li> @endif
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                        <form action="{{route('adminDownloadStore')}}" method="POST" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Files Information')}}</h3>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="name_en">{{__('portal.Name')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="name_ar">{{__('portal.Arabic Name')}}</x-jet-label>
                            </div>

                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="name_en" type="text" name="name_en" required class="border p-2 w-1/2" value="{{old('name_en')}}"></x-jet-input>
                                <x-jet-input id="name_ar" type="text" name="name_ar" required class="border p-2 w-1/2" value="{{old('name_ar')}}" required></x-jet-input>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-label class="w-1/2" for="icon" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">{{__('portal.Icon')}}</x-jet-label>
                                <x-jet-label class="w-1/2" for="file" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)">{{__('portal.File Upload')}}</x-jet-label>
                            </div>
                            <div class="flex space-x-5 mt-3">
                                <x-jet-input id="icon" type="file" name="icon" class="border p-2 w-1/2" value="" required></x-jet-input>
                                <x-jet-input id="file" type="file" name="file" class="border p-2 w-1/2" value="" required></x-jet-input>
                            </div>

                            <br>

                            <x-jet-button class="float-right mt-4 mb-4">{{__('portal.Create')}}</x-jet-button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
