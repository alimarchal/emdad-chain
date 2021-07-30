<x-app-layout>
    @section('headerScripts')

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


    <div class="mt-4">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            function myFunction() {
                var x = document.getElementById("myDIV");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>

        <button type="button" onclick="myFunction()" class="float-right mr-24 mt-10 btn btn-light shadow-sm" data-toggle="collapse" data-target="#filters">Filters <i class="fa fa-filter"></i></button>


        <br>
        <br>
        <br>

        <div class="max-w-7xl mx-auto sm:px-3 lg:px-6" id="myDIV" style="display: none;">
            <form action="">
                <div class="mb-3 -mx-2 flex items-end">
                    <div class="px-2 w-1/2">
                        <div>
                            <label class="font-bold text-sm mb-2 ml-1">Business Name</label>
                            <input name="filter[name]" value="" class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                        </div>
                    </div>
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">City</label>
                        <input name="filter[cnic]" value="" class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                    </div>
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Chamber VAT</label>
                        <input name="filter[father_name]" value="" class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">

                    </div>
                </div>
                <button class="mb-5 su-button su-button-style-3d" style="color:#FFF;background-color:#0CAFFA;border-color:#0a8cc8;border-radius:10px;-moz-border-radius:10px;-webkit-border-radius:10px" target="_blank" rel="nofollow"><span
                        style="color:#FFF;padding:0px 26px;font-size:20px;line-height:40px;border-color:#55c7fc;border-radius:10px;-moz-border-radius:10px;-webkit-border-radius:10px;text-shadow:none;-moz-text-shadow:none;-webkit-text-shadow:none">Search</span></button>
            </form>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">


                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">


                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Business Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Chamber & VAT
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Country & City
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Address & Website
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Phone
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Location
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($logistic_business as $lb)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{$lb->business_photo_url ? Storage::url($lb->business_photo_url) : 'https://ui-avatars.com/api/?name='.urlencode($lb->business_name).'&color=7F9CF5&background=EBF4FF'}}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{$lb->business_name}}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{$lb->business_email}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            Chamber: <a href="{{$lb->chamber_reg_path ? Storage::url($lb->chamber_reg_path) : '#'}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{$lb->chamber_reg_number}}</a>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            VAT: <a href="{{$lb->vat_reg_certificate_path ? Storage::url($lb->vat_reg_certificate_path) : '#'}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{$lb->vat_reg_certificate_number}}</a>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{$lb->country}}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{$lb->city}}
                                        </div>
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{$lb->address}}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{$lb->website}}
                                        </div>
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                           <a href="tel:{{$lb->phone}}">{{$lb->phone}}</a>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="https://maps.google.com/?q={{$lb->latitude}},{{$lb->longitude}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">View On Map</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{route('logistics.edit',$lb->id)}}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
