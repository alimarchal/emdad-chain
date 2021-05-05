@extends('ire.arabic.layout.app')
@section('headerScripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

@endsection
@section('body')
    <div class="mt-4">
        <div class="flex flex-wrap -mx-6" style="direction: rtl">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                        <i class="fa fa-file-pdf"></i>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700"></h4>
                        <div class="text-gray-500"><a href="javascript:void(0)">E-business card</a></div>
                    </div>
                    <div class="text-gray-500" style="padding-right: 30%; font-size: 35px;"><a href="javascript:void(0)"><i class="fa fa-arrow-circle-down"></i></a></div>
                </div>

            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-orange-600 bg-opacity-75">
                        <i class="fa fa-file-excel-o"></i>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700"></h4>
                            <div class="text-gray-500"><a href="javascript:void(0)">Sales file</a></div>
                        <div class="text-gray-500"></div>
                    </div>
                    <div class="text-gray-500" style="padding-right: 40%; font-size: 35px;"><a href="javascript:void(0)"><i class="fa fa-arrow-circle-down"></i></a></div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                        <i class="fa fa-file-pdf"></i>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700"></h4>
                        <div class="text-gray-500"><a href="javascript:void(0)">Emdad profile</a>
                        </div>
                        <div class="text-gray-500"></div>
                    </div>
                    <div class="text-gray-500" style="padding-right: 35%; font-size: 35px;"><a href="javascript:void(0)"><i class="fa fa-arrow-circle-down"></i></a></div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0" style="padding-top: 15px;">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                        <i class="fa fa-file-powerpoint-o"></i>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700"></h4>
                        <div class="text-gray-500"><a href="javascript:void(0)">Sample presentation</a>
                        </div>
                        <div class="text-gray-500"></div>
                    </div>
                    <div class="text-gray-500" style="padding-right: 20%; font-size: 35px;"><a href="javascript:void(0)"><i class="fa fa-arrow-circle-down"></i></a></div>
                </div>
            </div>

        </div>
    </div>

@endsection
