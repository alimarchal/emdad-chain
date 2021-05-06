@section('headerScripts')
@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Downloads Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mt-5" style=" margin-left: 30px; margin-bottom: 10px ">
            <a href="{{ route('adminDownload') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                Downloadables List
            </a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            @include('users.sessionMessage')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action="{{route('adminDownloadUpdate')}}" method="POST" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{encrypt($download->id)}}">
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Files Information</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="name_en">Name</x-jet-label>
                            <x-jet-label class="w-1/2" for="name_ar">Arabic Name</x-jet-label>
                        </div>

                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="name_en" type="text" name="name_en" required class="border p-2 w-1/2" value="{{$download->name_en}}" required></x-jet-input>
                            <x-jet-input id="name_ar" type="text" name="name_ar" required class="border p-2 w-1/2" value="{{$download->name_ar}}" required></x-jet-input>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="icon" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)" required>Icon</x-jet-label>
                            <x-jet-label class="w-1/2" for="file" title="File type: JPEG|PNG|PDF|DOCX => (Filesize: Max 10MB)" required>File Upload</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="icon" type="file" name="icon" class="border p-2 w-1/2" value="{{$download->icon}}"></x-jet-input>
                            <x-jet-input id="file" type="file" name="file" class="border p-2 w-1/2" value="{{$download->file}}"></x-jet-input>
                        </div>

                        <br>

                        <x-jet-button class="float-right mt-4 mb-4">Update</x-jet-button>

                    </form>


                </div>
            </div>


        </div>


    </div>
</x-app-layout>
