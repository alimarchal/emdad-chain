@section('headerScripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{ url('select2/src/select2totree.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ url('select2/src/select2totree.js') }}"></script>
@endsection

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
        .selection .select2-selection
        {
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

        select:hover , .file-label:hover {
            cursor: pointer;
        }



        .select2-selection--single {
            border-color: #d2d6dc !important;
            /*display: inline;*/
            /*  border: none !important;*/
            /*background-color: transparent !important;*/
        }

        .select2-selection__rendered
        , .uom
        , input::placeholder,
        textarea::placeholder
        {
            color: #000000 !important;

        }
        /*.select2-container*/
        /*{*/
        /*    width:auto !important;*/

        /*}*/

        @media screen and (max-width:360px) {
            .date {
                margin-left: auto;
                margin-right: auto;
            }
        }

    </style>

    {{-- getting latest record from database to be filled in fields  --}}
    @if(isset($rfqCount) && $rfqCount != 0 && $rfqCount != null)


        <h2 class="text-2xl font-bold py-2 text-center">
        </h2>

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
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Category Name
                                        </th>

                                        {{-- <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Brand
                                        </th> --}}

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Description
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Unit
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Size
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Quantity
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Last Price
                                        </th>


                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Delivery Period
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Payment Mode
                                        </th>

                                        {{-- <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Remarks
                                        </th> --}}

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Show Company Name
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                </path>
                                            </svg>
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </th>


                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($eCart as $rfp)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->item_name }}
                                            </td>

                                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->brand }}
                                            </td> --}}

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ strip_tags($rfp->description) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $rfp->unit_of_measurement }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->size }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ number_format($rfp->last_price, 2) }} <br>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->delivery_period }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->payment_mode }}
                                            </td>
                                            {{--
                                                                         <td class="px-6 py-4 whitespace-nowrap">
                                                                             {{ $rfp->remarks }}
                                                                         </td> --}}

                                            <td class="px-3 py-3 whitespace-nowrap">
                                                <select name="company_name_check" id="company_name_check" data-id="{{$rfp->id}}" class="form-select shadow-sm block w-full company_name_check" required>
                                                    <option {{($rfp->company_name_check == 0) ? 'selected' : ''}} value="0">No</option>
                                                    <option {{($rfp->company_name_check == 1) ? 'selected' : ''}} value="1">Yes</option>
                                                </select>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap" >
                                                @if ($rfp->file_path)
                                                    <a href="{{ Storage::url($rfp->file_path) }}">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
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

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                </form>
                                                <form method="POST" action="{{ route('RFQCart.destroy', $rfp->id) }}"
                                                      class="inline">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit"
                                                            class="text-indigo-600 inline-block hover:text-indigo-900"
                                                            title="DELETE" onsubmit="alert('Are you sure')">
                                                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                             fill="red">
                                                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                                            <path fill-rule="evenodd"
                                                                  d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                                                  clip-rule="evenodd" />
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
            <div class="p-4" style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
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

            <form method="POST" action="{{ route('RFQCart.store') }}" enctype="multipart/form-data">
                @csrf
                <div class=" mb-3">
                    <div>
                        <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="flex">

                            <div class="left-info_holder flex-1">
                                <div class="my-5 pl-5 ">
                                    <span class="font-bold color-1f3864 text-lg">RFQ Information</span>
                                    <hr style="border-top: 1px solid gray;width: 25%;">
                                </div>
                                <div class="my-5 pl-5 ">
                                    Display Company Name: @include('misc.required')<div class="relative inline-flex ">
                                        <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero" /></svg>
                                        <select
                                            class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                            required name="company_name_check" id="company_name_check">
                                            <option value="">Select</option>
                                            <option
                                                @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 0 ? 'selected' : ''}}
                                                @endif value="0">No</option>
                                            <option
                                                @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 1  ? 'selected' : ''}}
                                                @endif value="1">Yes</option>
                                        </select>
                                    </div>
                                    <br>
                                    Payment Mode: @include('misc.required')<div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero" /></svg>
                                        <select
                                            class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                            name="payment_mode" id="payment_mode" required>
                                            <option value="">None</option>

                                            <option value="Cash" @if (isset($latest_rfq))
                                                {{$latest_rfq->payment_mode =='Cash' ? 'selected' : ''}} @endif>Cash
                                            </option>

                                            @php
                                                $businessId = auth()->user()->business->id;
                                                $package = \App\Models\BusinessPackage::where('business_id',
                                                $businessId)->first();

                                            @endphp

                                            {{--@if(auth()->user()->business_package->package_id != 1)--}}
                                            @if($package->package_id != 1)
                                                <option value="Credit" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Credit' ? 'selected' : ''}} @endif>Credit
                                                </option>
                                                <option value="Credit30days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Credit30days' ? 'selected' : ''}} @endif>
                                                    Credit (30
                                                    Days)</option>
                                                <option value="Credit60days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Credit60days' ? 'selected' : ''}} @endif>
                                                    Credit (60
                                                    Days)</option>
                                                <option value="Credit90days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Credit90days' ? 'selected' : ''}} @endif>
                                                    Credit (90
                                                    Days)</option>
                                                <option value="Credit120days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Credit120days' ? 'selected' : ''}} @endif>
                                                    Credit (120
                                                    Days)</option>
                                            @endif
                                        </select>
                                    </div> <br>
                                    Required Sample: @include('misc.required')<div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero" /></svg>
                                        <select
                                            class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                            required name="required_sample" id="required_sample">
                                            <option value="">None</option>
                                            <option value="Yes" @if (isset($latest_rfq))
                                                {{$latest_rfq->required_sample =='Yes' ? 'selected' : ''}} @endif>Yes
                                            </option>
                                            <option value="No" @if (isset($latest_rfq))
                                                {{$latest_rfq->required_sample =='No' ? 'selected' : ''}} @endif>No
                                            </option>

                                        </select>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="Right-info_holder flex-1">
                                <div class="my-5 pl-5 ">
                                    <span class="font-bold text-lg color-1f3864">Shipping Information</span>
                                    <hr style="border-top: 1px solid gray;width: 25%;">
                                </div>
                                <div class="my-5 pl-5 ">
                                    Warehouse Location: @include('misc.required')<div class="relative inline-flex">
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
                                    Delivery Period: @include('misc.required')<div class="relative inline-flex">
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


                    <table class="table-fixed text-center min-w-full ">
                        <thead style="background-color:#8EAADB" class="text-white">
                        <tr>

                            <th style="width:15%;">Category @include('misc.required')</th>
                            <th style="width:20%;">Item Description @include('misc.required')</th>
                            <th style="width:7%">  UOM @include('misc.required') </th>
                            <th style="width:7%;">Quantity @include('misc.required') </th>
                            <th style="width:10%;">Size </th>
                            <th style="width:10%;">Brand</th>
                            <th style="width:7%;">Last Unit Price</th>
                            <th style="width:15%;"> Shipment Remarks</th>
                            <th style="width:7%;">Attachments</th>
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

                                    {{$parent != '' ? $parent->name :'' }}

                                    {{ $item->item_name}} , {{ $parent->name}}

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
                                <div class="relative inline-flex">
                                    <svg class="w-2 h-2 absolute top-0 right-1.5 mt-4 pointer-events-none"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                        <path
                                            d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                            fill="#000000" fill-rule="nonzero" /></svg>
                                    <select
                                        class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom"
                                        required name="unit_of_measurement" id="unit_of_measurement" style="max-height:35px;">
                                        <option value="" >None</option>
                                        @foreach (\App\Models\UnitMeasurement::all() as $item)
                                            <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                        @endforeach

                                    </select>
                                </div>
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
                                       autocomplete="name" style="display:none;">
                            </td>
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

    @elseif($rfqCount==null)
        <h2 class="text-2xl font-bold py-2 text-center">
        </h2>

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
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Category Name
                                        </th>

                                        {{-- <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Brand
                                        </th> --}}

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Description
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Unit
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Size
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Quantity
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Last Price
                                        </th>


                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Delivery Period
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Payment Mode
                                        </th>

                                        {{-- <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Remarks
                                        </th> --}}

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            Show Company Name
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                </path>
                                            </svg>
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </th>


                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($eCart as $rfp)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->item_name }}
                                            </td>

                                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->brand }}
                                            </td> --}}

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ strip_tags($rfp->description) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $rfp->unit_of_measurement }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->size }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ number_format($rfp->last_price, 2) }} <br>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->delivery_period }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $rfp->payment_mode }}
                                            </td>
                                            {{--
                                                                         <td class="px-6 py-4 whitespace-nowrap">
                                                                             {{ $rfp->remarks }}
                                                                         </td> --}}


                                            <td class="px-3 py-3 whitespace-nowrap">
                                                <select name="company_name_check" id="company_name_check" data-id="{{$rfp->id}}" class="form-select shadow-sm block w-full company_name_check" required>
                                                    <option {{($rfp->company_name_check == 0) ? 'selected' : ''}} value="0">No</option>
                                                    <option {{($rfp->company_name_check == 1) ? 'selected' : ''}} value="1">Yes</option>
                                                </select>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap" >
                                                @if ($rfp->file_path)
                                                    <a href="{{ Storage::url($rfp->file_path) }}">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
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

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                </form>
                                                <form method="POST" action="{{ route('RFQCart.destroy', $rfp->id) }}"
                                                      class="inline">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit"
                                                            class="text-indigo-600 inline-block hover:text-indigo-900"
                                                            title="DELETE" onsubmit="alert('Are you sure')">
                                                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                             fill="red">
                                                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                                            <path fill-rule="evenodd"
                                                                  d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                                                  clip-rule="evenodd" />
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
            <div class="p-4" style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
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

            <form method="POST" action="{{ route('RFQCart.store') }}" enctype="multipart/form-data">
                @csrf
                <div class=" mb-3">
                    <div>
                        <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="md:flex">

                            <div class="left-info_holder md:flex-1">
                                <div class="my-5 pl-5 ">
                                    <span class="font-bold color-1f3864 text-lg">RFQ Information</span>
                                    <hr style="border-top: 1px solid gray;width: 25%;">
                                </div>
                                <div class="my-5 pl-5 ">
                                    Display Company Name: @include('misc.required')<div class="relative inline-flex ">
                                        <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero" /></svg>
                                        <select
                                            class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                            required name="company_name_check" id="company_name_check">
                                            <option value="">Select</option>
                                            <option
                                                @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 0 ? 'selected' : ''}}
                                                @endif value="0">No</option>
                                            <option
                                                @if(isset($latest_rfq)){{$latest_rfq->company_name_check == 1  ? 'selected' : ''}}
                                                @endif value="1">Yes</option>
                                        </select>
                                    </div>
                                    <br>
                                    Payment Mode: @include('misc.required')<div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero" /></svg>
                                        <select
                                            class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                            name="payment_mode" id="payment_mode" required>
                                            <option value="">None</option>

                                            <option value="Cash" @if (isset($latest_rfq))
                                                {{$latest_rfq->payment_mode =='Cash' ? 'selected' : ''}} @endif>Cash
                                            </option>

                                            @php
                                                $businessId = auth()->user()->business->id;
                                                $package = \App\Models\BusinessPackage::where('business_id',
                                                $businessId)->first();

                                            @endphp

                                            {{--@if(auth()->user()->business_package->package_id != 1)--}}
                                            @if($package->package_id != 1)
                                                <option value="Credit" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Credit' ? 'selected' : ''}} @endif>Credit
                                                </option>
                                                <option value="Credit30days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Credit30days' ? 'selected' : ''}} @endif>
                                                    Credit (30
                                                    Days)</option>
                                                <option value="Credit60days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Credit60days' ? 'selected' : ''}} @endif>
                                                    Credit (60
                                                    Days)</option>
                                                <option value="Credit90days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Credit90days' ? 'selected' : ''}} @endif>
                                                    Credit (90
                                                    Days)</option>
                                                <option value="Credit120days" @if (isset($latest_rfq))
                                                    {{$latest_rfq->payment_mode =='Credit120days' ? 'selected' : ''}} @endif>
                                                    Credit (120
                                                    Days)</option>
                                            @endif
                                        </select>
                                    </div> <br>
                                    Required Sample: @include('misc.required')<div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero" /></svg>
                                        <select
                                            class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                            required name="required_sample" id="required_sample">
                                            <option value="">None</option>
                                            <option value="Yes" @if (isset($latest_rfq))
                                                {{$latest_rfq->required_sample =='Yes' ? 'selected' : ''}} @endif>Yes
                                            </option>
                                            <option value="No" @if (isset($latest_rfq))
                                                {{$latest_rfq->required_sample =='No' ? 'selected' : ''}} @endif>No
                                            </option>

                                        </select>
                                    </div> <br>


                                </div>
                            </div>
                            <div class="Right-info_holder md:flex-1">
                                <div class="my-5 pl-5 ">
                                    <span class="font-bold text-lg color-1f3864">Shipping Information</span>
                                    <hr style="border-top: 1px solid gray;width: 25%;">
                                </div>
                                <div class="my-5 pl-5 ">
                                    Warehouse Location: @include('misc.required')<div class="relative inline-flex">
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
                                    Delivery Period: @include('misc.required')<div class="relative inline-flex">
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

                    <table class="table-fixed text-center min-w-full ">
                        <thead style="background-color:#8EAADB" class="text-white">
                        <tr>

                            <th style="width:15%;">Category @include('misc.required')</th>
                            <th style="width:20%;">Item Description @include('misc.required')</th>
                            <th style="width:7%">  UOM @include('misc.required') </th>
                            <th style="width:7%;">Quantity @include('misc.required') </th>
                            <th style="width:10%;">Size </th>
                            <th style="width:10%;">Brand</th>
                            <th style="width:7%;">Last Unit Price</th>
                            <th style="width:15%;"> Shipment Remarks</th>
                            <th style="width:7%;">Attachments</th>
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

                                    {{$parent != '' ? $parent->name :'' }}

                                    {{ $item->item_name}} , {{ $parent->name}}

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
                                <div class="relative inline-flex">
                                    <svg class="w-2 h-2 absolute top-0 right-1.5 mt-4 pointer-events-none"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                        <path
                                            d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                            fill="#000000" fill-rule="nonzero" /></svg>
                                    <select
                                        class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom"
                                        required name="unit_of_measurement" id="unit_of_measurement" style="max-height:35px;">
                                        <option value="" >None</option>
                                        @foreach (\App\Models\UnitMeasurement::all() as $item)
                                            <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                        @endforeach

                                    </select  >
                                </div>
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
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="text-black text-2xl" style="text-align: center">
                            Your have reached daily RFQ generate limit.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>

<script>

    $('.company_name_check').change(function(){
    // alert($(this).attr('data-id'));
    // alert($(this).val());
    let status = $(this).val();
    let rfqId = $(this).attr('data-id');
    // alert(rfqId);


        $.ajax({
        type : 'POST',
        url:"{{ route('companyCheck') }}",
        data:{
            "_token": "{{ csrf_token() }}",
            'rfqNo':rfqId,
            'status':status
        },
        success: function (response) {
        if(response.status === 0){
            alert('Not Updated Try again');
        }
        else if(response.status === 1) {
        alert('Updated Successfully!');
        // $('#status').show().delay(5000).fadeOut();
            }
         }
        });
    });

</script>
