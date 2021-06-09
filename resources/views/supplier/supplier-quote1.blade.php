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
                    Warehouse Location: Lorem, ipsum. <br>
                    Delivery Period: Lorem, ipsum. <br>
                </div>
            </div>
    </div>
  

    <div class="p4 mb-5 overflow-x-auto">


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


                <tr>
                    <td>
                        Lorem, ipsum.

                    </td>
                    <td>
                        Lorem, ipsum.
                    </td>
                    <td>
                        Lorem, ipsum.
                    </td>
                    <td>
                        Lorem, ipsum.
                    </td>
                    <td>
                        Lorem, ipsum.
                    </td>

                    <td> Lorem, ipsum.</td>
                    <td>
                        Lorem, ipsum.
                    </td>
                    <td class="">
                        Lorem, ipsum.

                    </td>

                </tr>


                <tr>

                    <td>
                        <div class="w-full overflow-hidden">
                            Lorem, ipsum.
                        </div>
                    </td>
                    <td>
                        <textarea name="description" id="description" class="w-full description rounded-md shadow-sm"
                            maxlength="254" placeholder="Enter Description.." required></textarea>
                        <input type="hidden" value="{{ auth()->user()->business_id }}" name="business_id">
                        <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                    </td>
                    <td>
                        <input class="form-input rounded-md shadow-sm  w-full" id="quantity" type="number"
                            name="quantity" min="0" autocomplete="quantity" required placeholder="Qty">
                    </td>
                    <td>
                        <input class="form-input rounded-md shadow-sm  w-full" id="size" type="text" name="size" min="0"
                            placeholder="Size">
                    </td>
                    <td> <input class="form-input rounded-md shadow-sm  w-full" id="brand" type="text" name="brand"
                            min="0" autocomplete="brand" placeholder="Brand"></td>

                    <td>
                        <input class="form-input rounded-md shadow-sm w-full" id="last_price" type="number"
                            name="last_price" min="0" autocomplete="last_price" placeholder="Price">
                    </td>

                    <td>
                        <input class="form-input rounded-md shadow-sm  w-full" id="remarks" name="remarks" type="text"
                            autocomplete="remarks" placeholder="Remarks">
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
