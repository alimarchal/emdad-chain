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
            <form action="{{route('logistics.index')}}" method="get">
                <div class="mb-3 -mx-2 flex items-end">
                    <div class="px-2 w-1/2">
                        <div>
                            <label class="font-bold text-sm mb-2 ml-1">Business Name</label>
                            <input name="filter[business_name]" value="" class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                        </div>
                    </div>
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Phone</label>
                        <input name="filter[vat_reg_certificate_number]" value="" class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                    </div>
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Chamber VAT</label>
                        <input name="filter[phone]" value="" class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">

                    </div>
                </div>


                <input type="submit"class="inline-flex items-center justify-center px-4 py-2 mb-4 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150 cursor-pointer" value="Search">
                {{--                <button class="mb-5 su-button su-button-style-3d" style="color:#FFF;background-color:#0CAFFA;border-color:#0a8cc8;border-radius:10px;-moz-border-radius:10px;-webkit-border-radius:10px" target="_blank" rel="nofollow"><span--}}
                {{--                        style="color:#FFF;padding:0px 26px;font-size:20px;line-height:40px;border-color:#55c7fc;border-radius:10px;-moz-border-radius:10px;-webkit-border-radius:10px;text-shadow:none;-moz-text-shadow:none;-webkit-text-shadow:none">Search</span></button>--}}
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
                                    Boxes & Weight (Kg)
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Size (cm)
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                   Printing
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Commodity
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    MSDS
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
                            @foreach($packagingSolution as $lb)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Quantity of Boxes / Pieces: {{$lb->box_quantity_pieces}}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    Weight/Piece (Kg): {{$lb->weight_piece}}
                                                </div>

                                                <div class="text-sm font-medium text-gray-900">
                                                    Forklift / Manual:
                                                    @if($lb->forklift == 1) Yes - Automatic @else No - Manual @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            Length:&nbsp;&nbsp;{{$lb->length}}
{{--                                            Chamber: <a href="{{$lb->chamber_reg_path ? Storage::url($lb->chamber_reg_path) : '#'}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{$lb->chamber_reg_number}}</a>--}}
                                        </div>
                                        <div class="text-sm text-gray-900">
                                            Width:&nbsp;&nbsp;&nbsp;{{$lb->width}}
                                        </div>

                                        <div class="text-sm text-gray-900">
                                            Height:&nbsp;&nbsp;{{$lb->height}}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            Printing: &nbsp; @if($lb->printing == 1) Yes @else No @endif
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <a href="{{$lb->printing_design ? Storage::url($lb->printing_design) : '#'}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Printing Design</a>
                                        </div>
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            Commodity Type: &nbsp;{{$lb->commodity_type}}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            Commodity Info: &nbsp;{{$lb->commodity_information}}
                                        </div>
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <a href="{{$lb->msds ? Storage::url($lb->msds) : '#'}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">MSDS</a>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            MSDS Info: &nbsp;{{$lb->msds_information}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="https://maps.google.com/?q={{$lb->latitude}},{{$lb->longitude}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">View On Map</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{route('packagingSolution.edit',$lb->id)}}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
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
