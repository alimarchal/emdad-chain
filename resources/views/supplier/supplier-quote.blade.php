{{-- @if (auth()->user()->rtl == 0) --}}
<x-app-layout>
    <style type="text/css">
        /* color for request for quotation heading*/
        .color-7f7f7f {
            color: #7f7f7f;
        }

        .color-1f3864 {
            color: #1f3864;
        }



        select:hover{
            cursor: pointer;
        }

        input ,
        .note
        {
            height: 35px;
        }
        .note {
            border: 1px solid #d2d6dc !important;
            resize: none;
            margin-top: 8px;
            padding: 2px 10px;
        }

        .note:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(164, 202, 254, 0.45);
            border-color: #a4cafe;
        }


        @media screen and (max-width:360px) {
            .date {
                margin-left: auto;
                margin-right: auto;
            }
        }

    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
            <strong class="mr-1">{{ session('message') }}</strong>
            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
            </button>
        </div>
    @endif



    <div class="flex flex-col bg-white rounded">




        <div class="p-4"
            style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
            <div class="d-block text-center">
                <span class="text-2xl font-bold color-7f7f7f">RFQ</span>

            </div>
            <hr>
            <div style=" min-height: 145px;" class="container-fluid px-4 flex bg-grey flex-wrap">
                <div class="flex-1 py-5">
                    <div class="my-5 pl-5">
                        {{-- <img src="{{ Storage::url(Auth::user()->business->business_photo_url) }}" alt="logo"
                        style="height: 80px;width: 200px;" /> --}}
                        <img src="{{ url('imp_img.jpg') }}" alt="logo" style="height: 80px;width: 200px;" />
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
                        <span class="color-1f3864 font-bold">Date:
                            {{\Carbon\Carbon::today()->format('Y-m-d')}}</span><br>
                        <hr>
                    </div>
                </div>
            </div>


        </div>


            <div class=" mb-3">
                <div>
                    <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="flex ">

                        <div class="left-info_holder flex-1">
                            <div class="my-5 pl-5 ">
                                 <span class="font-bold color-1f3864 text-lg">RFQ Information</span>
                                <hr style="border-top: 1px solid gray;width: 25%;">
                            </div>
                            <div class="my-5 pl-5 ">
                                <strong>Buyer Name:</strong> {{$eOrderItems->business->business_name}}
                                <br>
                                <strong>RFQ #:</strong> {{$eOrderItems->id}}
                                <br>
                                <strong>Quote User:</strong>{{$eOrderItems->user->name}}
                                <br>
                                <strong>Item Code: </strong> {{$eOrderItems->item_code}}
                                <br>
                                <strong>Remarks: </strong>{{$eOrderItems->remarks}}
                                <br>
                                <strong>Payment Mode: </strong> {{$eOrderItems->payment_mode}}
                            </div>
                        </div>
                        <div class="center-info-holder flex-1">
                                <div class="my-5 pl-5 ">
                                 <span class="font-bold text-lg color-1f3864">Item Information</span>
                                <hr style="border-top: 1px solid gray;width: 25%;">
                            </div>
                            <div class="my-5 pl-5 ">
                                <strong>Category Name: </strong> {{ $eOrderItems->item_name }} / {{ \App\Models\Category::where('id',(\App\Models\Category::where('id',$eOrderItems->item_code)->first()->parent_id))->first()->name }}
                                <br>

                                <strong>Brand: </strong> {{ $eOrderItems->brand }}
                                <br>
                                <strong>Quantity: </strong> {{ $eOrderItems->quantity }}
                                <br>
                                <strong>Unit of Measurement: </strong> {{ $eOrderItems->unit_of_measurement }}
                                <br>
                                <strong>Size: </strong> {{ $eOrderItems->size }}
                                <br>

                                 <strong>Description:</strong> {{ strip_tags($eOrderItems->description) }}
                            </div>
                        </div>
                        <div class="Right-info_holder flex-1">
                            <div class="my-5 pl-5 ">
                                 <span class="font-bold text-lg color-1f3864">Shipping Information</span>
                                <hr style="border-top: 1px solid gray;width: 25%;">
                            </div>
                            <div class="my-5 pl-5 ">

                              <strong>Delivery Period: </strong> {{ $eOrderItems->delivery_period }}
                                <br>
                                <strong>Delivery Address: </strong> {{ $eOrderItems->warehouse->address }}
                                <br>

                                <strong>Required Sample: </strong> {{ $eOrderItems->required_sample }}
                                   <br>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p4 mb-5 overflow-x-auto">



                <table class="table-fixed  min-w-full text-center ">
                    <thead style="background-color:#8EAADB" class="text-white">



                        <tr>


                            <th style="width:10%;">Quantity @include('misc.required')</th>
                            <th style="width:10%;"> Price Per Unit @include('misc.required') </th>
                            <th style="width:10%;">Shipping Time(In Days) @include('misc.required') </th>
                            <th style="width:20%;"> Note</th>
                            <th style="width:10%;">VAT % @include('misc.required') </th>
                            <th style="width:10%;">Shipment Cost @include('misc.required')</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    {{--                    this will show the information if user has some previous quotes--}}
                    @if($collection)

                        <tr>
                            <td>
                            {{$collection->quote_quantity}}
                            </td>
                            <td>
                                {{$collection->quote_price_per_quantity}}
                            </td>
                            <td>
                                {{$collection->shipping_time_in_days}}
                            </td>
                            <td>
                                {{$collection->note_for_customer}}
                            </td>
                            <td>
                                {{$collection->VAT}}%
                            </td>
                            <td>
                                {{$collection->shipment_cost}}
                            </td>
                        </tr>
                    @endif
                    @if ($collection && $collection->qoute_status == 'Qouted')

                        <h2 class="text-center text-2xl">You have already qouted...</h2>

                    @elseif($collection && $collection->qoute_status == 'ModificationNeeded')

                        @php
                            $quote = \App\Models\QouteMessage::where('qoute_id', $collection->id )->get();
                        @endphp
                        @if(isset($quote) && $quote->isNotEmpty())

                            <div class="border-2 p-2 m-2">
                                @foreach ($quote as $msg)
                                    {{--@php $business = \App\Models\Business::where('user_id', $msg->user_id)->first(); @endphp--}}
                                    @php
                                        $user = \App\Models\User::where('id', $msg->user_id)->first();
                                        $business = \App\Models\Business::where('id', $user->business_id)->first();
                                    @endphp

                                    <span class="text-blue-700">
                                            <span class="text-gray-600 text-left">
                                                Message from {{$business->business_name}}
                                            </span>
                                            : {{strip_tags(str_replace('&nbsp;', ' ',  $msg->message))}}
                                        </span>
                                    <br> <br>
                                @endforeach
                            </div>
                            <br>
                        @endif
                        <div class="text-center">
                            <span class="text-2xl font-bold text-red-700">Modification Needed</span>
                        </div>
                        <br>
                        <form method="POST" action="{{ route('qoute.update', $collection->id) }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                            @csrf
                            @method('PUT')

                            <tr>
                                <div class="hidden_fields">
                                    <input type="hidden" name="e_order_items_id" value="{{ $eOrderItems->id }}">
                                    <input type="hidden" name="e_order_id" value="{{ $eOrderItems->e_order_id }}">
                                    <input type="hidden" name="business_id" value="{{ $eOrderItems->business_id }}">
                                    <input type="hidden" name="supplier_business_id" value="{{ $user_business_id }}">
                                    <input type="hidden" name="supplier_user_id" value="{{ auth()->user()->id }}">
                                </div>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quote_quantity" min="0" value="{{ $collection->quote_quantity }}" min="0" step="any" autocomplete="quantity" required  placeholder="Qty">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="price_per_unit" type="number"
                       name="quote_price_per_quantity" value="{{ $collection->quote_price_per_quantity }}" min="0" step="any" autocomplete="price_per_unit" required placeholder="Price Per Unit">
                                </td>
                                <td>   <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" value="{{ $collection->shipping_time_in_days }}" name="shipping_time_in_days" min="0" autocomplete="size" required placeholder="Shipment(Days)">
                                </td>

                                <td>
                                    <textarea name="note_for_customer" id="note_for_customer" class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="Enter Note (if any)"></textarea>
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm block w-full VAT" id="VAT" type="number" name="VAT" min="0" max="15" value="{{$collection->VAT}}" autocomplete="size" required placeholder="VAT%">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="ship_cost" type="number" name="shipment_cost" value="{{$collection->shipment_cost}}" min="0" step="any" autocomplete="size" required placeholder="Shipment Cost">
                                </td>


                            </tr>

                            <tr class="mt-2">
                                <td colspan="2" class="" >

                                    <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="number" name="total_cost" autocomplete="size" readonly placeholder="Total Cost">

                                </td>
                                <td colspan="2" class="text-left">
                                    <a style="cursor: pointer" id="totalCost" onclick="calculateCost()" class="ml-2 px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ">
                                        Calculate Total Cost
                                    </a>
                                </td>

                            </tr>

                            @if($collection->required_sample == 'Yes')
                            <tr>
                                <td colspan="6" >

                                        <p class="py-2 font-bold text-center  text-2xl">Sample Information</p>
                                        <div class="flex flex-wrap overflow-hidden xl:-mx-1">
                                            <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                                <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                    Samples
                                                </label>
                                                <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="sample_information" value="{{ $collection->sample_information }}" min="0" step="any" autocomplete="size" required>
                                            </div>
                                            <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                                <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                    Sample Unit
                                                </label>
                                                <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_unit" value="{{ $collection->sample_unit }}" min="0" autocomplete="size" required>
                                            </div>
                                            <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                                <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                    Quantity
                                                </label>
                                                <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_security_charges" value="{{ $collection->sample_security_charges }}" min="0" autocomplete="size" required>
                                            </div>
                                            <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                                <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                    Sample Charges Per Unit
                                                </label>
                                                <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_charges_per_unit" value="{{ $collection->sample_charges_per_unit }}" min="0" autocomplete="size" required>
                                            </div>
                                        </div>

                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="6">
                                    <div class="my-4">
                                        <button
                                            class=" px-4 float-right py-2 mt-4 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                            Update Send Quote
                                        </button>
                                    </div>
                                </td>

                            </tr>



                        </form>
                    @else

                        <form method="POST" action="{{ route('qoute.store') }}" enctype="multipart/form-data" class="rounded bg-white mt-4">
                            @csrf
                        <tr>
                            <div class="hidden_fields">
                                <input type="hidden" name="e_order_items_id" value="{{ $eOrderItems->id }}">
                                <input type="hidden" name="e_order_id" value="{{ $eOrderItems->e_order_id }}">
                                <input type="hidden" name="business_id" value="{{ $eOrderItems->business_id }}">
                                <input type="hidden" name="supplier_business_id" value="{{ $user_business_id }}">
                                <input type="hidden" name="supplier_user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="warehouse_id" value="{{ $eOrderItems->warehouse->id }}">
                            </div>
                            <td>
                                <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                       name="quote_quantity" min="0"  min="0" step="any" autocomplete="quantity" required  placeholder="Qty" >
                            </td>

                            <td>
                                <input class="form-input rounded-md shadow-sm  w-full" id="price_per_unit" type="number"
                                       name="quote_price_per_quantity"  min="0" step="any" autocomplete="price_per_unit" required placeholder="Price Per Unit" onchange=>
                            </td>
                            <td>   <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text"  name="shipping_time_in_days" min="0" autocomplete="size" required placeholder="Shipment(Days)">
                            </td>

                            <td>
                                <textarea name="note_for_customer" id="note_for_customer" class="w-full note " style="border: 2px solid #BAB6B6FF; border-radius: 8px; resize: none" maxlength="254" placeholder="Enter Note (if any)"></textarea>
                            </td>

                            <td>
                                <input class="form-input rounded-md shadow-sm block w-full VAT" id="VAT" type="number" name="VAT" min="0" max="15"  autocomplete="size" required placeholder="VAT%">
                            </td>

                            <td>
                                <input class="form-input rounded-md shadow-sm block w-full shipment_cost" id="ship_cost" type="number" name="shipment_cost"  min="0" step="any" autocomplete="size" required placeholder="Shipment Cost" >
                            </td>

                        </tr>


                            @if($eOrderItems->required_sample == 'Yes')
                                <tr >
                                    <td colspan="6" >

                                        <p class="py-2 font-bold text-center  text-2xl">Sample Information</p>
                                        <div class="flex flex-wrap overflow-hidden xl:-mx-1">
                                            <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                                <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                    Samples
                                                </label>
                                                <input class="form-input rounded-md shadow-sm block w-full" id="size" type="number" name="sample_information"  min="0" step="any" autocomplete="size" required>
                                            </div>
                                            <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                                <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                    Sample Unit
                                                </label>
                                                <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_unit"  min="0" autocomplete="size" required>
                                            </div>
                                            <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                                <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                    Quantity
                                                </label>
                                                <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_security_charges"  min="0" autocomplete="size" required>
                                            </div>
                                            <div class="w-full overflow-hidden lg:w-1/2 xl:my-1 xl:px-1 xl:w-1/2 p-2">
                                                <label class="block font-medium text-sm text-gray-700 mb-1" for="size">
                                                    Sample Charges Per Unit
                                                </label>
                                                <input class="form-input rounded-md shadow-sm block w-full" id="size" type="text" name="sample_charges_per_unit"  min="0" autocomplete="size" required>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endif

                            <tr class="mt-2">
                                <td colspan="2" class="" >


                                        <input class="form-input rounded-md shadow-sm block w-full" id="total_cost" type="number" name="total_cost" autocomplete="size" readonly placeholder="Total Cost">


                                </td>
                                <td colspan="2" class="text-left">
                                    <a style="cursor: pointer" id="totalCost" onclick="calculateCost()" class="ml-2 px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ">
                                        Calculate Total Cost
                                    </a>
                                </td>

                            </tr>

                            <tr style="border: none !important;">
                                <td colspan="6" class="px-10 text-left"  >

                                        <button
                                            class=" px-4 float-right py-2 mt-4 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-red active:bg-blue-600 transition ease-in-out duration-150">
                                            Send Quote
                                        </button>
                                        <br>
                                        <a href="{{ route('dashboard') }}"
                                           class="inline-flex items-center px-4 mr-2 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
                                            Cancel</a>


                                </td>

                            </tr>

                        </form>

                    </tbody>

                </table>



                @endif




            </div>



       </div>





</x-app-layout>

{{-- @endif --}}

<script>
    function calculateCost()
    {

        let quantity =$('#quantity').val();

        let ppu= $("#price_per_unit").val();
        let ship_cost= $("#ship_cost").val();
        let VAT= $("#VAT").val();
        $.ajax({
            type : 'GET',
            url:"{{ route('totalCost') }}",
            data:{
                {{--"_token": "{{ csrf_token() }}",--}}
                'quote_quantity':quantity,
                'quote_price_per_quantity':ppu,
                'VAT':VAT,
                'shipment_cost':ship_cost,
            },
            success: function (response) {
                console.log(response);
                $('#total_cost').val(response.data);
            }
        });

    // Clearing Total Cost Field on any mentioned fields changed
    $(document).on('keydown', '.quantity, .price_per_unit, .VAT, .shipment_cost', function(){

        $('#total_cost').val('');
    });

    }
</script>
