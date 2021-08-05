@section('headerScripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{ url('select2/src/select2totree.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ url('select2/src/select2totree.js') }}"></script>
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
        @if(isset($rfqCount) && $rfqCount != 0 && $rfqCount != null)


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
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider" title="Attachment">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                                    {{ $rfp->item_name }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ strip_tags($rfp->description) }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                                                    {{ $rfp->unit_of_measurement }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->size }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->quantity }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ number_format($rfp->last_price, 2) }} <br>
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->delivery_period }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->payment_mode }}
                                                </td>

                                                <td class="px-3 py-3 text-center whitespace-nowrap">
                                                    @if($rfp->company_name_check == 0) {{__('portal.No')}} @elseif($rfp->company_name_check == 1){{__('portal.Yes')}} @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
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
                                                    {{__('portal.N/A')}}
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <form method="POST" action="{{ route('RFQCart.destroy', $rfp->id) }}"
                                                          class="inline confirm" data-confirm = 'Are you sure you want to delete?'>
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit"
                                                                class="text-indigo-600 inline-block hover:text-indigo-900"
                                                                title="DELETE" onsubmit="alert('Are you sure')">
                                                            <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
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
                <div class="p-4" style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
                    <div class="d-block text-center">
                        <span class="text-2xl font-bold color-7f7f7f">{{__('portal.Request For Quotation')}}</span>
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

                <form method="POST" action="{{ route('single_cart_store_rfq') }}" enctype="multipart/form-data">
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
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                    required name="company_name_check" id="company_name_check">
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->company_name_check}}">
                                                        @if($latest_rfq->company_name_check == 0){{__('portal.No')}}
                                                        @elseif($latest_rfq->company_name_check == 1){{__('portal.Yes')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.Select')}}</option>
                                                    <option value="0">{{__('portal.No')}}</option>
                                                    <option value="1">{{__('portal.Yes')}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Payment Mode')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" name="payment_mode" id="payment_mode" required>
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->payment_mode}}">{{$latest_rfq->payment_mode}}</option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option value="Cash">{{__('portal.Cash')}}</option>

                                                    @php
                                                        $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
                                                    @endphp

                                                    @if($package->package_id != 1)
                                                        <option value="Credit">{{__('portal.Credit')}}</option>
                                                        <option value="Credit30days">{{__('portal.Credit (30 Days)')}}</option>
                                                        <option value="Credit60days">{{__('portal.Credit (60 Days)')}}</option>
                                                        <option value="Credit90days">{{__('portal.Credit (90 Days)')}}</option>
                                                        <option value="Credit120days">{{__('portal.Credit (120 Days)')}}</option>
                                                    @endif
                                                @endif

                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Required Sample')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="required_sample" id="required_sample">
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->required_sample}}">{{$latest_rfq->required_sample}}</option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option value="Yes">{{__('portal.Yes')}}</option>
                                                    <option value="No">{{__('portal.No')}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>

                                        {{__('portal.Category')}}: @include('misc.required')
                                        <div class="relative inline-flex" style="width: 400px;">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
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

                                                <select name="item_name" class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" readonly style="width: 400px;">
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
                                        <span class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        {{__('portal.Warehouse Location')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
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
                                                        <option value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="delivery_period" id="delivery_period" required>
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->delivery_period}}">{{$latest_rfq->delivery_period}}</option>
                                                @else
                                                    <option value="">{{__('portal.Select Delivery Period')}}</option>
                                                    <option value="Immediately">{{__('portal.Immediately')}}</option>
                                                    <option value="Within 30 Days">{{__('portal.30 Days')}}</option>
                                                    <option value="Within 60 Days">{{__('portal.60 Days')}}</option>
                                                    <option value="Within 90 Days">{{__('portal.90 Days')}}</option>
                                                    <option value="Standing Order - 2 per year">{{__('portal.Standing Order - 2 times / year')}}</option>
                                                    <option value="Standing Order - 3 per year">{{__('portal.Standing Order - 3 times / year')}}</option>
                                                    <option value="Standing Order - 4 per year">{{__('portal.Standing Order - 4 times / year')}}</option>
                                                    <option value="Standing Order - 6 per year">{{__('portal.Standing Order - 6 times / year')}}</option>
                                                    <option value="Standing Order - 12 per year">{{__('portal.Standing Order - 12 times / year')}}</option>
                                                    <option value="Standing Order Open">{{__('portal.Standing Order - Open')}}</option>
                                                @endif

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
                                <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Requisition(s) remaining for the day')}}: </h1>
                                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$count}} </h1>
                            </div>
                        @endif


                        <table class="table-fixed text-center min-w-full ">
                            <thead style="background-color:#8EAADB" class="text-white">
                            <tr>

                                <th style="width:3%;"># </th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:7%">{{__('portal.UOM')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Size')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Brand')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Last Unit Price')}} @include('misc.required')</th>
                                <th style="width:15%;">{{__('portal.Shipment Remarks')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Attachments')}} @include('misc.required')</th>
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

                                    <td> {{ number_format($item->last_price, 2) }}</td>
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
                                          placeholder="{{__('portal.Enter Description..')}}" required></textarea>
                                    <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                                </td>
                                <td>
                                    <div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-1.5 mt-4 pointer-events-none" style="width: 8px; height:8px;"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </svg>
                                        <select
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom"
                                            required name="unit_of_measurement" id="unit_of_measurement" style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" min="0" autocomplete="quantity" required placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text" name="size"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td><input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" min="0" autocomplete="brand" placeholder="{{__('portal.Brand')}}"></td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" min="0" autocomplete="last_price" placeholder="{{__('portal.Price')}}">
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
                                    class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.ADD ITEM')}}
                            </button>

                            <a href="{{route('single_cart_index')}}"
                               class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}</a>
                        </div>

                    </div>

                </form>
            </div>

        @elseif($rfqCount == null )
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
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider" title="Attachment">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                                    {{ $rfp->item_name }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ strip_tags($rfp->description) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $rfp->unit_of_measurement }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->size }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->quantity }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ number_format($rfp->last_price, 2) }} <br>
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->delivery_period }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->payment_mode }}
                                                </td>

                                                <td class="px-3 py-3 text-center whitespace-nowrap">
                                                    @if($rfp->company_name_check == 0) {{__('portal.No')}} @elseif($rfp->company_name_check == 1){{__('portal.Yes')}} @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
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
                                                        {{__('portal.N/A')}}
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <form method="POST" action="{{ route('RFQCart.destroy', $rfp->id) }}"
                                                          class="inline confirm" data-confirm = 'Are you sure you want to delete?'>
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit"
                                                                class="text-indigo-600 inline-block hover:text-indigo-900"
                                                                title="DELETE">
                                                            <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
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
                <div class="p-4" style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
                    <div class="d-block text-center">
                        <span class="text-2xl font-bold color-7f7f7f">{{__('portal.Request For Quotation')}}</span>
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
                                        <span class="font-bold color-1f3864 text-lg">{{__('portal.Requisition Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5" style="padding-left: 20px">

                                        {{__('portal.Display Company Name')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                    required name="company_name_check" id="company_name_check">
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->company_name_check}}">
                                                        @if($latest_rfq->company_name_check == 0){{__('portal.No')}}
                                                        @elseif($latest_rfq->company_name_check == 1){{__('portal.Yes')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.Select')}}</option>
                                                    <option value="0">{{__('portal.No')}}</option>
                                                    <option value="1">{{__('portal.Yes')}}</option>
                                                @endif
                                            </select>
                                        </div>

                                        <br>
                                        {{__('portal.Payment Mode')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" name="payment_mode" id="payment_mode" required>
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->payment_mode}}">{{$latest_rfq->payment_mode}}</option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option value="Cash">{{__('portal.Cash')}}</option>

                                                    @php
                                                        $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
                                                    @endphp

                                                    @if($package->package_id != 1)
                                                        <option value="Credit">{{__('portal.Credit')}}</option>
                                                        <option value="Credit30days">{{__('portal.Credit (30 Days)')}}</option>
                                                        <option value="Credit60days">{{__('portal.Credit (60 Days)')}}</option>
                                                        <option value="Credit90days">{{__('portal.Credit (90 Days)')}}</option>
                                                        <option value="Credit120days">{{__('portal.Credit (120 Days)')}}</option>
                                                    @endif
                                                @endif

                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Required Sample')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                required name="required_sample" id="required_sample">
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->required_sample}}">{{$latest_rfq->required_sample}}</option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option value="Yes">{{__('portal.Yes')}}</option>
                                                    <option value="No">{{__('portal.No')}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>

                                        {{__('portal.Category')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
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

                                                <select name="item_name" class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" readonly>
                                                    <option value="{{$latest_rfq->item_code}}">{{$latest_rfq->item_name . ' - ' . $parent->name }}</option>
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
                                        <span class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        {{__('portal.Warehouse Location')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
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
                                                        <option value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
                                                class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                name="delivery_period" id="delivery_period" required>
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->delivery_period}}">{{$latest_rfq->delivery_period}}</option>
                                                @else
                                                    <option value="">{{__('portal.Select Delivery Period')}}</option>
                                                    <option value="Immediately">{{__('portal.Immediately')}}</option>
                                                    <option value="Within 30 Days">{{__('portal.30 Days')}}</option>
                                                    <option value="Within 60 Days">{{__('portal.60 Days')}}</option>
                                                    <option value="Within 90 Days">{{__('portal.90 Days')}}</option>
                                                    <option value="Standing Order - 2 per year">{{__('portal.Standing Order - 2 times / year')}}</option>
                                                    <option value="Standing Order - 3 per year">{{__('portal.Standing Order - 3 times / year')}}</option>
                                                    <option value="Standing Order - 4 per year">{{__('portal.Standing Order - 4 times / year')}}</option>
                                                    <option value="Standing Order - 6 per year">{{__('portal.Standing Order - 6 times / year')}}</option>
                                                    <option value="Standing Order - 12 per year">{{__('portal.Standing Order - 12 times / year')}}</option>
                                                    <option value="Standing Order Open">{{__('portal.Standing Order - Open')}}</option>
                                                @endif

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

                                <th style="width:3%;">#</th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:7%">{{__('portal.UOM')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Size')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Brand')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Last Unit Price')}} @include('misc.required')</th>
                                <th style="width:15%;"> {{__('portal.Shipment Remarks')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Attachments')}} @include('misc.required')</th>
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

                                    <td> {{ number_format($item->last_price, 2) }}</td>
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
                                          placeholder="{{__('portal.Enter Description..')}}" required></textarea>
                                    <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                                </td>
                                <td>
                                    <div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-1.5 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </svg>
                                        <select
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom"
                                            required name="unit_of_measurement" id="unit_of_measurement" style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" min="0" autocomplete="quantity" required placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text" name="size"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" min="0" autocomplete="brand" placeholder="{{__('portal.Brand')}}">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" min="0" autocomplete="last_price" placeholder="{{__('portal.Price')}}">
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
                                    class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.ADD ITEM')}}
                            </button>


                            <a href="{{route('single_cart_index')}}"
                               class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}
                            </a>
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
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider" title="Attachment">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                                    {{ $rfp->item_name }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ strip_tags($rfp->description) }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                                                    {{ $rfp->unit_of_measurement }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->size }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->quantity }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ number_format($rfp->last_price, 2) }} <br>
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

                                                <td class="px-3 py-3 text-center whitespace-nowrap">
                                                    @if($rfp->company_name_check == 0) {{__('portal.No')}} @elseif($rfp->company_name_check == 1){{__('portal.Yes')}} @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
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
                                                       {{__('portal.N/A')}}
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <form method="POST" action="{{ route('RFQCart.destroy', $rfp->id) }}"
                                                          class="inline confirm" data-confirm = 'Are you sure you want to delete?'>
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit"
                                                                class="text-indigo-600 inline-block hover:text-indigo-900"
                                                                title="DELETE" onsubmit="alert('Are you sure')">
                                                            <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
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
                <div class="p-4" style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
                    <div class="d-block text-center">
                        <span class="text-2xl font-bold color-7f7f7f">{{__('portal.Request For Quotation')}}</span>
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

                        <div class="flex-1" style="flex: inherit">
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
                                        <span class="font-bold color-1f3864 text-lg">{{__('portal.Requisition Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 " style="padding-left: 40px;">

                                        {{__('portal.Display Company Name')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                    required name="company_name_check" id="company_name_check">
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->company_name_check}}">
                                                        @if($latest_rfq->company_name_check == 0){{__('portal.No')}}
                                                        @elseif($latest_rfq->company_name_check == 1){{__('portal.Yes')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.Select')}}</option>
                                                    <option value="0">{{__('portal.No')}}</option>
                                                    <option value="1">{{__('portal.Yes')}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Payment Mode')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" name="payment_mode" id="payment_mode" required>
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
                                                    <option value="Cash">{{__('portal.Cash')}}</option>

                                                    @php
                                                        $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
                                                    @endphp

                                                    @if($package->package_id != 1)
                                                        <option value="Credit">{{__('portal.Credit')}}</option>
                                                        <option value="Credit30days">{{__('portal.Credit (30 Days)')}}</option>
                                                        <option value="Credit60days">{{__('portal.Credit (60 Days)')}}</option>
                                                        <option value="Credit90days">{{__('portal.Credit (90 Days)')}}</option>
                                                        <option value="Credit120days">{{__('portal.Credit (120 Days)')}}</option>
                                                    @endif
                                                @endif

                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Required Sample')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
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
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option value="Yes">{{__('portal.Yes')}}</option>
                                                    <option value="No">{{__('portal.No')}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>

                                        {{__('portal.Category')}}: @include('misc.required')
                                        <div class="relative inline-flex" style="width: 400px;">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
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

                                                <select name="item_name" class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" readonly style="width: 400px;">
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
                                        <span class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        {{__('portal.Warehouse Location')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
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
                                                        <option value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
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
                                                    <option value="Standing Order - 2 per year">{{__('portal.Standing Order - 2 times / year')}}</option>
                                                    <option value="Standing Order - 3 per year">{{__('portal.Standing Order - 3 times / year')}}</option>
                                                    <option value="Standing Order - 4 per year">{{__('portal.Standing Order - 4 times / year')}}</option>
                                                    <option value="Standing Order - 6 per year">{{__('portal.Standing Order - 6 times / year')}}</option>
                                                    <option value="Standing Order - 12 per year">{{__('portal.Standing Order - 12 times / year')}}</option>
                                                    <option value="Standing Order Open">{{__('portal.Standing Order - Open')}}</option>
                                                @endif

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
                                <h1 class="text-1xl mt-0 pb-0 text-center"> {{__('portal.Requisition(s) remaining for the day')}}: </h1>
                                <h1 class="text-1xl mt-0 pb-0 text-center text-red-500"> &nbsp; {{$count}} </h1>
                            </div>
                        @endif


                        <table class="table-fixed text-center min-w-full ">
                            <thead style="background-color:#8EAADB" class="text-white">
                            <tr>

                                <th style="width:3%;"># </th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:7%">{{__('portal.UOM')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Size')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Brand')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Last Unit Price')}} @include('misc.required')</th>
                                <th style="width:15%;">{{__('portal.Shipment Remarks')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Attachments')}} @include('misc.required')</th>
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

                                    <td> {{ number_format($item->last_price, 2) }}</td>
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
                                          placeholder="{{__('portal.Enter Description..')}}" required></textarea>
                                    <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                                </td>
                                <td>
                                    <div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-1.5 mt-4 pointer-events-none" style="width: 8px; height:8px;"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </svg>
                                        <select
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom"
                                            required name="unit_of_measurement" id="unit_of_measurement" style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" min="0" autocomplete="quantity" required placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text" name="size"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td><input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" min="0" autocomplete="brand" placeholder="{{__('portal.Brand')}}"></td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" min="0" autocomplete="last_price" placeholder="{{__('portal.Price')}}">
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
                                    class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.ADD ITEM')}}
                            </button>

                            <a href="{{route('single_cart_index')}}"
                               class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}
                            </a>
                        </div>

                    </div>

                </form>
            </div>

        @elseif($rfqCount == null )
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
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider" title="Attachment">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                                    {{ $rfp->item_name }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ strip_tags($rfp->description) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $rfp->unit_of_measurement }}
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->size }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $rfp->quantity }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ number_format($rfp->last_price, 2) }} <br>
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

                                                <td class="px-3 py-3 text-center whitespace-nowrap">
                                                    @if($rfp->company_name_check == 0) {{__('portal.No')}} @elseif($rfp->company_name_check == 1){{__('portal.Yes')}} @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
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
                                                       {{__('portal.N/A')}}
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <form method="POST" action="{{ route('RFQCart.destroy', $rfp->id) }}"
                                                          class="inline confirm" data-confirm = 'Are you sure you want to delete?'>
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit"
                                                                class="text-indigo-600 inline-block hover:text-indigo-900"
                                                                title="DELETE">
                                                            <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
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
                <div class="p-4" style="background-color: #F3F3F3; border-top:20px solid #E69138; border-bottom: 20px solid #FCE5CD;">
                    <div class="d-block text-center">
                        <span class="text-2xl font-bold color-7f7f7f">{{__('portal.Request For Quotation')}}</span>
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

                        <div class="flex-1" style="flex: inherit">
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
                            <div style="background: #DEEAF6; min-height: 235px; padding-top: 1px;" class="md:flex">

                                <div class="left-info_holder md:flex-1">
                                    <div class="my-5 pl-5 " style="padding-left: 20px">
                                        <span class="font-bold color-1f3864 text-lg">{{__('portal.Requisition Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5" style="padding-left: 20px">

                                        {{__('portal.Display Company Name')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none"
                                                    required name="company_name_check" id="company_name_check">
                                                @if(isset($latest_rfq))
                                                    <option value="{{$latest_rfq->company_name_check}}">
                                                        @if($latest_rfq->company_name_check == 0)
                                                            {{__('portal.No')}}
                                                        @elseif($latest_rfq->company_name_check == 1)
                                                            {{__('portal.Yes')}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.Select')}}</option>
                                                    <option value="0">{{__('portal.No')}}</option>
                                                    <option value="1">{{__('portal.Yes')}}</option>
                                                @endif
                                            </select>
                                        </div>

                                        <br>
                                        {{__('portal.Payment Mode')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select class=" font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" name="payment_mode" id="payment_mode" required>
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
                                                    <option value="Cash">{{__('portal.Cash')}}</option>

                                                    @php
                                                        $package = \App\Models\BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
                                                    @endphp

                                                    @if($package->package_id != 1)
                                                        <option value="Credit">{{__('portal.Credit')}}</option>
                                                        <option value="Credit30days">{{__('portal.Credit (30 Days)')}}</option>
                                                        <option value="Credit60days">{{__('portal.Credit (60 Days)')}}</option>
                                                        <option value="Credit90days">{{__('portal.Credit (90 Days)')}}</option>
                                                        <option value="Credit120days">{{__('portal.Credit (120 Days)')}}</option>
                                                    @endif
                                                @endif

                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Required Sample')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
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
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="">{{__('portal.None')}}</option>
                                                    <option value="Yes">{{__('portal.Yes')}}</option>
                                                    <option value="No">{{__('portal.No')}}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <br>

                                        {{__('portal.Category')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
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

                                                <select name="item_name" class="font-bold h-10 pl-5 pr-3 bg-transparent hover:border-gray-400 focus:outline-none appearance-none" readonly>
                                                    <option value="{{$latest_rfq->item_code}}">{{$latest_rfq->item_name . ' - ' . $parent->name }}</option>
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
                                        <span class="font-bold text-lg color-1f3864">{{__('portal.Shipping Information')}}</span>
                                        <hr style="border-top: 1px solid gray;width: 25%;">
                                    </div>
                                    <div class="my-5 pl-5 ">
                                        {{__('portal.Warehouse Location')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
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
                                                        <option value="{{$warehouse->id}}">{{$warehouse->address }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <br>
                                        {{__('portal.Delivery Period')}}: @include('misc.required')
                                        <div class="relative inline-flex">
                                            <svg class="w-2 h-2 absolute top-0 right-0 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                                <path
                                                    d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </svg>
                                            <select
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
                                                    <option value="Standing Order - 2 per year">{{__('portal.Standing Order - 2 times / year')}}</option>
                                                    <option value="Standing Order - 3 per year">{{__('portal.Standing Order - 3 times / year')}}</option>
                                                    <option value="Standing Order - 4 per year">{{__('portal.Standing Order - 4 times / year')}}</option>
                                                    <option value="Standing Order - 6 per year">{{__('portal.Standing Order - 6 times / year')}}</option>
                                                    <option value="Standing Order - 12 per year">{{__('portal.Standing Order - 12 times / year')}}</option>
                                                    <option value="Standing Order Open">{{__('portal.Standing Order - Open')}}</option>
                                                @endif

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

                                <th style="width:3%;">#</th>
                                <th style="width:20%;">{{__('portal.Item Description')}} @include('misc.required')</th>
                                <th style="width:7%">{{__('portal.UOM')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Quantity')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Size')}} @include('misc.required')</th>
                                <th style="width:10%;">{{__('portal.Brand')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Last Unit Price')}} @include('misc.required')</th>
                                <th style="width:15%;"> {{__('portal.Shipment Remarks')}} @include('misc.required')</th>
                                <th style="width:7%;">{{__('portal.Attachments')}} @include('misc.required')</th>
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

                                    <td> {{ number_format($item->last_price, 2) }}</td>
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
                                          placeholder="{{__('portal.Enter Description..')}}" required></textarea>
                                    <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                                </td>
                                <td>
                                    <div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-1.5 mt-4 pointer-events-none" style="width: 8px; height: 8px;"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#000000" fill-rule="nonzero"/>
                                        </svg>
                                        <select
                                            class="form-input rounded-md shadow-sm  w-full  pl-5 pr-3  appearance-none uom"
                                            required name="unit_of_measurement" id="unit_of_measurement" style="max-height:35px;">
                                            <option value="">{{__('portal.None')}}</option>
                                            @foreach (\App\Models\UnitMeasurement::all() as $item)
                                                <option value="{{$item->uom_en}}">{{$item->uom_en}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                                           name="quantity" min="0" autocomplete="quantity" required placeholder="{{__('portal.Qty')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text" name="size"
                                           min="0" placeholder="{{__('portal.Size')}}">
                                </td>
                                <td>
                                    <input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text"
                                           name="brand" min="0" autocomplete="brand" placeholder="{{__('portal.Brand')}}">
                                </td>

                                <td>
                                    <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                                           name="last_price" min="0" autocomplete="last_price" placeholder="{{__('portal.Price')}}">
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
                                    class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.ADD ITEM')}}
                            </button>


                            <a href="{{route('single_cart_index')}}"
                               class="inline-flex items-center add-more  px-4 mr-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 text-center">
                                {{__('portal.Requisitions Cart')}}
                            </a>
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

</script>
