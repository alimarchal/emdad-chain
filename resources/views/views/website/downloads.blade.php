<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Download') }}

            <span class="float-right text-red-900 font-bold">{{(isset(Auth::user()->status) == 1)?'Under process':'InComplete'}}</span>
            <span class=" float-right text-black-600 font-bold">Account Status:&nbsp;&nbsp;</span>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                            <!--Metric Card-->
                            <div class="bg-white border rounded shadow p-2">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pr-4">
                                        <div class="rounded p-3 bg-green-600"><i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i></div>
                                    </div>
                                    <div class="flex-1 text-right md:text-center">
                                        <p class="font-bold uppercase text-gray-500">Download Supplier Survey</p>
                                        <a href="{{route('downloadSupplierExcel')}}" class="font-bold text-3xl">Download <span class="text-green-500"><i class="fas fa-caret-up"></i></span></a>
                                    </div>
                                </div>
                            </div>
                            <!--/Metric Card-->
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                            <!--Metric Card-->
                            <div class="bg-white border rounded shadow p-2">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pr-4">
                                        <div class="rounded p-3 bg-green-600"><i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i></div>
                                    </div>
                                    <div class="flex-1 text-right md:text-center">
                                        <p class="font-bold uppercase text-gray-500">Download Buyer Survey</p>
                                        <a href="{{route('downloadBuyerExcel')}}" class="font-bold text-3xl">Download <span class="text-green-500"><i class="fas fa-caret-up"></i></span></a>
                                    </div>
                                </div>
                            </div>
                            <!--/Metric Card-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
