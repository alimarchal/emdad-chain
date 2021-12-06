@if (auth()->user()->rtl == 0)
    <x-app-layout>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 mt-2 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        <h2 class="text-2xl font-bold py-0 mt-3 text-center">{{__('portal.Please select a payment type')}}</h2>
        <div class="mt-4">

            <div class="flex flex-wrap overflow-hidden lg:-mx-2 xl:-mx-1" style="justify-content: center;">

                <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3" style="justify-content: center;">
                    <div class="items-center text-center px-2 py-2">

                        <div class="mx-5">
                            <div class="text-gray-500">
                                <a href="{{route('manualPackagePaymentView', $packageID)}}" class="flex items-center mt-auto text-white bg-blue-700 border-0 py-2 px-4 w-full focus:outline-none hover:bg-blue-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Manual Payment')}}</a>
                            </div>
                        </div>
                        <div class="mx-5">
                            <div class="text-gray-500">
                                <form action="{{route('businessPackage.stepOne')}}" method="POST" style="padding-top: 36px;">
                                    @csrf
                                    <input type="hidden" name="package_id" value="{{$packageID}}">
                                    <button class="flex items-center mt-6 text-white bg-blue-700 border-0 py-2 px-4 w-full focus:outline-none hover:bg-blue-500 rounded" style="justify-content: center">{{__('portal.Online Payment')}}</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 mt-2 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        <h2 class="text-2xl font-bold py-0 mt-3 text-center">{{__('portal.Please select a payment type')}}</h2>
        <div class="mt-4">

            <div class="flex flex-wrap overflow-hidden lg:-mx-2 xl:-mx-1" style="justify-content: center;">

                <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/3 xl:my-1 xl:px-1 xl:w-1/3" style="justify-content: center;">
                    <div class="items-center text-center px-2 py-2">

                        <div class="mx-5">
                            <div class="text-gray-500">
                                <a href="{{route('manualPackagePaymentView', $packageID)}}" class="flex items-center mt-auto text-white hover:text-white bg-blue-700 border-0 py-2 px-4 w-full focus:outline-none hover:bg-blue-500 rounded" style="justify-content: center; cursor: pointer">{{__('portal.Manual Payment')}}</a>
                            </div>
                        </div>
                        <div class="mx-5">
                            <div class="text-gray-500">
                                <form action="{{route('businessPackage.stepOne')}}" method="POST" style="padding-top: 36px;">
                                    @csrf
                                    <input type="hidden" name="package_id" value="{{$packageID}}">
                                    <button class="flex items-center mt-6 text-white bg-blue-700 border-0 py-2 px-4 w-full focus:outline-none hover:bg-blue-500 rounded" style="justify-content: center">{{__('portal.Online Payment')}}</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </x-app-layout>
@endif
