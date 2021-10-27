@section('headerScripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{ url('select2/src/select2totree.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ url('select2/src/select2totree.js') }}"></script>

    <style>
        #datepicker {
            width: 100%;
            padding: 10px;
            cursor: default;
            /*text-transform: uppercase;*/
            font-size: 13px;
            background: #FFFFFF;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            border: solid 1px #d2d6dc;
            box-shadow: none;
        }
    </style>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
    {{--    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                minDate: 0,
                clear: true,
            });
        });
    </script>

@endsection

@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <style type="text/css">
            /* color for request for quotation heading*/
            .color-7f7f7f {
                color: #7f7f7f;
            }

            .color-1f3864 {
                color: #1f3864;
            }

            tbody tr:hover {
                background-color: #F3F3F3;
                /*cursor: pointer;*/
            }


            input,
            .description,
            .selection .select2-selection {
                height: 35px;
            }

            .description {
                border: 1px solid #d2d6dc;
                resize: none;
                margin-top: 8px;
                padding: 2px 10px;
            }

            .description:focus {
                outline: none;
                box-shadow: 0 0 0 3px rgba(164, 202, 254, 0.45);
                border-color: #a4cafe;
            }

            select:hover, .file-label:hover {
                cursor: pointer;
            }


            .select2-selection--single {
                border-color: #d2d6dc !important;
                /*display: inline;*/
                /*  border: none !important;*/
                /*background-color: transparent !important;*/
            }

            .select2-selection__rendered, .uom, input::placeholder,
            textarea::placeholder {
                color: #000000 !important;

            }

            /*.select2-container*/
            /*{*/
            /*    width:auto !important;*/

            /*}*/

            @media screen and (max-width: 360px) {
                .date {
                    margin-left: auto;
                    margin-right: auto;
                }
            }

        </style>

        {{-- getting latest record from database to be filled in fields  --}}
        @if(isset($rfqCount) && $rfqCount > 0)


            <div class="flex flex-col bg-white rounded">
                <div class="p-4"
                     style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
                    <div class="d-block text-center">
                        <span class="text-2xl font-bold color-7f7f7f">{{__('portal.New RFQ')}}</span>
                    </div>
                    <hr>
                    <div style=" min-height: 145px;" class="container-fluid px-4 flex bg-grey flex-wrap">
                        <div class="flex-1 py-5">
                            <div class="my-5 pl-5">
                                <img
                                    src="{{(isset(auth()->user()->business->business_photo_url)?Storage::url(auth()->user()->business->business_photo_url):'#')}}"
                                    alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                            @php
                                $user_business_details=auth()->user()->business;
                            @endphp
                            <div class="my-5 pl-5 ">
                                <h1 class="font-extrabold color-1f3864 text-xl ">{{$user_business_details->business_name}}</h1>
                            </div>
                        </div>

                        <div class="flex-1 ">
                            <div class="ml-auto date" style="width:150px; ">
                                <br>
                                <span class="color-1f3864 font-bold">{{__('portal.Date')}}:
                            {{\Carbon\Carbon::today()->format('Y-m-d')}}</span><br>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('RFQCart.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class=" mb-3">
                        <div>
                            <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="flex">

                                <div class="left-info_holder flex-1">
                                    <div class="my-5 pl-5 " style="padding-left: 40px;">
                                        <span
                                            class="font-bold color-1f3864 text-lg">{{__('portal.Requisition Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 " style="padding-left: 40px;">

                                        {{__('portal.Display Company Name')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="company_name_check" id="company_name_check">
                                                <option value="">{{__('portal.Select')}}</option>
                                                <option
                                                    @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 0 ? 'selected' : ''}}
                                                    @endif value="0">{{__('portal.No')}}
                                                </option>
                                                <option
                                                    @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 1  ? 'selected' : ''}}
                                                    @endif value="1">{{__('portal.Yes')}}
                                                </option>
                                            </select>
                                        </div>


                                        <br>
                                        {{__('portal.Payment Mode')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="payment_mode" id="payment_mode" required>
                                                <option value="">{{__('portal.None')}}</option>

                                                <option value="Cash" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Cash' ? 'selected' : ''}} @endif>
                                                    {{__('portal.Cash')}}
                                                </option>

                                                @php
                                                    $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();

                                                @endphp

                                                {{--@if(auth()->user()->business_package->package_id != 1)--}}
                                                @if($package->package_id != 1)
                                                    {{--<option value="Credit" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit')}}
                                                    </option>--}}
                                                    <option value="Credit30days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit30days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (30 Days)')}}
                                                    </option>
                                                    <option value="Credit60days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit60days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (60 Days)')}}
                                                    </option>
                                                    <option value="Credit90days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit90days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (90 Days)')}}
                                                    </option>
                                                    <option value="Credit120days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit120days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (120 Days)')}}
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Required Sample')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="required_sample" id="required_sample">
                                                <option value="">{{__('portal.None')}}</option>
                                                <option value="Yes" @if (isset($latest_rfq))
                                                    {{$latest_rfq->required_sample =='Yes' ? 'selected' : ''}} @endif>
                                                    {{__('portal.Yes')}}
                                                </option>
                                                <option value="No" @if (isset($latest_rfq))
                                                    {{$latest_rfq->required_sample =='No' ? 'selected' : ''}} @endif>
                                                    {{__('portal.No')}}
                                                </option>

                                            </select>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <div class="Right-info_holder flex-1">
                                    <div class="my-5 pl-5 ">
                                        <span
                                            class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        {{__('portal.Warehouse Location')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="warehouse_id" id="warehouse_id">
                                                <option value="">{{__('portal.Select Warehouse Location')}}</option>
                                                @foreach(\App\Models\BusinessWarehouse::where('business_id',
                                                auth()->user()->business_id)->get() as $warehouse)
                                                    <option value="{{$warehouse->id}}" @if (isset($latest_rfq))
                                                        {{$latest_rfq->warehouse_id ==$warehouse->id ? 'selected' : ''}} @endif>
                                                        {{$warehouse->address }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>

                                            {{--                                            <input type="text" id="datepicker" class="block mt-1 w-full" name="delivery_period" value="{{old('delivery_period')}}" placeholder="{{__('portal.Select Delivery Period')}}" readonly>--}}

                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="delivery_period" id="delivery_period" required>
                                                <option value="">{{__('portal.Select Delivery Period')}}</option>
                                                <option value="Immediately" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Immediately' ? 'selected' : ''}} @endif>
                                                    {{__('portal.Immediately')}}
                                                </option>
                                                <option value="Within 30 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 30 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.30 Days')}}
                                                </option>
                                                <option value="Within 60 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 60 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.60 Days')}}
                                                </option>
                                                <option value="Within 90 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 90 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.90 Days')}}
                                                </option>
                                                <option value="Standing Order - 2 per year" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 2 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 2 times / year')}}
                                                </option>
                                                <option value="Standing Order - 3 per year" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 3 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 3 times / year')}}
                                                </option>
                                                <option value="Standing Order - 4 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 4 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 4 times / year')}}
                                                </option>
                                                <option value="Standing Order - 6 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 6 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 6 times / year')}}
                                                </option>
                                                <option value="Standing Order - 12 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 12 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 12 times / year')}}
                                                </option>
                                                <option value="Standing Order Open" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order Open' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - Open')}}
                                                </option>

                                            </select>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p4 mb-5 overflow-x-auto">
                        <!-- Remaining RFQ count for Basic and Silver Business Packages -->
                        @php
                            $rfq = \App\Models\EOrders::where('business_id', auth()->user()->business_id)->whereDate('created_at',
                            \Carbon\Carbon::today())->count();

                            $business_package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
                            $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                            $count = $package->rfq_per_day - $rfq;
                        @endphp
                        @if($business_package->package_id == 1 || $business_package->package_id == 2 )
                            <div class="flex flex-wrap pl-5 " style="justify-content: center">
                                <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Requisition(s) remaining for the day')}}
                                    : </h1>
                                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$count}} </h1>
                            </div>
                        @endif


                        <table class="table-fixed text-center min-w-full ">
                            <thead style="background-color:#8EAADB" class="text-white">
                            <tr>
                                <th style="width:15%;">{{__('portal.Category')}} @include('misc.required')</th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:7%"
                                    title="{{__('portal.Unit of Measurement')}}">{{__('portal.UOM')}} @include('misc.required') </th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required') </th>
                                <th style="width:10%;">{{__('portal.Size')}}</th>
                                <th style="width:10%;">{{__('portal.Brand')}}</th>
                                <th style="width:7%;" title="{{__('portal.UP')}}">{{__('portal.Last Unit Price')}}</th>
                                <th style="width:15%;">{{__('portal.Shipment Remarks')}}</th>
                                <th style="width:7%;">
                                    <svg style="margin: auto;" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                    </svg>
                                </th>
                                <th style="width:7%;">
                                    <svg style="margin: auto;" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 myrow">

                            @foreach($eCart as $item)
                                <tr>
                                    <td>
                                        @php
                                            $record = \App\Models\Category::where('id',$item->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp

                                        {{ $record->name}} @if(isset($parent)), {{ $parent->name}} @endif

                                    </td>
                                    <td>
                                        {{strip_tags($item->description)}}
                                    </td>
                                    <td>{{$item->unit_of_measurement}}</td>
                                    <td>
                                        {{$item->quantity}}
                                    </td>
                                    <td>
                                        {{$item->size}}
                                    </td>
                                    <td>
                                        {{$item->brand}}
                                    </td>

                                    <td> {{ number_format($rfp->last_price, 2) }} {{__('portal.SAR')}}</td>
                                    <td>
                                        {{$item->remarks}}
                                    </td>
                                    <td class="">
                                        @if ($item->file_path)
                                            <a href="{{ Storage::url($rfp->file_path) }}">
                                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg>
                                            </a>
                                        @else
                                            {{__('portal.N/A')}}
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            <tr>
                                <td>
                                    <div class="w-full overflow-hidden">
                                        @include('category.rfp')
                                    </div>
                                </td>
                                <td>
                                    <textarea name="description" id="description"
                                              class="w-full description rounded-md shadow-sm" maxlength="254"
                                              placeholder="{{__('portal.Enter Description..')}}" required></textarea>
                                    <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                                </td>
                                <td>
                                    <div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-1.5 mt-4 pointer-events-none"
                                             style="width: 8px; height:8px;"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </svg>
                                        <select
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom"
                                            required name="unit_of_measurement" id="unit_of_measurement"
                                            style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" min="0" autocomplete="quantity" required
                                           placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text"
                                           name="size"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" min="0" autocomplete="brand"
                                           placeholder="{{__('portal.Brand')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" min="0" autocomplete="last_price"
                                           placeholder="{{__('portal.Price')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks"
                                           type="text" autocomplete="remarks" placeholder="{{__('portal.Remarks')}}">
                                </td>
                                <td>
                                    <label for="file" class="file-label"><img class="mx-auto" style="width:25px;"
                                                                              src="https://img.icons8.com/pastel-glyph/64/000000/upload-document--v1.png"/></label>
                                    <input class="shadow-sm block w-full" id="file" type="file" name="file_path_1"
                                           autocomplete="name" style="display:none;">
                                </td>
                            </tr>


                            </tbody>
                        </table>


                        <div class="text-center my-4">
                            <button type="submit"
                                    class="inline-flex items-center add-more  px-4 mr-2 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                Add to Cart
                                <svg class="svg-icon w-5 h-4" stroke="currentColor" viewBox="0 0 20 20"
                                     style="margin-left: 5px;">
                                    <path
                                        d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                                </svg>
                            </button>

                            <a href="{{route('RFQCart.index')}}"
                               class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}
                                <img src="{{asset('cart.png')}}" style="margin-left: 10px;margin-bottom: 2px;">

                            </a>
                        </div>
                    </div>


                </form>

                <div class="mx-2 py-2">
                    <form action="{{ route('EOrders.store') }}" method="POST">
                        @csrf
                        @foreach ($eCart as $rfp)
                            <input type="hidden" name="item_number[]" value="{{ $rfp->id }}">
                        @endforeach

                        <input type="hidden" value="{{ auth()->user()->business->id }}" name="business_id">
                        <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                        <button type="submit"
                                class="inline-flex float-right items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-gray-600 transition ease-in-out duration-150 confirm"
                                data-confirm='{{__('portal.Select Ok to place requisition')}}'>
                            {{__('portal.Place RFQ')}}
                        </button>
                    </form>
                </div>


            </div>

        @elseif(is_null($rfqCount))
            <h2 class="text-2xl font-bold py-2 text-center"></h2>

            <br>
            @if ($eCart->count())
                @foreach ($eCart as $rfp)
                    @php
                        $record = \App\Models\Category::where('id',$rfp->item_code)->first();
                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                    @endphp
                @endforeach
            @endif

            <div class="flex flex-col bg-white rounded">
                <div class="p-4"
                     style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
                    <div class="d-block text-center">
                        <span class="text-2xl font-bold color-7f7f7f">{{__('portal.New RFQ')}}</span>

                    </div>
                    <hr>
                    <div style=" min-height: 145px;" class="container-fluid px-4 flex bg-grey flex-wrap">
                        <div class="flex-1 py-5">
                            <div class="my-5 pl-5">
                                {{-- <img src="{{ Storage::url(Auth::user()->business->business_photo_url) }}" alt="logo"
                                style="height: 80px;width: 200px;" /> --}}
                                <img
                                    src="{{(isset(auth()->user()->business->business_photo_url)?Storage::url(auth()->user()->business->business_photo_url):'#')}}"
                                    alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                            @php
                                $user_business_details=auth()->user()->business;
                            @endphp
                            <div class="my-5 pl-5 ">
                                <h1 class="font-extrabold color-1f3864 text-xl ">{{$user_business_details->business_name}}</h1>
                                {{-- <span>Location :
                                <span class="font-bold">{{$user_business_details->city}}</span></span> <br>
                                <span>Emdad Id : <span class="font-bold">{{Auth::user()->business_id}}</span></span> --}}
                            </div>
                        </div>

                        <div class="flex-1 ">
                            <div class="ml-auto date" style="width:150px; ">
                                <br>
                                <span class="color-1f3864 font-bold">{{__('portal.Date')}}:
                            {{\Carbon\Carbon::today()->format('Y-m-d')}}</span><br>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('RFQCart.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class=" mb-3">
                        <div>
                            <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="md:flex">

                                <div class="left-info_holder md:flex-1">
                                    <div class="my-5 pl-5 " style="padding-left: 20px">
                                        <span
                                            class="font-bold color-1f3864 text-lg">{{__('portal.Requisition Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5" style="padding-left: 20px">

                                        {{__('portal.Display Company Name')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="company_name_check" id="company_name_check">
                                                <option value="">{{__('portal.Select')}}</option>
                                                <option
                                                    @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 0 ? 'selected' : ''}}
                                                    @endif value="0">{{__('portal.No')}}
                                                </option>
                                                <option
                                                    @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 1  ? 'selected' : ''}}
                                                    @endif value="1">{{__('portal.Yes')}}
                                                </option>
                                            </select>
                                        </div>


                                        <br>
                                        {{__('portal.Payment Mode')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="payment_mode" id="payment_mode" required>
                                                <option value="">{{__('portal.None')}}</option>

                                                <option value="Cash" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Cash' ? 'selected' : ''}} @endif>{{__('portal.Cash')}}
                                                </option>

                                                @php
                                                    $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();

                                                @endphp

                                                {{--@if(auth()->user()->business_package->package_id != 1)--}}
                                                @if($package->package_id != 1)
                                                    {{--<option value="Credit" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit')}}
                                                    </option>--}}
                                                    <option value="Credit30days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit30days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (30 Days)')}}
                                                    </option>
                                                    <option value="Credit60days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit60days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (60 Days)')}}
                                                    </option>
                                                    <option value="Credit90days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit90days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (90 Days)')}}
                                                    </option>
                                                    <option value="Credit120days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit120days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (120 Days)')}}
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Required Sample')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="required_sample" id="required_sample">
                                                <option value="">{{__('portal.None')}}</option>
                                                <option value="Yes" @if (isset($latest_rfq))
                                                    {{$latest_rfq->required_sample =='Yes' ? 'selected' : ''}} @endif>
                                                    {{__('portal.Yes')}}
                                                </option>
                                                <option value="No" @if (isset($latest_rfq))
                                                    {{$latest_rfq->required_sample =='No' ? 'selected' : ''}} @endif>
                                                    {{__('portal.No')}}
                                                </option>

                                            </select>
                                        </div>
                                        <br>


                                    </div>
                                </div>
                                <div class="Right-info_holder md:flex-1">
                                    <div class="my-5 pl-5 ">
                                        <span
                                            class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        {{__('portal.Warehouse Location')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="warehouse_id" id="warehouse_id">
                                                <option value="">{{__('portal.Select Warehouse Location')}}</option>
                                                @foreach(\App\Models\BusinessWarehouse::where('business_id', auth()->user()->business_id)->get() as $warehouse)
                                                    <option value="{{$warehouse->id}}" @if (isset($latest_rfq))
                                                        {{$latest_rfq->warehouse_id ==$warehouse->id ? 'selected' : ''}} @endif>
                                                        {{$warehouse->address }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="delivery_period" id="delivery_period" required>
                                                <option value="">{{__('portal.Select Delivery Period')}}</option>
                                                <option value="Immediately" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Immediately' ? 'selected' : ''}} @endif>
                                                    {{__('portal.Immediately')}}
                                                </option>
                                                <option value="Within 30 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 30 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.30 Days')}}
                                                </option>
                                                <option value="Within 60 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 60 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.60 Days')}}
                                                </option>
                                                <option value="Within 90 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 90 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.90 Days')}}
                                                </option>
                                                <option value="Standing Order - 2 per year" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 2 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 2 times / year')}}
                                                </option>
                                                <option value="Standing Order - 3 per year" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 3 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 3 times / year')}}
                                                </option>
                                                <option value="Standing Order - 4 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 4 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 4 times / year')}}
                                                </option>
                                                <option value="Standing Order - 6 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 6 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 6 times / year')}}
                                                </option>
                                                <option value="Standing Order - 12 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 12 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 12 times / year')}}
                                                </option>
                                                <option value="Standing Order Open" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order Open' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - Open')}}
                                                </option>

                                            </select>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p4 mb-5 overflow-x-auto">

                        <table class="table-fixed text-center min-w-full ">
                            <thead style="background-color:#8EAADB" class="text-white">
                            <tr>

                                <th style="width:15%;">{{__('portal.Category')}} @include('misc.required')</th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:7%"
                                    title="{{__('portal.Unit of Measurement')}}">{{__('portal.UOM')}} @include('misc.required') </th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required') </th>
                                <th style="width:10%;">{{__('portal.Size')}}</th>
                                <th style="width:10%;">{{__('portal.Brand')}}</th>
                                <th style="width:7%;" title="{{__('portal.UP')}}">{{__('portal.Last Unit Price')}}</th>
                                <th style="width:15%;">{{__('portal.Shipment Remarks')}}</th>
                                <th style="width:7%;">{{__('portal.Attachments')}}</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach($eCart as $item)
                                <tr>
                                    <td>
                                        @php
                                            $record = \App\Models\Category::where('id',$item->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp

                                        {{ $record->name}} @if(isset($parent)), {{ $parent->name}} @endif

                                    </td>
                                    <td>
                                        {{strip_tags($item->description)}}
                                    </td>
                                    <td>{{$item->unit_of_measurement}}</td>
                                    <td>
                                        {{$item->quantity}}
                                    </td>
                                    <td>
                                        {{$item->size}}
                                    </td>
                                    <td>
                                        {{$item->brand}}
                                    </td>

                                    <td> {{ number_format($rfp->last_price, 2) }} {{__('portal.SAR')}}</td>
                                    <td>
                                        {{$item->remarks}}
                                    </td>
                                    <td class="">
                                        @if ($item->file_path)
                                            <a href="{{ Storage::url($rfp->file_path) }}">
                                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg>
                                            </a>
                                        @else
                                            {{__('portal.N/A')}}
                                        @endif
                                    </td>

                                </tr>
                            @endforeach

                            <tr>

                                <td>
                                    <div class="w-full overflow-hidden">
                                        <!-- Column Content -->
                                        @include('category.rfp')
                                    </div>
                                </td>
                                <td>
                                <textarea name="description" id="description"
                                          class="w-full description rounded-md shadow-sm" maxlength="254"
                                          placeholder="{{__('portal.Enter Description..')}}" required></textarea>
                                    <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                                </td>
                                <td>
                                    <div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-1.5 mt-4 pointer-events-none"
                                             style="width: 8px; height: 8px;"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </svg>
                                        <select
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom"
                                            required name="unit_of_measurement" id="unit_of_measurement"
                                            style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" min="0" autocomplete="quantity" required
                                           placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text"
                                           name="size"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td><input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" min="0" autocomplete="brand"
                                           placeholder="{{__('portal.Brand')}}"></td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" min="0" autocomplete="last_price"
                                           placeholder="{{__('portal.Price')}}">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks"
                                           type="text" autocomplete="remarks" placeholder="{{__('portal.Remarks')}}">
                                </td>

                                <td>

                                    <label for="file" class="file-label"><img class="mx-auto" style="width:25px;"
                                                                              src="https://img.icons8.com/pastel-glyph/64/000000/upload-document--v1.png"/></label>
                                    <input class="shadow-sm block w-full" id="file" type="file" name="file_path_1"
                                           autocomplete="name" style="display:none;">
                                </td>
                            </tr>


                            </tbody>
                        </table>
                        <div class="text-center my-4">
                            <button type="submit"
                                    class="inline-flex items-center add-more  px-4 mr-2 py-3 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.ADD ITEM')}}
                                <svg class="svg-icon w-5 h-4" stroke="currentColor" viewBox="0 0 20 20"
                                     style="margin-left: 5px;">
                                    <path
                                        d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                                </svg>
                            </button>


                            <a href="{{route('RFQCart.index')}}"
                               class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}
                                <img src="{{asset('cart.png')}}" style="margin-left: 10px;margin-bottom: 2px;">
                                {{--<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg" style="margin-left: 10px;">
                                    <path fill="none"
                                          d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                                    <path fill="none"
                                          d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                                    <path fill="none"
                                          d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
                                </svg>--}}
                            </a>
                        </div>

                    </div>

                </form>

                @if($eCart->isNotEmpty())

                    <div class="p-4">
                        <form action="{{ route('EOrders.store') }}" method="POST">
                            @csrf
                            @foreach ($eCart as $rfp)
                                <input type="hidden" name="item_number[]" value="{{ $rfp->id }}">
                            @endforeach

                            <input type="hidden" value="{{ auth()->user()->business->id }}" name="business_id">
                            <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                            <button type="submit"
                                    class="inline-flex float-right items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150 confirm"
                                    data-confirm='{{__('portal.Select Ok to place requisition')}}'>
                                {{__('portal.Place RFQ')}}
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @else
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                            <div class="text-black text-2xl" style="text-align: center">
                                {{__('portal.Your have reached daily requisition generate limit.')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </x-app-layout>

    <script>
        $('.company_name_check').change(function () {
            // alert($(this).attr('data-id'));
            // alert($(this).val());
            let status = $(this).val();
            let rfqId = $(this).attr('data-id');
            // alert(rfqId);


            $.ajax({
                type: 'POST',
                url: "{{ route('companyCheck') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'rfqNo': rfqId,
                    'status': status
                },
                success: function (response) {
                    if (response.status === 0) {
                        alert('Not Updated Try again');
                    } else if (response.status === 1) {
                        alert('Updated Successfully!');
                        // $('#status').show().delay(5000).fadeOut();
                    }
                }
            });
        });
    </script>
@else
    <x-app-layout>
        <style type="text/css">
            /* color for request for quotation heading*/
            .color-7f7f7f {
                color: #7f7f7f;
            }

            .color-1f3864 {
                color: #1f3864;
            }

            tbody tr:hover {
                background-color: #F3F3F3;
                /*cursor: pointer;*/
            }


            input,
            .description,
            .selection .select2-selection {
                height: 35px;
            }

            .description {
                border: 1px solid #d2d6dc;
                resize: none;
                margin-top: 8px;
                padding: 2px 10px;
            }

            .description:focus {
                outline: none;
                box-shadow: 0 0 0 3px rgba(164, 202, 254, 0.45);
                border-color: #a4cafe;
            }

            select:hover, .file-label:hover {
                cursor: pointer;
            }


            .select2-selection--single {
                border-color: #d2d6dc !important;
                /*display: inline;*/
                /*  border: none !important;*/
                /*background-color: transparent !important;*/
            }

            .select2-selection__rendered, .uom, input::placeholder,
            textarea::placeholder {
                color: #000000 !important;

            }

            /*.select2-container*/
            /*{*/
            /*    width:auto !important;*/

            /*}*/

            @media screen and (max-width: 360px) {
                .date {
                    margin-left: auto;
                    margin-right: auto;
                }
            }

        </style>

        {{-- getting latest record from database to be filled in fields  --}}
        @if(isset($rfqCount) && $rfqCount > 0)


            <h2 class="text-2xl font-bold py-2 text-center"></h2>

            <div class="flex flex-col mb-5 ">
                <div class="cart">
                    @if ($eCart->count())
                        @php $total = 0; @endphp
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                #
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                {{__('portal.Category Name')}}
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                {{__('portal.Description')}}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                {{__('portal.Unit')}}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                {{__('portal.Size')}}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                {{__('portal.Quantity')}}
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                {{__('portal.Last Price')}}
                                            </th>


                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                {{__('portal.Delivery Period')}}
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                {{__('portal.Payment Mode')}}
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                {{__('portal.Show Company Name')}}
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider"
                                                title="Attachment">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg>
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider">
                                                {{__('portal.Action')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($eCart as $rfp)
                                            <tr>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @php
                                                        $record = \App\Models\Category::where('id',$rfp->item_code)->first();
                                                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                    @endphp
                                                    {{ $record->name_ar }} @if(isset($parent->name))
                                                        , {{ $parent->name_ar}} @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ strip_tags($rfp->description) }}
                                                </td>
                                                <td class="px-6 py- text-center4 whitespace-nowrap text-sm text-gray-500">
                                                    @php $UOM = \App\Models\UnitMeasurement::firstWhere('uom_en', $rfp->unit_of_measurement); @endphp {{$UOM->uom_ar}}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->size }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->quantity }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ number_format($rfp->last_price, 2) }} {{__('portal.SAR')}} <br>
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if($rfp->delivery_period =='Immediately') {{__('portal.Immediately')}}
                                                    @elseif($rfp->delivery_period =='Within 30 Days') {{__('portal.30 Days')}}
                                                    @elseif($rfp->delivery_period =='Within 60 Days') {{__('portal.60 Days')}}
                                                    @elseif($rfp->delivery_period =='Within 90 Days') {{__('portal.90 Days')}}
                                                    @elseif($rfp->delivery_period =='Standing Order - 2 per year') {{__('portal.Standing Order - 2 times / year')}}
                                                    @elseif($rfp->delivery_period =='Standing Order - 3 per year') {{__('portal.Standing Order - 3 times / year')}}
                                                    @elseif($rfp->delivery_period =='Standing Order - 4 per year') {{__('portal.Standing Order - 4 times / year')}}
                                                    @elseif($rfp->delivery_period =='Standing Order - 6 per year') {{__('portal.Standing Order - 6 times / year')}}
                                                    @elseif($rfp->delivery_period =='Standing Order - 12 per year') {{__('portal.Standing Order - 12 times / year')}}
                                                    @elseif($rfp->delivery_period =='Standing Order Open') {{__('portal.Standing Order - Open')}}
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if($rfp->payment_mode == 'Cash')
                                                        {{__('portal.Cash')}}
                                                    @elseif($rfp->payment_mode == 'Credit')
                                                        {{__('portal.Credit')}}
                                                    @elseif($rfp->payment_mode == 'Credit30days')
                                                        {{__('portal.Credit (30 Days)')}}
                                                    @elseif($rfp->payment_mode == 'Credit60days')
                                                        {{__('portal.Credit (60 Days)')}}
                                                    @elseif($rfp->payment_mode == 'Credit90days')
                                                        {{__('portal.Credit (90 Days)')}}
                                                    @elseif($rfp->payment_mode == 'Credit120days')
                                                        {{__('portal.Credit (120 Days)')}}
                                                    @endif
                                                </td>

                                                <td class="px-2 py-3 text-center whitespace-nowrap">
                                                    <select name="company_name_check" id="company_name_check"
                                                            data-id="{{$rfp->id}}"
                                                            class="form-select shadow-sm block w-full company_name_check"
                                                            required>
                                                        <option
                                                            {{($rfp->company_name_check == 0) ? 'selected' : ''}} value="0">{{__('portal.No')}}</option>
                                                        <option
                                                            {{($rfp->company_name_check == 1) ? 'selected' : ''}} value="1">{{__('portal.Yes')}}</option>
                                                    </select>
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    @if ($rfp->file_path)
                                                        <a href="{{ Storage::url($rfp->file_path) }}">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                                 viewBox="0 0 24 24"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                    @else
                                                        {{__('portal.N/A')}}
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <form method="POST"
                                                          action="{{ route('RFQCart.destroy', $rfp->id) }}"
                                                          class="inline confirm"
                                                          data-confirm='{{__('portal.Are you sure you want to delete?')}}'>
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit"
                                                                class="text-indigo-600 inline-block hover:text-indigo-900"
                                                                title="{{__('portal.DELETE')}}">
                                                            <svg width="18" xmlns="http://www.w3.org/2000/svg"
                                                                 viewBox="0 0 20 20"
                                                                 fill="orange">
                                                                <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                                                                <path fill-rule="evenodd"
                                                                      d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                                                      clip-rule="evenodd"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <br>

            <div class="flex flex-col bg-white rounded">
                <div class="p-4"
                     style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
                    <div class="d-block text-center">
                        <span class="text-2xl font-bold color-7f7f7f">{{__('portal.New RFQ')}}</span>
                    </div>
                    <hr>
                    <div style=" min-height: 145px;" class="container-fluid px-4 flex bg-grey flex-wrap">
                        <div class="flex-1 py-5">
                            <div class="my-5 pl-5">
                                <img
                                    src="{{(isset(auth()->user()->business->business_photo_url)?Storage::url(auth()->user()->business->business_photo_url):'#')}}"
                                    alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                            @php
                                $user_business_details=auth()->user()->business;
                            @endphp
                            <div class="my-5 pl-5 ">
                                <h1 class="font-extrabold color-1f3864 text-xl ">{{$user_business_details->business_name}}</h1>
                            </div>
                        </div>

                        <div class="flex-1 ">
                            <div class="ml-auto date" style="width:150px; float: left">
                                <br>
                                <span class="color-1f3864 font-bold">{{__('portal.Date')}}:
                            {{\Carbon\Carbon::today()->format('Y-m-d')}}</span><br>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('RFQCart.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class=" mb-3">
                        <div>
                            <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="flex">

                                <div class="left-info_holder flex-1 m-2">
                                    <div class="my-5 pl-5 " style="padding-left: 40px;">
                                        <span
                                            class="font-bold color-1f3864 text-lg">{{__('portal.Requisition Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 " style="padding-left: 40px;">

                                        {{__('portal.Display Company Name')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="company_name_check" id="company_name_check">
                                                <option value="">{{__('portal.Select')}}</option>
                                                <option
                                                    @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 0 ? 'selected' : ''}}
                                                    @endif value="0">{{__('portal.No')}}
                                                </option>
                                                <option
                                                    @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 1  ? 'selected' : ''}}
                                                    @endif value="1">{{__('portal.Yes')}}
                                                </option>
                                            </select>
                                        </div>


                                        <br>
                                        {{__('portal.Payment Mode')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="payment_mode" id="payment_mode" required>
                                                <option value="">{{__('portal.None')}}</option>

                                                <option value="Cash" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Cash' ? 'selected' : ''}} @endif>
                                                    {{__('portal.Cash')}}
                                                </option>

                                                @php
                                                    $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();

                                                @endphp

                                                {{--@if(auth()->user()->business_package->package_id != 1)--}}
                                                @if($package->package_id != 1)
                                                    {{--<option value="Credit" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit')}}
                                                    </option>--}}
                                                    <option value="Credit30days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit30days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (30 Days)')}}
                                                    </option>
                                                    <option value="Credit60days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit60days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (60 Days)')}}
                                                    </option>
                                                    <option value="Credit90days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit90days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (90 Days)')}}
                                                    </option>
                                                    <option value="Credit120days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit120days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (120 Days)')}}
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Required Sample')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="required_sample" id="required_sample">
                                                <option value="">{{__('portal.None')}}</option>
                                                <option value="Yes" @if (isset($latest_rfq))
                                                    {{$latest_rfq->required_sample =='Yes' ? 'selected' : ''}} @endif>
                                                    {{__('portal.Yes')}}
                                                </option>
                                                <option value="No" @if (isset($latest_rfq))
                                                    {{$latest_rfq->required_sample =='No' ? 'selected' : ''}} @endif>
                                                    {{__('portal.No')}}
                                                </option>

                                            </select>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <div class="Right-info_holder flex-1">
                                    <div class="my-5 pl-5 ">
                                        <span
                                            class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        {{__('portal.Warehouse Location')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="warehouse_id" id="warehouse_id">
                                                <option value="">{{__('portal.Select Warehouse Location')}}</option>
                                                @foreach(\App\Models\BusinessWarehouse::where('business_id',
                                                auth()->user()->business_id)->get() as $warehouse)
                                                    <option value="{{$warehouse->id}}" @if (isset($latest_rfq))
                                                        {{$latest_rfq->warehouse_id ==$warehouse->id ? 'selected' : ''}} @endif>
                                                        {{$warehouse->address }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="delivery_period" id="delivery_period" required>
                                                <option value="">{{__('portal.Select Delivery Period')}}</option>
                                                <option value="Immediately" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Immediately' ? 'selected' : ''}} @endif>
                                                    {{__('portal.Immediately')}}
                                                </option>
                                                <option value="Within 30 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 30 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.30 Days')}}
                                                </option>
                                                <option value="Within 60 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 60 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.60 Days')}}
                                                </option>
                                                <option value="Within 90 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 90 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.90 Days')}}
                                                </option>
                                                <option value="Standing Order - 2 per year" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 2 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 2 times / year')}}
                                                </option>
                                                <option value="Standing Order - 3 per year" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 3 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 3 times / year')}}
                                                </option>
                                                <option value="Standing Order - 4 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 4 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 4 times / year')}}
                                                </option>
                                                <option value="Standing Order - 6 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 6 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 6 times / year')}}
                                                </option>
                                                <option value="Standing Order - 12 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 12 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 12 times / year')}}
                                                </option>
                                                <option value="Standing Order Open" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order Open' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - Open')}}
                                                </option>

                                            </select>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p4 mb-5 overflow-x-auto">
                        <!-- Remaining RFQ count for Basic and Silver Business Packages -->
                        @php
                            $rfq = \App\Models\EOrders::where('business_id', auth()->user()->business_id)->whereDate('created_at',
                            \Carbon\Carbon::today())->count();

                            $business_package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
                            $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                            $count = $package->rfq_per_day - $rfq;
                        @endphp
                        @if($business_package->package_id == 1 || $business_package->package_id == 2 )
                            <div class="flex flex-wrap pl-5 " style="justify-content: center">
                                <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Requisition(s) remaining for the day')}}
                                    : </h1>
                                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$count}} </h1>
                            </div>
                        @endif


                        <table class="table-fixed text-center min-w-full ">
                            <thead style="background-color:#8EAADB" class="text-white">
                            <tr>

                                <th style="width:15%;">{{__('portal.Category')}} @include('misc.required')</th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:8%"
                                    title="{{__('portal.Unit of Measurement')}}">{{__('portal.UOM')}} @include('misc.required') </th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required') </th>
                                <th style="width:10%;">{{__('portal.Size')}}</th>
                                <th style="width:10%;">{{__('portal.Brand')}}</th>
                                <th style="width:7%;" title="{{__('portal.UP')}}">{{__('portal.Last Unit Price')}}</th>
                                <th style="width:15%;">{{__('portal.Shipment Remarks')}}</th>
                                <th style="width:7%;">{{__('portal.Attachments')}}</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach($eCart as $item)
                                <tr>
                                    <td>
                                        @php
                                            $record = \App\Models\Category::where('id',$item->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp

                                        {{ $record->name_ar}} @if(isset($parent)), {{ $parent->name_ar}} @endif

                                    </td>
                                    <td>
                                        {{strip_tags($item->description)}}
                                    </td>
                                    <td> @php $UOM = \App\Models\UnitMeasurement::firstWhere('uom_en', $item->unit_of_measurement); @endphp {{$UOM->uom_ar}}</td>
                                    <td>
                                        {{$item->quantity}}
                                    </td>
                                    <td>
                                        {{$item->size}}
                                    </td>
                                    <td>
                                        {{$item->brand}}
                                    </td>

                                    <td> {{ number_format($rfp->last_price, 2) }} {{__('portal.SAR')}}</td>
                                    <td>
                                        {{$item->remarks}}
                                    </td>
                                    <td class="">
                                        @if ($item->file_path)
                                            <a href="{{ Storage::url($rfp->file_path) }}">
                                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg>
                                            </a>
                                        @else
                                            {{__('portal.N/A')}}
                                        @endif
                                    </td>

                                </tr>
                            @endforeach

                            <tr>

                                <td>
                                    <div class="w-full overflow-hidden">
                                        <!-- Column Content -->
                                        @include('category.rfp')
                                    </div>
                                </td>
                                <td>
                                <textarea name="description" id="description"
                                          class="w-full description rounded-md shadow-sm" maxlength="254"
                                          placeholder="{{__('portal.Enter Description..')}}" required></textarea>
                                    <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                                </td>
                                <td>
                                    <div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-1.5 mt-4 pointer-events-none"
                                             style="width: 8px; height:8px;"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </svg>
                                        <select
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom"
                                            required name="unit_of_measurement" id="unit_of_measurement"
                                            style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option value="{{$item->uom_en}}">{{$item->uom_ar}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" min="0" autocomplete="quantity" required
                                           placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text"
                                           name="size"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td><input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" min="0" autocomplete="brand"
                                           placeholder="{{__('portal.Brand')}}"></td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" min="0" autocomplete="last_price"
                                           placeholder="{{__('portal.Price')}}">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks"
                                           type="text" autocomplete="remarks" placeholder="{{__('portal.Remarks')}}">
                                </td>

                                <td>

                                    <label for="file" class="file-label"><img class="mx-auto" style="width:25px;"
                                                                              src="https://img.icons8.com/pastel-glyph/64/000000/upload-document--v1.png"/></label>
                                    <input class="shadow-sm block w-full" id="file" type="file" name="file_path_1"
                                           autocomplete="name" style="display:none;">
                                </td>
                            </tr>


                            </tbody>
                        </table>
                        <div class="text-center my-4">
                            <button type="submit"
                                    class="inline-flex items-center add-more  px-4 mr-2 py-3 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.ADD ITEM')}}
                                <svg class="svg-icon w-5 h-4" stroke="currentColor" viewBox="0 0 20 20"
                                     style="margin-right: 5px;">
                                    <path
                                        d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                                </svg>
                            </button>

                            <a href="{{route('RFQCart.index')}}"
                               class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}
                                <img src="{{asset('cart.png')}}"
                                     style="margin-right: 10px;margin-bottom: 2px;transform: scaleX(-1)">
                                {{--<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg"
                                     style="margin-right: 10px; transform: scaleX(-1)">
                                    <path fill="none"
                                          d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                                    <path fill="none"
                                          d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                                    <path fill="none"
                                          d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
                                </svg>--}}
                            </a>
                        </div>

                    </div>

                </form>
            </div>

        @elseif(is_null($rfqCount))

            @if ($eCart->count())
                @foreach ($eCart as $rfp)
                    @php
                        $record = \App\Models\Category::where('id',$rfp->item_code)->first();
                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                    @endphp
                @endforeach
            @endif
            <br>
            <div class="flex flex-col bg-white rounded">
                <div class="p-4"
                     style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
                    <div class="d-block text-center">
                        <span class="text-2xl font-bold color-7f7f7f">{{__('portal.New RFQ')}}</span>

                    </div>
                    <hr>
                    <div style=" min-height: 145px;" class="container-fluid px-4 flex bg-grey flex-wrap">
                        <div class="flex-1 py-5">
                            <div class="my-5 pl-5">
                                {{-- <img src="{{ Storage::url(Auth::user()->business->business_photo_url) }}" alt="logo"
                                style="height: 80px;width: 200px;" /> --}}
                                <img
                                    src="{{(isset(auth()->user()->business->business_photo_url)?Storage::url(auth()->user()->business->business_photo_url):'#')}}"
                                    alt="logo" style="height: 80px;width: 200px;"/>
                            </div>
                            @php
                                $user_business_details=auth()->user()->business;
                            @endphp
                            <div class="my-5 pl-5 ">
                                <h1 class="font-extrabold color-1f3864 text-xl ">{{$user_business_details->business_name}}</h1>
                                {{-- <span>Location :
                                <span class="font-bold">{{$user_business_details->city}}</span></span> <br>
                                <span>Emdad Id : <span class="font-bold">{{Auth::user()->business_id}}</span></span> --}}
                            </div>
                        </div>

                        <div class="flex-1 ">
                            <div class="ml-auto date" style="width:150px; float: left">
                                <br>
                                <span
                                    class="color-1f3864 font-bold">{{__('portal.Date')}}: {{\Carbon\Carbon::today()->format('Y-m-d')}}</span><br>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('RFQCart.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class=" mb-3">
                        <div>
                            <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="md:flex">

                                <div class="left-info_holder md:flex-1  mr-2">
                                    <div class="my-5 pl-5 " style="padding-left: 20px">
                                        <span
                                            class="font-bold color-1f3864 text-lg">{{__('portal.Requisition Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5" style="padding-left: 20px">

                                        {{__('portal.Display Company Name')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="company_name_check" id="company_name_check">
                                                <option value="">{{__('portal.Select')}}</option>
                                                <option
                                                    @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 0 ? 'selected' : ''}}
                                                    @endif value="0">{{__('portal.No')}}
                                                </option>
                                                <option
                                                    @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 1  ? 'selected' : ''}}
                                                    @endif value="1">{{__('portal.Yes')}}
                                                </option>
                                            </select>
                                        </div>


                                        <br>
                                        {{__('portal.Payment Mode')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="payment_mode" id="payment_mode" required>
                                                <option value="">{{__('portal.None')}}</option>

                                                <option value="Cash" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Cash' ? 'selected' : ''}} @endif>{{__('portal.Cash')}}
                                                </option>

                                                @php
                                                    $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();

                                                @endphp

                                                {{--@if(auth()->user()->business_package->package_id != 1)--}}
                                                @if($package->package_id != 1)
                                                    {{--<option value="Credit" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit')}}
                                                    </option>--}}
                                                    <option value="Credit30days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit30days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (30 Days)')}}
                                                    </option>
                                                    <option value="Credit60days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit60days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (60 Days)')}}
                                                    </option>
                                                    <option value="Credit90days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit90days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (90 Days)')}}
                                                    </option>
                                                    <option value="Credit120days" @if (isset($latest_rfq))
                                                        {{$latest_rfq->payment_mode =='Credit120days' ? 'selected' : ''}} @endif>
                                                        {{__('portal.Credit (120 Days)')}}
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Required Sample')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="required_sample" id="required_sample">
                                                <option value="">{{__('portal.None')}}</option>
                                                <option value="Yes" @if (isset($latest_rfq))
                                                    {{$latest_rfq->required_sample =='Yes' ? 'selected' : ''}} @endif>
                                                    {{__('portal.Yes')}}
                                                </option>
                                                <option value="No" @if (isset($latest_rfq))
                                                    {{$latest_rfq->required_sample =='No' ? 'selected' : ''}} @endif>
                                                    {{__('portal.No')}}
                                                </option>

                                            </select>
                                        </div>
                                        <br>


                                    </div>
                                </div>
                                <div class="Right-info_holder md:flex-1">
                                    <div class="my-5 pl-5 ">
                                        <span
                                            class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        {{__('portal.Warehouse Location')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="warehouse_id" id="warehouse_id">
                                                <option value="">{{__('portal.Select Warehouse Location')}}</option>
                                                @foreach(\App\Models\BusinessWarehouse::where('business_id', auth()->user()->business_id)->get() as $warehouse)
                                                    <option value="{{$warehouse->id}}" @if (isset($latest_rfq))
                                                        {{$latest_rfq->warehouse_id ==$warehouse->id ? 'selected' : ''}} @endif>
                                                        {{$warehouse->address }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="delivery_period" id="delivery_period" required>
                                                <option value="">{{__('portal.Select Delivery Period')}}</option>
                                                <option value="Immediately" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Immediately' ? 'selected' : ''}} @endif>
                                                    {{__('portal.Immediately')}}
                                                </option>
                                                <option value="Within 30 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 30 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.30 Days')}}
                                                </option>
                                                <option value="Within 60 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 60 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.60 Days')}}
                                                </option>
                                                <option value="Within 90 Days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Within 90 Days' ? 'selected' : ''}}
                                                    @endif>{{__('portal.90 Days')}}
                                                </option>
                                                <option value="Standing Order - 2 per year" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 2 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 2 times / year')}}
                                                </option>
                                                <option value="Standing Order - 3 per year" @if (isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 3 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 3 times / year')}}
                                                </option>
                                                <option value="Standing Order - 4 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 4 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 4 times / year')}}
                                                </option>
                                                <option value="Standing Order - 6 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 6 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 6 times / year')}}
                                                </option>
                                                <option value="Standing Order - 12 per year" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order - 12 per year' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - 12 times / year')}}
                                                </option>
                                                <option value="Standing Order Open" @if(isset($latest_rfq))
                                                    {{$latest_rfq->delivery_period =='Standing Order Open' ? 'selected' : ''}}
                                                    @endif>{{__('portal.Standing Order - Open')}}
                                                </option>

                                            </select>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p4 mb-5 overflow-x-auto">

                        <table class="table-fixed text-center min-w-full ">
                            <thead style="background-color:#8EAADB" class="text-white">
                            <tr>

                                <th style="width:15%;">{{__('portal.Category')}} @include('misc.required')</th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:8%"
                                    title="{{__('portal.Unit of Measurement')}}">{{__('portal.UOM')}} @include('misc.required') </th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required') </th>
                                <th style="width:10%;">{{__('portal.Size')}}</th>
                                <th style="width:10%;">{{__('portal.Brand')}}</th>
                                <th style="width:7%;" title="{{__('portal.UP')}}">{{__('portal.Last Unit Price')}}</th>
                                <th style="width:15%;">{{__('portal.Shipment Remarks')}}</th>
                                <th style="width:7%;">{{__('portal.Attachments')}}</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach($eCart as $item)
                                <tr>
                                    <td>
                                        @php
                                            $record = \App\Models\Category::where('id',$item->item_code)->first();
                                            $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                        @endphp

                                        {{ $record->name_ar}} @if(isset($parent)), {{ $parent->name_ar}} @endif

                                    </td>
                                    <td>
                                        {{strip_tags($item->description)}}
                                    </td>
                                    <td> @php $UOM = \App\Models\UnitMeasurement::firstWhere('uom_en', $item->unit_of_measurement); @endphp {{$UOM->uom_ar}}</td>
                                    <td>
                                        {{$item->quantity}}
                                    </td>
                                    <td>
                                        {{$item->size}}
                                    </td>
                                    <td>
                                        {{$item->brand}}
                                    </td>

                                    <td> {{ number_format($rfp->last_price, 2) }} {{__('portal.SAR')}}</td>
                                    <td>
                                        {{$item->remarks}}
                                    </td>
                                    <td class="">
                                        @if ($item->file_path)
                                            <a href="{{ Storage::url($rfp->file_path) }}">
                                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg>
                                            </a>
                                        @else
                                            {{__('portal.N/A')}}
                                        @endif
                                    </td>

                                </tr>
                            @endforeach

                            <tr>

                                <td>
                                    <div class="w-full overflow-hidden">
                                        <!-- Column Content -->
                                        @include('category.rfp')
                                    </div>
                                </td>
                                <td>
                                <textarea name="description" id="description"
                                          class="w-full description rounded-md shadow-sm" maxlength="254"
                                          placeholder="{{__('portal.Enter Description..')}}" required></textarea>
                                    <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                                </td>
                                <td>
                                    <div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-1.5 mt-4 pointer-events-none"
                                             style="width: 8px; height: 8px;"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </svg>
                                        <select
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom"
                                            required name="unit_of_measurement" id="unit_of_measurement"
                                            style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option value="{{$item->uom_en}}">{{$item->uom_ar}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" min="0" autocomplete="quantity" required
                                           placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text"
                                           name="size"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td><input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" min="0" autocomplete="brand"
                                           placeholder="{{__('portal.Brand')}}"></td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" min="0" autocomplete="last_price"
                                           placeholder="{{__('portal.Price')}}">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks"
                                           type="text" autocomplete="remarks" placeholder="{{__('portal.Remarks')}}">
                                </td>

                                <td>

                                    <label for="file" class="file-label"><img class="mx-auto" style="width:25px;"
                                                                              src="https://img.icons8.com/pastel-glyph/64/000000/upload-document--v1.png"/></label>
                                    <input class="shadow-sm block w-full" id="file" type="file" name="file_path_1"
                                           autocomplete="name" style="display:none;">
                                </td>
                            </tr>


                            </tbody>
                        </table>
                        <div class="text-center my-4">
                            <button type="submit"
                                    class="inline-flex items-center add-more  px-4 mr-2 py-3 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.ADD ITEM')}}
                                <svg class="svg-icon w-5 h-4" stroke="currentColor" viewBox="0 0 20 20"
                                     style="margin-right: 5px;">
                                    <path
                                        d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                                </svg>
                            </button>


                            <a href="{{route('RFQCart.index')}}"
                               class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}
                                <img src="{{asset('cart.png')}}"
                                     style="margin-right: 10px;margin-bottom: 2px;transform: scaleX(-1)">
                                {{--<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg"
                                     style="margin-right: 10px;transform: scaleX(-1)">
                                    <path fill="none"
                                          d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                                    <path fill="none"
                                          d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                                    <path fill="none"
                                          d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
                                </svg>--}}
                            </a>
                        </div>

                    </div>

                </form>


                @if($eCart->isNotEmpty())

                    <div class="p-4">
                        <form action="{{ route('EOrders.store') }}" method="POST">
                            @csrf
                            @foreach ($eCart as $rfp)
                                <input type="hidden" name="item_number[]" value="{{ $rfp->id }}">
                            @endforeach

                            <input type="hidden" value="{{ auth()->user()->business->id }}" name="business_id">
                            <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                            <button type="submit"
                                    class="inline-flex float-right items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150 confirm"
                                    data-confirm='{{__('portal.Select Ok to place requisition')}}'>
                                {{__('portal.Place RFQ')}}
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @else
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                            <div class="text-black text-2xl" style="text-align: center">
                                {{__('portal.Your have reached daily requisition generate limit.')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </x-app-layout>

    <script>
        $('.company_name_check').change(function () {
            // alert($(this).attr('data-id'));
            // alert($(this).val());
            let status = $(this).val();
            let rfqId = $(this).attr('data-id');
            // alert(rfqId);


            $.ajax({
                type: 'POST',
                url: "{{ route('companyCheck') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'rfqNo': rfqId,
                    'status': status
                },
                success: function (response) {
                    if (response.status === 0) {
                        alert('لم يتم التحديث، حاول مجدداً.');
                    } else if (response.status === 1) {
                        alert('تم تحديث الحالة بنجاح!');
                        // $('#status').show().delay(5000).fadeOut();
                    }
                }
            });
        });
    </script>
@endif

<script>

    $('.confirm').on('click', function (e) {
        return confirm($(this).data('confirm'));
    });

    // $(document).ready(function () {
    //     $("body").delegate("#add_more", "click", function () {
    //         $('.myrow').append("<tr>" +  + "</tr>");
    //         // alert('called');
    //         // $("form .select2").select2();
    //     });
    //     $("body").delegate(".cross a", "click", function () {
    //         $(this).closest(".row").remove();
    //         return false;
    //     });
    // });

</script>
