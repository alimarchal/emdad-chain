<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Business Certificates
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('users.sessionMessage')
        <!-- component -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-0 bg-white sm:p-6">
                <h2 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> Business Name<br>{{$businessCertificate->business->business_name}}</h2>
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm space-y-4 md:space-y-0 w-full p-4 border-2 border-t-0 border-cool-gray-700">
                    <form action="{{ route('certificateView') }}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Certificate(s) uploaded for update request</h3>

                        @if(isset($businessCertificate->vat_reg_certificate_path))
                        <div class="flex space-x-5 mt-3">
                            <a href="{{Storage::url($businessCertificate->vat_reg_certificate_path)}}" class="text-blue-600 visited:text-purple-600" target="blank">{{'VAT Certificate'}}</a>
                        </div>
                        @endif

                        @if(isset($businessCertificate->chamber_reg_path))
                        <div class="flex space-x-5 mt-3">
                            <a href="{{Storage::url($businessCertificate->chamber_reg_path)}}" class="text-blue-600 visited:text-purple-600" target="blank">{{'Commercial Registration Certificate'}}</a>
                        </div>
                        @endif

                        @if(isset($businessCertificate->business_photo_url))
                        <div class="flex space-x-5 mt-3">
                                <a href="{{Storage::url($businessCertificate->business_photo_url)}}" class="text-blue-600 visited:text-purple-600" target="blank">{{'Business Logo'}}</a>
                        </div>
                        @endif

                        @if(isset($businessCertificate->nid_photo))
                        <div class="flex space-x-5 mt-3">
                                <a href="{{Storage::url($businessCertificate->nid_photo)}}" class="text-blue-600 visited:text-purple-600" target="blank">{{'National ID Card Photo'}}</a>
                        </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



{{--@section('headerScripts')--}}
{{--    --}}{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
{{--@endsection--}}
{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Certificates Information') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <!-- component -->--}}
{{--            @include('users.sessionMessage')--}}
{{--            @if (session()->has('error'))--}}
{{--                <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">--}}
{{--                    <strong class="mr-1">{{ session('error') }}</strong>--}}
{{--                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">--}}
{{--                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-green-900" aria-hidden="true">×</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--                <div class="px-4 py-0 bg-white sm:p-6">--}}
{{--                    <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> Business Name<br>{{$businessCertificate->business->business_name}}</h1>--}}
{{--                    <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center border-2 border-t-0 border-cool-gray-700">--}}
{{--                        <div class="flex flex-wrap overflow-hidden">--}}

{{--                            @if(isset($businessCertificate->vat_reg_certificate_path))--}}
{{--                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3  h-12 text-lg text-black">--}}
{{--                                    <a href="{{Storage::url($businessCertificate->vat_reg_certificate_path)}}" class="text-blue-600 visited:text-purple-600" target="blank">{{'VAT Certificate'}}</a>--}}
{{--                                </div>--}}
{{--                            @endif--}}

{{--                            @if(isset($businessCertificate->chamber_reg_path))--}}
{{--                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3  h-12 text-lg text-black">--}}
{{--                                    <a href="{{Storage::url($businessCertificate->chamber_reg_path)}}" class="text-blue-600 visited:text-purple-600" target="blank">{{'Commercial Registration Certificate'}}</a>--}}
{{--                                </div>--}}
{{--                            @endif--}}

{{--                            @if(isset($businessCertificate->business_photo_url))--}}
{{--                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3  h-12 text-lg text-black">--}}
{{--                                    <a href="{{Storage::url($businessCertificate->business_photo_url)}}" class="text-blue-600 visited:text-purple-600" target="blank">{{'Business Logo'}}</a>--}}
{{--                                </div>--}}
{{--                            @endif--}}

{{--                            <div class="w-full overflow-hidden">--}}
{{--                                <a href="{{url()->previous()}}"--}}
{{--                                   class="mr-3 float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">--}}
{{--                                    Back--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}


{{--        </div>--}}


{{--    </div>--}}
{{--</x-app-layout>--}}
