@section('headerScripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{ url('select2/src/select2totree.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ url('select2/src/select2totree.js') }}"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
        @if(isset($rfqCount) && $rfqCount != 0 && !is_null($rfqCount))

            @foreach ($errors->get('delivery_period') as $error)
                <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">{{ $error }}</strong>
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
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
                                     {{\Carbon\Carbon::today()->format('Y-m-d')}}
                                </span><br>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('single_cart_store_rfq') }}" enctype="multipart/form-data">
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->company_name_check}}">
                                                        @if($latest_rfq->company_name_check == 0){{__('portal.No')}}
                                                        @elseif($latest_rfq->company_name_check == 1){{__('portal.Yes')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.Select')}}</option>
                                                    <option {{old('company_name_check') == 0 ? 'selected' : '' }}  value="0">{{__('portal.No')}}</option>
                                                    <option {{old('company_name_check') == 1 ? 'selected' : '' }} value="1">{{__('portal.Yes')}}</option>
                                                @endif
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->payment_mode}}">
                                                        @if($latest_rfq->payment_mode == 'Cash') {{__('portal.Cash')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit') {{__('portal.Credit')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option {{old('payment_mode') == 'Cash' ? 'selected' : '' }}  value="Cash">{{__('portal.Cash')}}</option>

                                                    @php
                                                        $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
                                                    @endphp

                                                    @if($package->package_id != 1)
                                                        {{--                                                        <option value="Credit">{{__('portal.Credit')}}</option>--}}
                                                        <option {{old('payment_mode') == 'Credit30days' ? 'selected' : '' }}  value="Credit30days">{{__('portal.Credit (30 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit60days' ? 'selected' : '' }}  value="Credit60days">{{__('portal.Credit (60 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit90days' ? 'selected' : '' }}  value="Credit90days">{{__('portal.Credit (90 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit120days' ? 'selected' : '' }}  value="Credit120days">{{__('portal.Credit (120 Days)')}}</option>
                                                    @endif
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->required_sample}}">
                                                        @if($latest_rfq->required_sample == 'Yes') {{__('portal.Yes')}}
                                                        @elseif($latest_rfq->required_sample == 'No') {{__('portal.No')}}
                                                        @else {{$latest_rfq->required_sample}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option {{old('required_sample') == 'Yes' ? 'selected' : '' }} value="Yes">{{__('portal.Yes')}}</option>
                                                    <option {{old('required_sample') == 'No' ? 'selected' : '' }} value="No">{{__('portal.No')}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>

                                        {{__('portal.Category')}}: @include('misc.required')
                                        <div class="relative inline-flex" style="width: 45%;">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            @if (isset($latest_rfq))
                                                @php
                                                    $record = \App\Models\Category::where('id',$latest_rfq->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp

                                                <select name="item_name"
                                                        class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                        readonly>
                                                    <option value="{{$latest_rfq->item_code}}">{{$latest_rfq->item_name . ' - ' . $parent->name }}</option>
                                                </select>
                                            @else
                                                @include('category.rfp')
                                            @endif
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
                                                @if(isset($latest_rfq))
                                                    @php $warehouse = \App\Models\BusinessWarehouse::where('id',$latest_rfq->warehouse_id)->first(); @endphp
                                                    <option value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                @else
                                                    <option value="">{{__('portal.Select Warehouse Location')}}</option>
                                                    @foreach(\App\Models\BusinessWarehouse::where('business_id',auth()->user()->business_id)->get() as $warehouse)
                                                        <option {{old('warehouse_id') == $warehouse->id ? 'selected' : '' }} value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            {{--<svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>--}}
                                            @if(isset($latest_rfq))
                                                <input type="text" class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" name="delivery_period" value="{{$latest_rfq->delivery_period}}" readonly>
                                            @else
                                                <input type="text" id="datepicker" class="form-input rounded-md shadow-sm block w-full" name="delivery_period" value="{{old('delivery_period')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
                                            @endif
                                            {{--<select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="delivery_period" id="delivery_period" required>
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->delivery_period}}">
                                                        @if($latest_rfq->delivery_period == 'Immediately') {{__('portal.Immediately')}}
                                                        @elseif($latest_rfq->delivery_period == 'Within 30 Days') {{__('portal.30 Days')}}
                                                        @elseif($latest_rfq->delivery_period == 'Within 60 Days') {{__('portal.60 Days')}}
                                                        @elseif($latest_rfq->delivery_period == 'Within 90 Days') {{__('portal.90 Days')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 2 per year') {{__('portal.Standing Order - 2 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 3 per year') {{__('portal.Standing Order - 3 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 4 per year') {{__('portal.Standing Order - 4 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 6 per year') {{__('portal.Standing Order - 6 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 12 per year') {{__('portal.Standing Order - 12 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order Open') {{__('portal.Standing Order - Open')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.Select Delivery Period')}}</option>
                                                    <option value="Immediately">{{__('portal.Immediately')}}</option>
                                                    <option value="Within 30 Days">{{__('portal.30 Days')}}</option>
                                                    <option value="Within 60 Days">{{__('portal.60 Days')}}</option>
                                                    <option value="Within 90 Days">{{__('portal.90 Days')}}</option>
                                                    --}}{{--<option
                                                        value="Standing Order - 2 per year">{{__('portal.Standing Order - 2 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 3 per year">{{__('portal.Standing Order - 3 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 4 per year">{{__('portal.Standing Order - 4 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 6 per year">{{__('portal.Standing Order - 6 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 12 per year">{{__('portal.Standing Order - 12 times / year')}}</option>
                                                    <option
                                                        value="Standing Order Open">{{__('portal.Standing Order - Open')}}</option>--}}{{--
                                                @endif

                                            </select>--}}
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

                                <th style="width:3%;">#</th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:7%"
                                    title="{{__('portal.Unit of Measurement')}}">{{__('portal.UOM')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Size')}}</th>
                                <th style="width:10%;">{{__('portal.Brand')}}</th>
                                <th style="width:7%;" title="{{__('portal.UP')}}">{{__('portal.Last Unit Price')}}</th>
                                <th style="width:15%;">{{__('portal.Remarks')}}</th>
                                <th style="width:7%;">{{__('portal.Attachments')}}</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach($eCart as $item)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
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

                                    <td>
                                        {{ number_format($item->last_price, 2) }} {{__('portal.SAR')}}
                                    </td>
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

                                    </div>
                                </td>
                                <td>
                                <textarea name="description" id="description"
                                          class="w-full description rounded-md shadow-sm" maxlength="254"
                                          placeholder="{{__('portal.Enter Description..')}}" required>{{old('description')}}</textarea>
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
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom js-example-basic-single"
                                            required name="unit_of_measurement" id="unit_of_measurement"
                                            style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option {{old('unit_of_measurement') == $item->uom_en ? 'selected' : '' }} value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" value="{{old('quantity')}}" min="1" autocomplete="quantity" required
                                           placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text"
                                           name="size" value="{{old('size')}}"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td><input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" value="{{old('brand')}}" min="0" autocomplete="brand"
                                           placeholder="{{__('portal.Brand')}}"></td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" value="{{old('last_price')}}" min="0" autocomplete="last_price"
                                           placeholder="{{__('portal.Price')}}">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks" value="{{old('remarks')}}"
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
                            <button type="submit" style="height: 42px;"
                                    class="inline-flex items-center add-more  px-4 mr-2 py-3 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.ADD ITEM')}}
                                <svg class="svg-icon w-5 h-4" stroke="currentColor" viewBox="0 0 20 20"
                                     style="margin-left: 5px;">
                                    <path
                                        d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                                </svg>
                            </button>

                            <a href="{{route('single_cart_index')}}"
                               class="inline-flex items-center add-more mt-2 px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}
                                <img src="{{url('singleCategroyCart.png')}}"
                                     style="height: 24px;width: 30px; margin-left: 10px;">
                                {{--<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="margin-left: 10px;">
                                    <path fill="none" d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                                    <path fill="none" d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                                    <path fill="none" d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
                                </svg>--}}
                            </a>
                        </div>

                    </div>

                </form>

                @if($eCart->isNotEmpty())
                <div class="p-4 float-right">
                    <form action="{{ route('single_category_store') }}" method="POST">
                        @csrf
                        @foreach ($eCart as $rfp)
                            <input type="hidden" name="item_number[]" value="{{ $rfp->id }}">
                        @endforeach

                        <input type="hidden" value="{{ auth()->user()->business->id }}" name="business_id">
                        <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                        <button type="submit"
                                class="float-right inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150 confirm"
                                data-confirm='{{__('portal.Select Ok to place requisition')}}'>
                            {{__('portal.Place RFQ')}}
                        </button>
                    </form>


                </div>
                @endif
            </div>

        @elseif(is_null($rfqCount) )
            @if ($eCart->count())
                @php $total = 0; @endphp
                @foreach ($eCart as $rfp)

                    @php
                        $record = \App\Models\Category::where('id',$rfp->item_code)->first();
                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                    @endphp

                @endforeach
            @endif
            @foreach ($errors->get('delivery_period') as $error)
                <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">{{ $error }}</strong>
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
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
                            <div class="ml-auto date" style="width:150px; ">
                                <br>
                                <span class="color-1f3864 font-bold">{{__('portal.Date')}}:
                            {{\Carbon\Carbon::today()->format('Y-m-d')}}</span><br>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('single_cart_store_rfq') }}" enctype="multipart/form-data">
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->company_name_check}}">
                                                        @if($latest_rfq->company_name_check == 0){{__('portal.No')}}
                                                        @elseif($latest_rfq->company_name_check == 1){{__('portal.Yes')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.Select')}}</option>
                                                    <option {{old('company_name_check') == 0 ? 'selected' : '' }} value="0">{{__('portal.No')}}</option>
                                                    <option {{old('company_name_check') == 1 ? 'selected' : '' }} value="1">{{__('portal.Yes')}}</option>
                                                @endif
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->payment_mode}}">
                                                        @if($latest_rfq->payment_mode == 'Cash') {{__('portal.Cash')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit') {{__('portal.Credit')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option {{old('payment_mode') == 'Cash' ? 'selected' : ''}} value="Cash">{{__('portal.Cash')}}</option>

                                                    @php
                                                        $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
                                                    @endphp

                                                    @if($package->package_id != 1)
                                                        {{--                                                        <option value="Credit">{{__('portal.Credit')}}</option>--}}
                                                        <option {{old('payment_mode') == 'Credit30days' ? 'selected' : ''}} value="Credit30days">{{__('portal.Credit (30 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit60days' ? 'selected' : ''}} value="Credit60days">{{__('portal.Credit (60 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit90days' ? 'selected' : ''}} value="Credit90days">{{__('portal.Credit (90 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit120days' ? 'selected' : ''}} value="Credit120days">{{__('portal.Credit (120 Days)')}}</option>
                                                    @endif
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->required_sample}}">
                                                        @if($latest_rfq->required_sample == 'Yes') {{__('portal.Yes')}}
                                                        @elseif($latest_rfq->required_sample == 'No') {{__('portal.No')}}
                                                        @else {{$latest_rfq->required_sample}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option {{old('required_sample') == 'Yes' ? 'selected' : ''}} value="Yes">{{__('portal.Yes')}}</option>
                                                    <option {{old('required_sample') == 'No' ? 'selected' : ''}} value="No">{{__('portal.No')}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>

                                        {{__('portal.Category')}}: @include('misc.required')
                                        <div class="relative inline-flex" style="width: 45%;">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            @if (isset($latest_rfq))
                                                @php
                                                    $record = \App\Models\Category::where('id',$latest_rfq->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp

                                                <select name="item_name"
                                                        class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                        readonly>
                                                    <option
                                                        value="{{$latest_rfq->item_code}}">{{$latest_rfq->item_name . ' - ' . $parent->name }}</option>
                                                </select>
                                            @else
                                                @include('category.rfp')
                                            @endif
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
                                                @if(isset($latest_rfq))
                                                    @php $warehouse = \App\Models\BusinessWarehouse::where('id',$latest_rfq->warehouse_id)->first(); @endphp
                                                    <option value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                @else
                                                    <option value="">{{__('portal.Select Warehouse Location')}}</option>
                                                    @foreach(\App\Models\BusinessWarehouse::where('business_id',auth()->user()->business_id)->get() as $warehouse)
                                                        <option {{old('warehouse_id') == $warehouse->id ? 'selected' : ''}} value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            {{--<svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>--}}
                                            @if(isset($latest_rfq))
                                                <input type="text" class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" name="delivery_period" value="{{$latest_rfq->delivery_period}}" readonly>
                                            @else
                                                <input type="text" id="datepicker" class="form-input rounded-md shadow-sm block w-full" name="delivery_period" value="{{old('delivery_period')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
                                            @endif
                                            {{--<select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="delivery_period" id="delivery_period" required>
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->delivery_period}}">
                                                        @if($latest_rfq->delivery_period == 'Immediately') {{__('portal.Immediately')}}
                                                        @elseif($latest_rfq->delivery_period == 'Within 30 Days') {{__('portal.30 Days')}}
                                                        @elseif($latest_rfq->delivery_period == 'Within 60 Days') {{__('portal.60 Days')}}
                                                        @elseif($latest_rfq->delivery_period == 'Within 90 Days') {{__('portal.90 Days')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 2 per year') {{__('portal.Standing Order - 2 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 3 per year') {{__('portal.Standing Order - 3 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 4 per year') {{__('portal.Standing Order - 4 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 6 per year') {{__('portal.Standing Order - 6 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 12 per year') {{__('portal.Standing Order - 12 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order Open') {{__('portal.Standing Order - Open')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.Select Delivery Period')}}</option>
                                                    <option value="Immediately">{{__('portal.Immediately')}}</option>
                                                    <option value="Within 30 Days">{{__('portal.30 Days')}}</option>
                                                    <option value="Within 60 Days">{{__('portal.60 Days')}}</option>
                                                    <option value="Within 90 Days">{{__('portal.90 Days')}}</option>
                                                    --}}{{--<option
                                                        value="Standing Order - 2 per year">{{__('portal.Standing Order - 2 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 3 per year">{{__('portal.Standing Order - 3 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 4 per year">{{__('portal.Standing Order - 4 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 6 per year">{{__('portal.Standing Order - 6 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 12 per year">{{__('portal.Standing Order - 12 times / year')}}</option>
                                                    <option
                                                        value="Standing Order Open">{{__('portal.Standing Order - Open')}}</option>--}}{{--
                                                @endif

                                            </select>--}}
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

                                <th style="width:3%;">#</th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:7%"
                                    title="{{__('portal.Unit of Measurement')}}">{{__('portal.UOM')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Size')}}</th>
                                <th style="width:10%;">{{__('portal.Brand')}}</th>
                                <th style="width:7%;" title="{{__('portal.UP')}}">{{__('portal.Last Unit Price')}}</th>
                                <th style="width:15%;"> {{__('portal.Remarks')}}</th>
                                <th style="width:7%;">{{__('portal.Attachments')}}</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach($eCart as $item)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}

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

                                    <td>
                                        {{ number_format($item->last_price, 2) }} {{__('portal.SAR')}}
                                    </td>
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

                                    </div>
                                </td>
                                <td>
                                <textarea name="description" id="description"
                                          class="w-full description rounded-md shadow-sm" maxlength="254"
                                          placeholder="{{__('portal.Enter Description..')}}" required>{{old('description')}}</textarea>
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
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom js-example-basic-single"
                                            required name="unit_of_measurement" id="unit_of_measurement"
                                            style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option {{old('unit_of_measurement') == $item->uom_en ? 'selected' : ''}} value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" value="{{old('quantity')}}" min="1" autocomplete="quantity" required
                                           placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text"
                                           name="size" value="{{old('size')}}"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" value="{{old('brand')}}" min="0" autocomplete="brand"
                                           placeholder="{{__('portal.Brand')}}">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" value="{{old('last_price')}}" min="0" autocomplete="last_price"
                                           placeholder="{{__('portal.Price')}}">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks" value="{{old('remarks')}}"
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
                            <button type="submit" style="height: 42px;"
                                    class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.ADD ITEM')}}
                                <svg class="svg-icon w-5 h-4" stroke="currentColor" viewBox="0 0 20 20"
                                     style="margin-left: 5px;">
                                    <path
                                        d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                                </svg>
                            </button>


                            <a href="{{route('single_cart_index')}}"
                               class="inline-flex items-center add-more mt-2 px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}
                                <img src="{{url('singleCategroyCart.png')}}"
                                     style="height: 24px;width: 30px;margin-left: 10px;">
                            </a>
                        </div>

                    </div>

                </form>

                @if($eCart->isNotEmpty())
                <div class="p-4">
                    <form action="{{ route('single_category_store') }}" method="POST">
                        @csrf
                        @foreach ($eCart as $rfp)
                            <input type="hidden" name="item_number[]" value="{{ $rfp->id }}">
                        @endforeach

                        <input type="hidden" value="{{ auth()->user()->business->id }}" name="business_id">
                        <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                        <button type="submit"
                                class="inline-flex items-center float-right justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150 confirm"
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
        @if(isset($rfqCount) && $rfqCount != 0 && !is_null($rfqCount))
            @if ($eCart->count())
                @php $total = 0; @endphp
                @foreach ($eCart as $rfp)
                    @php
                        $record = \App\Models\Category::where('id',$rfp->item_code)->first();
                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                    @endphp
                @endforeach
            @endif

            <br>
            @foreach ($errors->get('delivery_period') as $error)
                <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-3">{{ $error }}</strong>
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
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
                                <h1 class="font-medium color-1f3864 text-xl" style="font-family: sans-serif;">{{$user_business_details->business_name}}</h1>
                            </div>
                        </div>

                        <div class="flex-1 ">
                            <div class="ml-auto date" style="width:150px; float: left">
                                <br>
                                <span class="color-1f3864 font-bold">{{__('portal.Date')}}:
                                     <span style="font-family: sans-serif;">{{\Carbon\Carbon::today()->format('Y-m-d')}}</span>
                                </span><br>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('single_cart_store_rfq') }}" enctype="multipart/form-data">
                    @csrf
                    <div class=" mb-3">
                        <div>
                            <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="flex">

                                <div class="left-info_holder flex-1 mr-2">
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->company_name_check}}">
                                                        @if($latest_rfq->company_name_check == 0){{__('portal.No')}}
                                                        @elseif($latest_rfq->company_name_check == 1){{__('portal.Yes')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.Select')}}</option>
                                                    <option {{old('company_name_check') == 0 ? 'selected' : ''}} value="0">{{__('portal.No')}}</option>
                                                    <option {{old('company_name_check') == 1 ? 'selected' : ''}} value="1">{{__('portal.Yes')}}</option>
                                                @endif
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->payment_mode}}">
                                                        @if($latest_rfq->payment_mode == 'Cash') {{__('portal.Cash')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit') {{__('portal.Credit')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                                        @endif
                                                        {{--                                                        {{$latest_rfq->payment_mode}}--}}
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option {{old('payment_mode') == 'Cash' ? 'selected' : ''}} value="Cash">{{__('portal.Cash')}}</option>

                                                    @php
                                                        $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
                                                    @endphp

                                                    @if($package->package_id != 1)
                                                        {{--                                                        <option value="Credit">{{__('portal.Credit')}}</option>--}}
                                                        <option {{old('payment_mode') == 'Credit30days' ? 'selected' : ''}} value="Credit30days">{{__('portal.Credit (30 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit60days' ? 'selected' : ''}} value="Credit60days">{{__('portal.Credit (60 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit90days' ? 'selected' : ''}} value="Credit90days">{{__('portal.Credit (90 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit120days' ? 'selected' : ''}} value="Credit120days">{{__('portal.Credit (120 Days)')}}</option>
                                                    @endif
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->required_sample}}">
                                                        @if($latest_rfq->required_sample == 'Yes') {{__('portal.Yes')}}
                                                        @elseif($latest_rfq->required_sample == 'No') {{__('portal.No')}}
                                                        @else {{$latest_rfq->required_sample}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option {{old('required_sample') == 'Yes' ? 'selected' : ''}} value="Yes">{{__('portal.Yes')}}</option>
                                                    <option {{old('required_sample') == 'No' ? 'selected' : ''}} value="No">{{__('portal.No')}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>

                                        {{__('portal.Category')}}: @include('misc.required')
                                        <div class="relative inline-flex" style="width: 45%;">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            @if (isset($latest_rfq))
                                                @php
                                                    $record = \App\Models\Category::where('id',$latest_rfq->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp

                                                <select name="item_name"
                                                        class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                        readonly>
                                                    <option value="{{$latest_rfq->item_code}}">{{$record->name_ar . ' - ' . $parent->name_ar }}</option>
                                                </select>
                                            @else
                                                @include('category.rfp')
                                            @endif
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
                                            <select style="font-family: sans-serif;"
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="warehouse_id" id="warehouse_id">
                                                @if(isset($latest_rfq))
                                                    @php $warehouse = \App\Models\BusinessWarehouse::where('id',$latest_rfq->warehouse_id)->first(); @endphp
                                                    <option value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                @else
                                                    <option value="">{{__('portal.Select Warehouse Location')}}</option>
                                                    @foreach(\App\Models\BusinessWarehouse::where('business_id',auth()->user()->business_id)->get() as $warehouse)
                                                        <option {{old('warehouse_id') == $warehouse->id ? 'selected' : ''}} value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            @if(isset($latest_rfq))
                                                <input type="text" style="font-family: sans-serif;" class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" name="delivery_period" value="{{$latest_rfq->delivery_period}}" readonly>
                                            @else
                                                <input type="text" id="datepicker" class="form-input rounded-md shadow-sm block w-full" name="delivery_period" value="{{old('delivery_period')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
                                            @endif
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

                                <th style="width:3%;">#</th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:7%"
                                    title="{{__('portal.Unit of Measurement')}}">{{__('portal.UOM')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Size')}}</th>
                                <th style="width:10%;">{{__('portal.Brand')}}</th>
                                <th style="width:7%;" title="{{__('portal.UP')}}">{{__('portal.Last Unit Price')}}</th>
                                <th style="width:15%;">{{__('portal.Remarks')}}</th>
                                <th style="width:7%;">{{__('portal.Attachments')}}</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach($eCart as $item)
                                <tr>
                                    <td style="font-family: sans-serif;">
                                        {{$loop->iteration}}
                                    </td>
                                    <td style="font-family: sans-serif;">
                                        {{strip_tags($item->description)}}
                                    </td>
                                    <td>
                                        @php $UOM = \App\Models\UnitMeasurement::firstWhere('uom_en', $item->unit_of_measurement); @endphp {{$UOM->uom_ar}}
                                    </td>
                                    <td style="font-family: sans-serif;">
                                        {{$item->quantity}}
                                    </td>
                                    <td style="font-family: sans-serif;">
                                        {{$item->size}}
                                    </td>
                                    <td style="font-family: sans-serif;">
                                        {{$item->brand}}
                                    </td>

                                    <td style="font-family: sans-serif;">
                                        {{ number_format($item->last_price, 2) }} {{__('portal.SAR')}}
                                    </td>
                                    <td style="font-family: sans-serif;">
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
                                            <span style="font-family: sans-serif;">{{__('portal.N/A')}}</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach

                            <tr>

                                <td>
                                    <div class="w-full overflow-hidden">

                                    </div>
                                </td>
                                <td>
                                <textarea name="description" id="description"
                                          class="w-full description rounded-md shadow-sm" maxlength="254"
                                          placeholder="{{__('portal.Enter Description..')}}" required>{{old('description')}}</textarea>
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
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom js-example-basic-single"
                                            required name="unit_of_measurement" id="unit_of_measurement"
                                            style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option {{old('unit_of_measurement') == $item->uom_en ? 'selected' : ''}} value="{{$item->uom_en}}">{{$item->uom_ar}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" value="{{old('quantity')}}" min="1" autocomplete="quantity" required
                                           placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text"
                                           name="size" value="{{old('size')}}"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td><input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" value="{{old('brand')}}" min="0" autocomplete="brand"
                                           placeholder="{{__('portal.Brand')}}"></td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" value="{{old('last_price')}}" min="0" autocomplete="last_price"
                                           placeholder="{{__('portal.Price')}}">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks" value="{{old('remarks')}}"
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
                            <button type="submit" style="height: 42px;"
                                    class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.ADD ITEM')}}
                                <svg class="svg-icon w-5 h-4" stroke="currentColor" viewBox="0 0 20 20"
                                     style="margin-right: 5px;">
                                    <path
                                        d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                                </svg>
                            </button>

                            <a href="{{route('single_cart_index')}}"
                               class="inline-flex items-center add-more mt-2 px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}
                                <img src="{{url('singleCategroyCart.png')}}"
                                     style="height: 24px;width: 30px; margin-right: 10px;transform: scaleX(-1)">
                            </a>
                        </div>

                    </div>

                </form>

                @if($eCart->isNotEmpty())
                <div class="p-4">
                    <form action="{{ route('single_category_store') }}" method="POST">
                        @csrf
                        @foreach ($eCart as $rfp)
                            <input type="hidden" name="item_number[]" value="{{ $rfp->id }}">
                        @endforeach

                        <input type="hidden" value="{{ auth()->user()->business->id }}" name="business_id">
                        <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                        <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150 confirm"
                                data-confirm='{{__('portal.Select Ok to place requisition')}}'>
                            {{__('portal.Place RFQ')}}
                        </button>
                    </form>
                </div>
                @endif
            </div>

        @elseif(is_null($rfqCount) )

            @if ($eCart->count())
                @php $total = 0; @endphp
                @foreach ($eCart as $rfp)
                    @php
                        $record = \App\Models\Category::where('id',$rfp->item_code)->first();
                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                    @endphp
                @endforeach
            @endif
            <br>
            @foreach ($errors->get('delivery_period') as $error)
                <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-3">{{ $error }}</strong>
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
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
                                <h1 class="font-medium color-1f3864 text-xl" style="font-family: sans-serif;">{{$user_business_details->business_name}}</h1>
                            </div>
                        </div>

                        <div class="flex-1 ">
                            <div class="ml-auto date" style="width:150px; float: left">
                                <br>
                                <span class="color-1f3864 font-bold">{{__('portal.Date')}}:
                                    <span style="font-family: sans-serif;">{{\Carbon\Carbon::today()->format('Y-m-d')}}</span>
                                </span><br>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('single_cart_store_rfq') }}" enctype="multipart/form-data">
                    @csrf
                    <div class=" mb-3">
                        <div>
                            <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="md:flex">

                                <div class="left-info_holder md:flex-1 mr-2">
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->company_name_check}}">
                                                        @if($latest_rfq->company_name_check == 0){{__('portal.No')}}
                                                        @elseif($latest_rfq->company_name_check == 1){{__('portal.Yes')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.Select')}}</option>
                                                    <option {{old('company_name_check') == 0 ? 'selected' : ''}} value="0">{{__('portal.No')}}</option>
                                                    <option {{old('company_name_check') == 1 ? 'selected' : ''}} value="1">{{__('portal.Yes')}}</option>
                                                @endif
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->payment_mode}}">
                                                        @if($latest_rfq->payment_mode == 'Cash') {{__('portal.Cash')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit') {{__('portal.Credit')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit30days') {{__('portal.Credit (30 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit60days') {{__('portal.Credit (60 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit90days') {{__('portal.Credit (90 Days)')}}
                                                        @elseif($latest_rfq->payment_mode == 'Credit120days') {{__('portal.Credit (120 Days)')}}
                                                        @endif
                                                        {{--                                                        {{$latest_rfq->payment_mode}}--}}
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option {{old('payment_mode') == 'Cash' ? 'selected' : ''}} value="Cash">{{__('portal.Cash')}}</option>

                                                    @php
                                                        $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
                                                    @endphp

                                                    @if($package->package_id != 1)
                                                        {{--                                                        <option value="Credit">{{__('portal.Credit')}}</option>--}}
                                                        <option {{old('payment_mode') == 'Credit30days' ? 'selected' : ''}} value="Credit30days">{{__('portal.Credit (30 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit60days' ? 'selected' : ''}} value="Credit60days">{{__('portal.Credit (60 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit90days' ? 'selected' : ''}} value="Credit90days">{{__('portal.Credit (90 Days)')}}</option>
                                                        <option {{old('payment_mode') == 'Credit120days' ? 'selected' : ''}} value="Credit120days">{{__('portal.Credit (120 Days)')}}</option>
                                                    @endif
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
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->required_sample}}">
                                                        @if($latest_rfq->required_sample == 'Yes') {{__('portal.Yes')}}
                                                        @elseif($latest_rfq->required_sample == 'No') {{__('portal.No')}}
                                                        @else {{$latest_rfq->required_sample}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option {{old('required_sample') == 'Yes' ? 'selected' : ''}} value="Yes">{{__('portal.Yes')}}</option>
                                                    <option {{old('required_sample') == 'No' ? 'selected' : ''}} value="No">{{__('portal.No')}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>

                                        {{__('portal.Category')}}: @include('misc.required')
                                        <div class="relative inline-flex" style="width: 45%;">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            @if (isset($latest_rfq))
                                                @php
                                                    $record = \App\Models\Category::where('id',$latest_rfq->item_code)->first();
                                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                                @endphp

                                                <select name="item_name"
                                                        class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                        readonly>
                                                    <option value="{{$latest_rfq->item_code}}">{{$record->name_ar . ' - ' . $parent->name_ar }}</option>
                                                </select>
                                            @else
                                                @include('category.rfp')
                                            @endif
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
                                            <select style="font-family: sans-serif;"
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="warehouse_id" id="warehouse_id">
                                                @if(isset($latest_rfq))
                                                    @php $warehouse = \App\Models\BusinessWarehouse::where('id',$latest_rfq->warehouse_id)->first(); @endphp
                                                    <option value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                @else
                                                    <option value="">{{__('portal.Select Warehouse Location')}}</option>
                                                    @foreach(\App\Models\BusinessWarehouse::where('business_id',auth()->user()->business_id)->get() as $warehouse)
                                                        <option {{old('warehouse_id') == $warehouse->id ? 'selected' : ''}} value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            {{--<svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                                 style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>--}}
                                            @if(isset($latest_rfq))
                                                <input type="text" style="font-family: sans-serif;" class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" name="delivery_period" value="{{$latest_rfq->delivery_period}}" readonly>
                                            @else
                                                <input type="text" id="datepicker" class="form-input rounded-md shadow-sm block w-full" name="delivery_period" value="{{old('delivery_period')}}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
                                            @endif
                                            {{--<select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="delivery_period" id="delivery_period" required>
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->delivery_period}}">
                                                        @if($latest_rfq->delivery_period == 'Immediately') {{__('portal.Immediately')}}
                                                        @elseif($latest_rfq->delivery_period == 'Within 30 Days') {{__('portal.30 Days')}}
                                                        @elseif($latest_rfq->delivery_period == 'Within 60 Days') {{__('portal.60 Days')}}
                                                        @elseif($latest_rfq->delivery_period == 'Within 90 Days') {{__('portal.90 Days')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 2 per year') {{__('portal.Standing Order - 2 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 3 per year') {{__('portal.Standing Order - 3 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 4 per year') {{__('portal.Standing Order - 4 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 6 per year') {{__('portal.Standing Order - 6 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order - 12 per year') {{__('portal.Standing Order - 12 times / year')}}
                                                        @elseif($latest_rfq->delivery_period == 'Standing Order Open') {{__('portal.Standing Order - Open')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.Select Delivery Period')}}</option>
                                                    <option value="Immediately">{{__('portal.Immediately')}}</option>
                                                    <option value="Within 30 Days">{{__('portal.30 Days')}}</option>
                                                    <option value="Within 60 Days">{{__('portal.60 Days')}}</option>
                                                    <option value="Within 90 Days">{{__('portal.90 Days')}}</option>
                                                    --}}{{--<option
                                                        value="Standing Order - 2 per year">{{__('portal.Standing Order - 2 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 3 per year">{{__('portal.Standing Order - 3 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 4 per year">{{__('portal.Standing Order - 4 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 6 per year">{{__('portal.Standing Order - 6 times / year')}}</option>
                                                    <option
                                                        value="Standing Order - 12 per year">{{__('portal.Standing Order - 12 times / year')}}</option>
                                                    <option
                                                        value="Standing Order Open">{{__('portal.Standing Order - Open')}}</option>--}}{{--
                                                @endif

                                            </select>--}}
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

                                <th style="width:3%;">#</th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:7%"
                                    title="{{__('portal.Unit of Measurement')}}">{{__('portal.UOM')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Size')}}</th>
                                <th style="width:10%;">{{__('portal.Brand')}}</th>
                                <th style="width:7%;" title="{{__('portal.UP')}}">{{__('portal.Last Unit Price')}}</th>
                                <th style="width:15%;"> {{__('portal.Remarks')}}</th>
                                <th style="width:7%;">{{__('portal.Attachments')}}</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach($eCart as $item)
                                <tr>
                                    <td style="font-family: sans-serif;">
                                        {{$loop->iteration}}

                                    </td>
                                    <td style="font-family: sans-serif;">
                                        {{strip_tags($item->description)}}
                                    </td>
                                    <td>
                                        @php $UOM = \App\Models\UnitMeasurement::firstWhere('uom_en', $item->unit_of_measurement); @endphp {{$UOM->uom_ar}}
                                    </td>
                                    <td style="font-family: sans-serif;">
                                        {{$item->quantity}}
                                    </td>
                                    <td style="font-family: sans-serif;">
                                        {{$item->size}}
                                    </td>
                                    <td style="font-family: sans-serif;">
                                        {{$item->brand}}
                                    </td>

                                    <td style="font-family: sans-serif;">
                                        {{ number_format($item->last_price, 2) }} {{__('portal.SAR')}}
                                    </td>
                                    <td style="font-family: sans-serif;">
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
                                            <span style="font-family: sans-serif;">{{__('portal.N/A')}}</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach

                            <tr>

                                <td>
                                    <div class="w-full overflow-hidden">

                                    </div>
                                </td>
                                <td>
                                <textarea name="description" id="description"
                                          class="w-full description rounded-md shadow-sm" maxlength="254"
                                          placeholder="{{__('portal.Enter Description..')}}" required>{{old('description')}}</textarea>
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
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom js-example-basic-single"
                                            required name="unit_of_measurement" id="unit_of_measurement"
                                            style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option {{old('unit_of_measurement') == $item->uom_en ? 'selected' : ''}} value="{{$item->uom_en}}">{{$item->uom_ar}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" value="{{old('quantity')}}" min="1" autocomplete="quantity" required
                                           placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text"
                                           name="size" value="{{old('size')}}"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" value="{{old('brand')}}" min="0" autocomplete="brand"
                                           placeholder="{{__('portal.Brand')}}">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" value="{{old('last_price')}}" min="0" autocomplete="last_price"
                                           placeholder="{{__('portal.Price')}}">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks" value="{{old('remarks')}}"
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
                            <button type="submit" style="height: 42px;"
                                    class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.ADD ITEM')}}
                                <svg class="svg-icon w-5 h-4" stroke="currentColor" viewBox="0 0 20 20"
                                     style="margin-right: 5px;">
                                    <path
                                        d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                                </svg>
                            </button>


                            <a href="{{route('single_cart_index')}}"
                               class="inline-flex items-center add-more mt-2 px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}
                                <img src="{{url('singleCategroyCart.png')}}"
                                     style="height: 24px;width: 30px; margin-right: 10px;transform: scaleX(-1)">
                            </a>
                        </div>

                    </div>
                </form>

                @if($eCart->isNotEmpty())
                <div class="p-4">
                    <form action="{{ route('single_category_store') }}" method="POST">
                        @csrf
                        @foreach ($eCart as $rfp)
                            <input type="hidden" name="item_number[]" value="{{ $rfp->id }}">
                        @endforeach

                        <input type="hidden" value="{{ auth()->user()->business->id }}" name="business_id">
                        <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                        <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150 confirm"
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
@endif


<script>

    $('.confirm').on('click', function (e) {
        return confirm($(this).data('confirm'));
    });

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            maxDate: +90,
            clear: true,
        }).attr('readonly', 'readonly');
    } );

</script>
