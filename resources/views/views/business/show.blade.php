<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            @include('users.sessionMessage')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6">
                    <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> Business Information<br>{{$business->business_name}}</h1>
                    <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center border-2 border-t-0 border-cool-gray-700">
                        <div class="flex flex-wrap overflow-hidden">

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3  h-12 text-lg text-black">
                               <p><strong>Name:</strong> {{$business->business_name}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Total Warehouse:</strong> {{$business->num_of_warehouse}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Chamber No:</strong> {{$business->chamber_reg_number}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <a href="{{(isset($business->chamber_reg_path)?url():'')}}" class="text-blue-600 visited:text-purple-600">Registration Certificate (Click to view)</a>
                            </div>


                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>VAT Number:</strong> {{$business->vat_reg_certificate_number}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Country:</strong> {{$business->country}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>City:</strong> {{$business->city}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Address:</strong> {{$business->address}}</p>
                            </div>



                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Website:</strong> {{$business->website}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Business Email:</strong> {{$business->business_email}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Phone:</strong> {{$business->phone}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Mobile:</strong> {{$business->mobile}}</p>
                            </div>




                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Longitude:</strong> {{$business->longitude}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Longitude:</strong> {{$business->latitude}}</p>
                            </div>

                            <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                <p><strong>Supplier/Client:</strong> {{$business->user->registration_type}}</p>
                            </div>

                            <div class="w-full lg:w-1/3 xl:w-1/2 h-auto text-lg text-black">
                                <p><strong>Category Deals With:</strong><br>
                                @php $cat = explode(',',$business->category_number); @endphp
                                @foreach($cat as $c)
                                    @php
                                        $catg = \App\Models\Category::find($c);
                                    @endphp
                                    {{$loop->iteration . ': ' . $catg->name}} <br>
                                @endforeach
                                </p>
                            </div>







                            <div class="w-full overflow-hidden">
                                <a href="{{route('business.edit',$business->id)}}" class="float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
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
