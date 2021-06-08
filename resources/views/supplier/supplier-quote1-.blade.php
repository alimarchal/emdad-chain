@section('headerScripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
<link href="{{ url('select2/src/select2totree.css') }}" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{ url('select2/src/select2totree.js') }}"></script>
@endsection
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

        tbody tr:hover {
            background-color: #F3F3F3;
            cursor: pointer;
        }

        select:hover {
            cursor: pointer;
        }

        input,
        .description {
            max-height: 30px;
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

        .file-label:hover {
            cursor: pointer;
        }

        .select2-selection--single {
            border-color: #d2d6dc !important;
        }

        .select2-selection__rendered {
            color: #9FADCB !important;
        }

        @media screen and (max-width:360px) {
            .date {
                margin-left: auto;
                margin-right: auto;
            }
        }

    </style>

    {{-- getting latest record from database to be filled in fields  --}}


    <h2 class="text-2xl font-bold py-2 text-center">
    </h2>



    <div class="flex flex-col bg-white rounded">




        <div class="p-4" style="background-color: #F3F3F3">
            <div class="d-block text-center">
                <span class="text-2xl font-bold color-7f7f7f">Request For Quotation</span>

            </div>
            <hr>
            <div style=" min-height: 145px;" class="container-fluid px-4 flex bg-grey flex-wrap">
                <div class="flex-1 py-5">
                    <div class="my-5 pl-5">
                        {{-- <img src="{{ Storage::url(Auth::user()->business->business_photo_url) }}" alt="logo"
                        style="height: 80px;width: 200px;" /> --}}
                        <img src="{{ url('imp_img.jpg') }}" alt="logo" style="height: 80px;width: 200px;" /> 
                    </div>
                  
                    <div class="my-5 pl-5 ">
                        <h1 class="font-extrabold color-1f3864 text-xl ">Lorem, ipsum.</h1>
                
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
        <hr>
        <form method="POST" action="{{-- route('RFQCart.store') --}}" enctype="multipart/form-data">
            @csrf
            <div class="p-4 mb-3">
                <div>
                    <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="md:flex">

                        <div class="left-info_holder md:flex-1">
                            <div class="my-5 pl-5 ">
                                <span class="font-bold color-1f3864 text-lg">RFQ Information</span>
                                <hr style="border-top: 1px solid gray;width: 25%;">
                            </div>
                            <div class="my-5 pl-5 ">
                                Display Company Name: Lorem, ipsum.
                                </div>
                                <br>
                                Payment Mode: Lorem, ipsum.
                                </div> <br>
                                Unit of Measurement: Lorem, ipsum.
                                </div> <br>
                            </div>
                        </div>
                        <div class="Right-info_holder md:flex-1">
                            <div class="my-5 pl-5 ">
                                <span class="font-bold text-lg color-1f3864">Shipping Information</span>
                                <hr style="border-top: 1px solid gray;width: 25%;">
                            </div>
                            <div class="my-5 pl-5 ">
                                Warehouse Location:<div class="relative inline-flex">
                                    <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                        <path
                                            d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                            fill="#000000" fill-rule="nonzero" /></svg>
                                    <select
                                        class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                        required name="warehouse_id" id="warehouse_id">
                                        <option value="">Select Warehouse Location</option>
                                        @foreach(\App\Models\BusinessWarehouse::where('business_id',
                                        auth()->user()->business_id)->get() as $warehouse)
                                        <option value="{{$warehouse->id}}" @if (isset($latest_rfq))
                                            {{$latest_rfq->warehouse_id ==$warehouse->id ? 'selected' : ''}} @endif>
                                            {{$warehouse->name . ' Address:' . $warehouse->address }}</option>
                                        @endforeach

                                    </select>
                                </div> <br>
                                Delivery Period:<div class="relative inline-flex">
                                    <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                        <path
                                            d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                            fill="#000000" fill-rule="nonzero" /></svg>
                                    <select
                                        class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                        name="delivery_period" id="delivery_period" required>
                                        <option value="">Select Delivery Period</option>
                                        <option value="Immediately" @if (isset($latest_rfq))
                                            {{$latest_rfq->delivery_period =='Immediately' ? 'selected' : ''}} @endif>
                                            Immediately</option>
                                        <option value="Within 30 Days" @if (isset($latest_rfq))
                                            {{$latest_rfq->delivery_period =='Within 30 Days' ? 'selected' : ''}}
                                            @endif>30 Days</option>
                                        <option value="Within 60 Days" @if (isset($latest_rfq))
                                            {{$latest_rfq->delivery_period =='Within 60 Days' ? 'selected' : ''}}
                                            @endif>60 Days</option>
                                        <option value="Within 90 Days">90 Days</option>
                                        <option value="Standing Order - 2 per year" @if (isset($latest_rfq))
                                            {{$latest_rfq->delivery_period =='Standing Order - 2 per year' ? 'selected' : ''}}
                                            @endif>Standing Order - 2 times / year
                                        </option>
                                        <option value="Standing Order - 3 per year" @if (isset($latest_rfq))
                                            {{$latest_rfq->delivery_period =='Standing Order - 3 per year' ? 'selected' : ''}}
                                            @endif>Standing Order - 3 times / year
                                        </option>
                                        <option value="Standing Order - 4 per year" @if(isset($latest_rfq))
                                            {{$latest_rfq->delivery_period =='Standing Order - 4 per year' ? 'selected' : ''}}
                                            @endif>Standing Order - 4 times / year
                                        </option>
                                        <option value="Standing Order - 6 per year" @if(isset($latest_rfq))
                                            {{$latest_rfq->delivery_period =='Standing Order - 6 per year' ? 'selected' : ''}}
                                            @endif>Standing Order - 6 times / year
                                        </option>
                                        <option value="Standing Order - 12 per year" @if(isset($latest_rfq))
                                            {{$latest_rfq->delivery_period =='Standing Order - 12 per year' ? 'selected' : ''}}
                                            @endif>Standing Order - 12 times / year
                                        </option>
                                        <option value="Standing Order Open" @if(isset($latest_rfq))
                                            {{$latest_rfq->delivery_period =='Standing Order Open' ? 'selected' : ''}}
                                            @endif>Standing Order - Open</option>

                                    </select>
                                </div> <br>
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

                $business_package = \App\Models\BusinessPackage::where('business_id',
                auth()->user()->business_id)->first();
                $package = \App\Models\Package::where('id', $business_package->package_id)->first();
                $count = $package->rfq_per_day - $rfq;
                @endphp
                @if($business_package->package_id == 1 || $business_package->package_id == 2 )
                <div class="flex flex-wrap pl-5 " style="justify-content: center">
                    <h1 class="text-1xl mt-0 pb-0 text-center"> RFQ(s) remaining for the day: </h1>
                    <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$count}} </h1>
                </div>
                @endif


                <table class="table-fixed text-center min-w-full " style="margin-left:50px; margin-right:50px;">
                    <thead style="background-color:#8EAADB" class="text-white">
                        <tr>

                            <th class="w-1/6">Category</th>
                            <th class="w-1/6">Item Description</th>
                            <th class="w-1/12">Quantity</th>
                            <th class="w-1/8">Size</th>
                            <th class="w-1/8">Brand</th>
                            <th class="w-1/10">Last Unit Price</th>
                            <th class="w-1/6"> Shipment Remarks</th>
                            <th class="w-1/8">Attachments</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach($eCart as $item)
                        <tr>
                            <td>
                                @php
                                $record = \App\Models\Category::where('name',$item->item_name)->first();
                                $parent= \App\Models\Category::where('id',$record->parent_id)->first();
                                @endphp

                                {{-- {{$parent != '' ? $parent->name :'' }} --}}

                                {{ $item->item_name}} , {{ $parent->name}}

                            </td>
                            <td>
                                {{strip_tags($item->description)}}
                            </td>
                            <td>
                                {{$item->quantity}}
                            </td>
                            <td>
                                {{$item->size}}
                            </td>
                            <td>
                                {{$item->brand}}
                            </td>

                            <td> {{ number_format($rfp->last_price, 2) }}</td>
                            <td>
                                {{$item->remarks}}
                            </td>
                            <td class="">
                                @if ($item->file_path)
                                <a href="{{ Storage::url($rfp->file_path) }}">
                                    <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                        </path>
                                    </svg>
                                </a>
                                @else
                                #N/A
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
                                    placeholder="Enter Description.." required></textarea>
                                <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                                <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                            </td>
                            <td>
                                <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                    name="quantity" min="0" autocomplete="quantity" required placeholder="Qty">
                            </td>
                            <td>
                                <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text" name="size"
                                    min="0" placeholder="Size">
                            </td>
                            <td> <input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                    name="brand" min="0" autocomplete="brand" placeholder="Brand"></td>

                            <td>
                                <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                    name="last_price" min="0" autocomplete="last_price" placeholder="Price">
                            </td>

                            <td>
                                <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks"
                                    type="text" autocomplete="remarks" placeholder="Remarks">
                            </td>

                            <td>

                                <label for="file" class="file-label"><img class="mx-auto" style="width:25px;"
                                        src="https://img.icons8.com/pastel-glyph/64/000000/upload-document--v1.png" /></label>
                                <input class="shadow-sm block w-full" id="file" type="file" name="file_path_1"
                                    autocomplete="name" style="display:none;"></td>
                        </tr>



                    </tbody>
                </table>
                <div class="text-center my-4">
                    <button type="submit"
                        class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                        ADD ITEM
                    </button>
                </div>

            </div>

        </form>
    </div>
  





</x-app-layout>

{{-- @endif --}}
<script>
    function companyCheck(itemno) {
        $value = $('#company_name_check').val();
        $.ajax({
            type: 'POST',
            url: "{{ route('companyCheck') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                'rfqNo': itemno,
                'status': $value
            },
            success: function (response) {
                if (response.status === 0) {
                    alert('Not Updated Try again');
                } else if (response.status === 1) {
                    $('#status').show().delay(2000).fadeOut();
                }
            }
        });
    }

</script>
