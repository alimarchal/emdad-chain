@if (auth()->user()->rtl == 0)
    <x-app-layout>
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

        <div class="mt-4">

            <div class="flex flex-wrap overflow-hidden lg:-mx-2 xl:-mx-1" style="justify-content: center;">

                <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3" style="justify-content: center;">
                    <div class="md:flex flex-1 rounded-md bg-white" style="justify-content: center;">

                        <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3" style="justify-content: center;">
                            <div class="items-center text-center px-2 py-6  ">

                                <div class="mx-5">
                                    <div class="text-gray-500">
                                        <label>
                                            <select name="category_selection" class="form-select shadow-sm block w-full category_selection" required>
                                                <option value="">{{__('portal.Select')}}</option>
                                                <option value="1">{{__('portal.Multiple Categories')}}</option>
                                                <option value="0">{{__('portal.Single Category')}}</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </x-app-layout>

    <script>
        $('.category_selection').change(function () {

            if ($(this).val() == 0 )
            {
                window.location.href = "{{route("create_single_rfq")}}";
            }
            if ( $(this).val() == 1 )
            {
                window.location.href = "{{route("RFQ.create")}}";
            }

        });
    </script>

@else
    <x-app-layout>
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

        <div class="mt-4">

            <div class="flex flex-wrap overflow-hidden lg:-mx-2 xl:-mx-1" style="justify-content: center;">

                <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3" style="justify-content: center;">
                    <div class="md:flex flex-1 rounded-md bg-white" style="justify-content: center;">

                        <div class="lg:flex flex-1 sm:w-1/2 xl:w-1/3" style="justify-content: center;">
                            <div class="items-center text-center px-2 py-6  ">

                                <div class="mx-5">
                                    <div class="text-gray-500">
                                        <label>
                                            <select name="category_selection" class="form-select shadow-sm block w-full category_selection" required>
                                                <option value="">{{__('portal.Select')}}</option>
                                                <option value="1">{{__('portal.Multiple Categories')}}</option>
                                                <option value="0">{{__('portal.Single Category')}}</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </x-app-layout>

    <script>
        $('.category_selection').change(function () {

            if ($(this).val() == 0 )
            {
                window.location.href = "{{route("create_single_rfq")}}";
            }
            if ( $(this).val() == 1 )
            {
                window.location.href = "{{route("RFQ.create")}}";
            }

        });
    </script>
@endif
