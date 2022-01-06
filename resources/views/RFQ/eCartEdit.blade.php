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

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @foreach ($errors->get('delivery_period') as $error)
            <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ $error }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach
        <div class="flex flex-col bg-white rounded">
            <div class="p-4" style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
                <div class="d-block text-center">
                    <span class="text-2xl font-bold color-7f7f7f">{{__('portal.New RFQ')}}</span>
                </div>
                <hr>
                <div style=" min-height: 145px;" class="container-fluid px-4 flex bg-grey flex-wrap">
                    <div class="flex-1 py-5">
                        <div class="my-5 pl-5">
                            <img src="{{(isset(auth()->user()->business->business_photo_url)?Storage::url(auth()->user()->business->business_photo_url):'#')}}" alt="logo" style="height: 80px;width: 200px;"/>
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

            <form method="POST" action="{{route('eCartItemEdit', $eCartItem->id)}}" enctype="multipart/form-data">
                @csrf
                <div class=" mb-3">
                    <div>
                        <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="flex">

                            <div class="left-info_holder flex-1">
                                <div class="my-5 pl-5 " style="padding-left: 40px;">
                                    <span class="font-bold color-1f3864 text-lg">{{__('portal.Requisition Information')}}</span>
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
                                        <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                            required name="company_name_check" id="company_name_check">
                                            <option value="">{{__('portal.Select')}}</option>
                                            <option {{$eCartItem->company_name_check == 0 ? 'selected' : ''}} value="0">{{__('portal.No')}} </option>
                                            <option {{$eCartItem->company_name_check == 1 ? 'selected' : ''}} value="1">{{__('portal.Yes')}} </option>
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
                                        <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                            name="payment_mode" id="payment_mode" required>
                                            <option value="">{{__('portal.None')}}</option>

                                            <option value="Cash" {{$eCartItem->payment_mode == 'Cash' ? 'selected' : ''}} > {{__('portal.Cash')}} </option>

                                            @php $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first(); @endphp

                                            @if($package->package_id != 1)
                                                <option value="Credit" {{$eCartItem->payment_mode =='Credit' ? 'selected' : ''}}> {{__('portal.Credit')}} </option>
                                                {{--<option value="Credit30days" {{$eCartItem->payment_mode == 'Credit30days' ? 'selected' : ''}} > {{__('portal.Credit (30 Days)')}} </option>
                                                <option value="Credit60days" {{$eCartItem->payment_mode == 'Credit60days' ? 'selected' : ''}} > {{__('portal.Credit (60 Days)')}} </option>
                                                <option value="Credit90days" {{$eCartItem->payment_mode == 'Credit90days' ? 'selected' : ''}} > {{__('portal.Credit (90 Days)')}} </option>
                                                <option value="Credit120days" {{$eCartItem->payment_mode =='Credit120days' ? 'selected' : ''}} > {{__('portal.Credit (120 Days)')}} </option>--}}
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
                                        <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                            required name="required_sample" id="required_sample">
                                            <option value="">{{__('portal.None')}}</option>
                                            <option value="Yes" {{$eCartItem->required_sample == 'Yes' ? 'selected' : ''}}> {{__('portal.Yes')}} </option>
                                            <option value="No" {{$eCartItem->required_sample == 'No' ? 'selected' : ''}}> {{__('portal.No')}} </option>
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
                                    {{__('portal.Warehouse Name')}}: @include('misc.required')
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
                                            <option value="">{{__('portal.Select')}}</option>
                                            @foreach(\App\Models\BusinessWarehouse::where('business_id', auth()->user()->business_id)->get() as $warehouse)
                                                <option value="{{$warehouse->id}}" {{$eCartItem->warehouse_id == $warehouse->id ? 'selected' : ''}}> {{$warehouse->warehouse_name }} </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <br>
                                    {{__('portal.Delivery date')}}: @include('misc.required')
                                    <div class="relative inline-flex">
                                        <input type="text" id="datepicker1" class="form-input rounded-md shadow-sm block w-full" name="delivery_period" value="{{ $eCartItem->delivery_period }}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
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
                            <th style="width:10%;">{{__('portal.Brand')}}</th>
                            <th style="width:7%" title="{{__('portal.Unit of Measurement')}}">{{__('portal.UOM')}} @include('misc.required') </th>
                            <th style="width:10%;">{{__('portal.Size')}}</th>
                            <th style="width:7%;" title="{{__('portal.UP')}}">{{__('portal.Last Unit Price')}}</th>
                            <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required') </th>
                            <th style="width:15%;">{{__('portal.Remarks')}}</th>
                            <th style="width:7%;">{{__('portal.Attachments')}}</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 myrow">


                        <tr>
                            <td>
                                @php
                                    $record = \App\Models\Category::where('id',$eCartItem->item_code)->first();
                                    $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp

                                {{ $record->name}} @if(isset($parent)), {{ $parent->name}} @endif
                                @include('category.rfp')
                            </td>
                            <td>
                                <textarea name="description" id="description" class="w-full description rounded-md shadow-sm"
                                          maxlength="254" placeholder="{{__('portal.Enter Description..')}}" required>{{strip_tags($eCartItem->description)}}</textarea>
                                <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                                <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                            </td>
                            <td>
                                <input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                       name="brand" min="0" autocomplete="brand" value="{{$eCartItem->brand}}"
                                       placeholder="{{__('portal.Brand')}}">
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
                                    <select class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom js-example-basic-single"
                                        required name="unit_of_measurement" id="unit_of_measurement" style="max-height:35px;">
                                        <option value="">{{__('portal.None')}}</option>
                                        @foreach (\App\Models\UnitMeasurement::all() as $item)
                                            <option {{($eCartItem->unit_of_measurement == $item->uom_en ? 'selected' :  '' )}} value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text"
                                       name="size" value="{{$eCartItem->size}}"
                                       min="0" placeholder="{{__('portal.Size')}}">
                            </td>
                            <td>
                                <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                       name="last_price" min="0" autocomplete="last_price" value="{{ number_format($eCartItem->last_price, 2) }}"
                                       placeholder="{{__('portal.Price')}}">
                            </td>
                            <td>
                                <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                       name="quantity" value="{{$eCartItem->quantity}}" min="1" autocomplete="quantity" required
                                       placeholder="{{__('portal.Qty')}}">
                             </td>
                            <td>
                                <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks" value="{{$eCartItem->remarks}}"
                                       type="text" autocomplete="remarks" placeholder="{{__('portal.Remarks')}}">
                            </td>
                            <td class="mt-3 flex justify-center">
                                @if ($eCartItem->file_path)
                                    <a href="{{ Storage::url($eCartItem->file_path) }}">
                                        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                            </path>
                                        </svg>
                                    </a>
                                @endif
                                <label for="file" class="file-label"><img class="mx-auto" style="width:25px;" src="https://img.icons8.com/pastel-glyph/64/000000/upload-document--v1.png"/></label>
                                <input class="shadow-sm block w-full" id="file" type="file" name="file_path_1" autocomplete="name" style="display:none;">

                            </td>

                        </tr>

                        </tbody>
                    </table>

                    <div class="text-center my-4">
                        <button type="submit" class="inline-flex items-center add-more px-4 mr-2 py-3 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150 text-center">
                            {{__('portal.Update')}}
                        </button>
                    </div>
                </div>

            </form>

        </div>

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

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @foreach ($errors->get('delivery_period') as $error)
            <div class="block mt-2 text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-3">{{ $error }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach
        <br>
        <div class="flex flex-col bg-white rounded">
            <div class="p-4" style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
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
                            {{-- <span>Location :
                            <span class="font-bold">{{$user_business_details->city}}</span></span> <br>
                            <span>Emdad Id : <span class="font-bold">{{Auth::user()->business_id}}</span></span> --}}
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

            <form method="POST" action="{{route('eCartItemEdit', $eCartItem->id)}}" enctype="multipart/form-data">
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
                                            <option {{$eCartItem->company_name_check == 0 ? 'selected' : ''}} value="0">{{__('portal.No')}} </option>
                                            <option {{$eCartItem->company_name_check == 1 ? 'selected' : ''}} value="1">{{__('portal.Yes')}} </option>
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

                                            <option value="Cash" {{$eCartItem->payment_mode == 'Cash' ? 'selected' : ''}} > {{__('portal.Cash')}} </option>

                                            @php $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first(); @endphp

                                            @if($package->package_id != 1)
                                                <option value="Credit" {{$eCartItem->payment_mode =='Credit' ? 'selected' : ''}}> {{__('portal.Credit')}} </option>
                                                {{--<option value="Credit30days" {{$eCartItem->payment_mode == 'Credit30days' ? 'selected' : ''}} > {{__('portal.Credit (30 Days)')}} </option>
                                                <option value="Credit60days" {{$eCartItem->payment_mode == 'Credit60days' ? 'selected' : ''}} > {{__('portal.Credit (60 Days)')}} </option>
                                                <option value="Credit90days" {{$eCartItem->payment_mode == 'Credit90days' ? 'selected' : ''}} > {{__('portal.Credit (90 Days)')}} </option>
                                                <option value="Credit120days" {{$eCartItem->payment_mode =='Credit120days' ? 'selected' : ''}} > {{__('portal.Credit (120 Days)')}} </option>--}}
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
                                        <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                            required name="required_sample" id="required_sample">
                                            <option value="">{{__('portal.None')}}</option>
                                            <option value="Yes" {{$eCartItem->required_sample == 'Yes' ? 'selected' : ''}}> {{__('portal.Yes')}} </option>
                                            <option value="No" {{$eCartItem->required_sample == 'No' ? 'selected' : ''}}> {{__('portal.No')}} </option>

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
                                    {{__('portal.Warehouse Name')}}: @include('misc.required')
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
                                            <option value="">{{__('portal.Select')}}</option>
                                            @foreach(\App\Models\BusinessWarehouse::where('business_id', auth()->user()->business_id)->get() as $warehouse)
                                                <option value="{{$warehouse->id}}" {{$eCartItem->warehouse_id == $warehouse->id ? 'selected' : ''}}> {{$warehouse->warehouse_name }} </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <br>
                                    {{__('portal.Delivery date')}}: @include('misc.required')
                                    <div class="relative inline-flex">
                                        <div class="relative inline-flex">
                                            <input type="text" id="datepicker1" class="form-input rounded-md shadow-sm block w-full font-sans" name="delivery_period" value="{{ $eCartItem->delivery_period }}" placeholder="{{__('register.Choose Date')}} (mm/dd/yy)" required>
                                        </div>
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
                            <th style="width:10%;">{{__('portal.Brand')}}</th>
                            <th style="width:8%" title="{{__('portal.Unit of Measurement')}}">{{__('portal.UOM')}} @include('misc.required') </th>
                            <th style="width:10%;">{{__('portal.Size')}}</th>
                            <th style="width:7%;" title="{{__('portal.UP')}}">{{__('portal.Last Unit Price')}}</th>
                            <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required') </th>
                            <th style="width:15%;">{{__('portal.Remarks')}}</th>
                            <th style="width:7%;">{{__('portal.Attachments')}}</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            <tr>
                                <td>
                                    @php
                                        $record = \App\Models\Category::where('id',$eCartItem->item_code)->first();
                                        $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                    @endphp

                                    {{ $record->name_ar}} @if(isset($parent)), {{ $parent->name_ar}} @endif

                                    @include('category.rfp')

                                </td>
                                <td style="font-family: sans-serif;">
                                    <textarea name="description" id="description" class="w-full description rounded-md shadow-sm"
                                              maxlength="254" placeholder="{{__('portal.Enter Description..')}}" required>{{strip_tags($eCartItem->description)}}</textarea>
                                    <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                                </td>
                                <td style="font-family: sans-serif;">
                                    <input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" min="0" autocomplete="brand" value="{{$eCartItem->brand}}"
                                           placeholder="{{__('portal.Brand')}}">
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
                                        <select class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom js-example-basic-single"
                                                required name="unit_of_measurement" id="unit_of_measurement" style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option {{($eCartItem->unit_of_measurement == $item->uom_en ? 'selected' :  '' )}} value="{{$item->uom_en}}">{{$item->uom_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td style="font-family: sans-serif;">
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text"
                                           name="size" value="{{$eCartItem->size}}"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td style="font-family: sans-serif;">
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" min="0" autocomplete="last_price" value="{{ number_format($eCartItem->last_price, 2) }}"
                                           placeholder="{{__('portal.Price')}}">
                                </td>
                                <td style="font-family: sans-serif;">
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" value="{{$eCartItem->quantity}}" min="1" autocomplete="quantity" required
                                           placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td style="font-family: sans-serif;">
                                    <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks" value="{{$eCartItem->remarks}}"
                                           type="text" autocomplete="remarks" placeholder="{{__('portal.Remarks')}}">
                                </td>
                                <td class="mt-3 flex justify-center">
                                    @if ($eCartItem->file_path)
                                        <a href="{{ Storage::url($eCartItem->file_path) }}">
                                            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                </path>
                                            </svg>
                                        </a>
                                    @endif
                                    <label for="file" class="file-label"><img class="mx-auto" style="width:25px;" src="https://img.icons8.com/pastel-glyph/64/000000/upload-document--v1.png"/></label>
                                    <input class="shadow-sm block w-full" id="file" type="file" name="file_path_1" autocomplete="name" style="display:none;">
                                </td>

                            </tr>

                        </tbody>
                    </table>
                    <div class="text-center my-4">
                        <button type="submit" class="inline-flex items-center add-more  px-4 mr-2 py-3 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150 text-center">
                            {{__('portal.Update')}}
                        </button>
                    </div>

                </div>

            </form>

        </div>

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

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
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

    $( function() {
        $( "#datepicker1" ).datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            minDate: +0,
            maxDate: +90,
            clear: true,
        }).attr('readonly', 'readonly');
    } );

</script>
