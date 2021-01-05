<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business Finance Information') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            @include('users.sessionMessage')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6">
                    <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> Business Finance Information <br>{{$businessFinanceDetail->business->business_name}}</h1>
                    <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center border-2 border-t-0 border-cool-gray-700">
                        <div class="flex flex-wrap overflow-hidden">

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3  h-12 text-lg text-black">
                                <p><strong>Business Name:</strong> {{$businessFinanceDetail->business->business_name}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Designation:</strong> {{$businessFinanceDetail->designation}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Name:</strong> {{$businessFinanceDetail->name}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Landline:</strong> {{$businessFinanceDetail->landline}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Mobile:</strong> {{$businessFinanceDetail->mobile}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Bank Name:</strong> {{$businessFinanceDetail->bank_name}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>IBAN#:</strong> {{$businessFinanceDetail->iban}}</p>
                            </div>






                            <div class="w-full overflow-hidden">
                                <a href="{{route('businessFinanceDetail.edit',$businessFinanceDetail->id)}}" class="float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Edit
                                </a>

                                <a href="#" onclick="window.print();" class="mr-3 float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Print
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>


    </div>
</x-app-layout>
