<div>
    <style>
        body {
            font-family: Arial;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }

    </style>
    @if (session()->has('message'))
        <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
            <strong class="mr-1">{{ session('message') }}</strong>
            <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <div class="tab flex flex-col sm:flex-row mt-4">
        <button class="tablinks" onclick="openCity(event, 'Business')" id="{{($business_tick == true)?'':'defaultOpen'}}">Business
            @if($business_tick == true)
                <img src="{{url('complete_check.jpg')}}" class="w-4 inline">
            @endif
        </button>
        <button class="tablinks" onclick="openCity(event, 'BusinessFinance')" id="{{($business_tick == true)?'defaultOpen':''}}">Finance</button>
        <button class="tablinks" onclick="openCity(event, 'BusinessWarehouse')">Business Warehouse</button>
        <button class="tablinks" onclick="openCity(event, 'LogisticDetail')">Logistic Detail</button>
    </div>

    <div id="Business" class="tabcontent">
        <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
            <form action="{{url('business')}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                @csrf
                <h3 class="text-2xl text-gray-900 font-semibold text-center">Business Information</h3>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="business_name">Business Name</x-jet-label>
                    <x-jet-label class="w-1/2" for="num_of_warehouse">Number of Warehouse</x-jet-label>
                    <x-jet-label class="w-1/2" for="business_type">Type of Business</x-jet-label>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="business_name" type="text" name="business_name" class="border p-2
                        w-1/2"></x-jet-input>
                    <x-jet-input id="num_of_warehouse" type="number" min="1" name="num_of_warehouse" class="border p-2
                        w-1/2"></x-jet-input>
                    <x-jet-input id="business_type" type="text" name="business_type" class="border p-2 w-1/2"></x-jet-input>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="chamber_reg_number">Chamber Registration Number</x-jet-label>
                    <x-jet-label class="w-1/2" for="chamber_reg_path">Chamber Certificate/File (If available)
                    </x-jet-label>
                    <x-jet-label class="w-1/2" for="vat_reg_certificate_number">VAT Number</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2
                        w-1/2"></x-jet-input>

                    <x-jet-input id="chamber_reg_path" type="file" name="chamber_reg_path_1" class="border p-2
                        w-1/2"></x-jet-input>
                    <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2"></x-jet-input>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="vat_reg_certificate_path">VAT Certificate (If available)</x-jet-label>
                    <x-jet-label class="w-1/2" for="website">Website</x-jet-label>
                    <x-jet-label class="w-1/2" for="business_email">Business Email</x-jet-label>
                    <x-jet-label class="w-1/2" for="supplier_client">Supplier/Client</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="vat_reg_certificate_path" type="file" name="vat_reg_certificate_path_2" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="website" name="website" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="supplier_client" type="text" name="supplier_client" class="border p-2 w-1/2"></x-jet-input>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="phone">Phone</x-jet-label>
                    <x-jet-label class="w-1/2" for="mobile">Mobile</x-jet-label>
                    <x-jet-label class="w-1/2" for="country">Country</x-jet-label>
                    <x-jet-label class="w-1/2" for="city">City</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="phone" type="text" name="phone" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="mobile" type="number" name="mobile" class="border p-2 w-1/2"></x-jet-input>
                    <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                        <option value="">None</option>
                        @foreach(\App\Models\User::countries() as $country)
                            <option value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                    <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2"></x-jet-input>
                </div>


                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="address">Address</x-jet-label>
                    <x-jet-label class="w-1/2" for="longitude">Longitude</x-jet-label>
                    <x-jet-label class="w-1/2" for="latitude">Latitude</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">

                    <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2"></textarea>
                    <x-jet-input id="longitude" type="text" name="longitude" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="latitude" type="text" name="latitude" class="border p-2 w-1/2"></x-jet-input>

                </div>


                <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>

            </form>
        </div>
    </div>

    <div id="BusinessFinance" class="tabcontent">
        <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
            <form action="{{url('business')}}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                @csrf
                <h3 class="text-2xl text-gray-900 font-semibold text-center">Business Finance Information</h3>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="business_name">Business Name</x-jet-label>
                    <x-jet-label class="w-1/2" for="designation">Designation</x-jet-label>
                    <x-jet-label class="w-1/2" for="name">Name</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="business_name" type="text" name="business_name" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="num_of_warehouse" type="text" min="1" name="designation" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="business_type" type="text" name="name" class="border p-2 w-1/2"></x-jet-input>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="landline">Landline</x-jet-label>
                    <x-jet-label class="w-1/2" for="mobile">Mobile</x-jet-label>
                    <x-jet-label class="w-1/2" for="bank_name">Bank Name</x-jet-label>
                    <x-jet-label class="w-1/2" for="iban">IBAN</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="landline" type="text" name="landline" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="mobile" type="text" name="mobile" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="bank_name" type="text" name="bank_name" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="iban" type="text" name="iban" class="border p-2 w-1/2"></x-jet-input>
                </div>
                <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>

            </form>
        </div>
    </div>

    <div id="BusinessWarehouse" class="tabcontent">
        <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
            <form action="{{url('business')}}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                @csrf
                <h3 class="text-2xl text-gray-900 font-semi-bold text-center">Business Finance Information</h3>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="business_name">Business Name</x-jet-label>
                    <x-jet-label class="w-1/2" for="num_of_warehouse">Number of Warehouse</x-jet-label>
                    <x-jet-label class="w-1/2" for="business_type">Type of Business</x-jet-label>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="business_name" type="text" name="business_name" class="border p-2
                        w-1/2"></x-jet-input>
                    <x-jet-input id="num_of_warehouse" type="number" min="1" name="num_of_warehouse" class="border p-2
                        w-1/2"></x-jet-input>
                    <x-jet-input id="business_type" type="text" name="business_type" class="border p-2 w-1/2"></x-jet-input>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="chamber_reg_number">Chamber Registration Number</x-jet-label>
                    <x-jet-label class="w-1/2" for="chamber_reg_path">Chamber Certificate/File (If available)
                    </x-jet-label>
                    <x-jet-label class="w-1/2" for="vat_reg_certificate_number">VAT Number</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2
                        w-1/2"></x-jet-input>

                    <x-jet-input id="chamber_reg_path" type="file" name="chamber_reg_path_1" class="border p-2
                        w-1/2"></x-jet-input>
                    <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2"></x-jet-input>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="vat_reg_certificate_path">VAT Certificate (If available)</x-jet-label>
                    <x-jet-label class="w-1/2" for="website">Website</x-jet-label>
                    <x-jet-label class="w-1/2" for="business_email">Business Email</x-jet-label>
                    <x-jet-label class="w-1/2" for="supplier_client">Supplier/Client</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="vat_reg_certificate_path" type="file" name="vat_reg_certificate_path_2" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="website" name="website" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="supplier_client" type="text" name="supplier_client" class="border p-2 w-1/2"></x-jet-input>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="phone">Phone</x-jet-label>
                    <x-jet-label class="w-1/2" for="mobile">Mobile</x-jet-label>
                    <x-jet-label class="w-1/2" for="country">Country</x-jet-label>
                    <x-jet-label class="w-1/2" for="city">City</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="phone" type="text" name="phone" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="mobile" type="number" name="mobile" class="border p-2 w-1/2"></x-jet-input>
                    <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                        <option value="">None</option>
                        @foreach(\App\Models\User::countries() as $country)
                            <option value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                    <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2"></x-jet-input>
                </div>


                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="address">Address</x-jet-label>
                    <x-jet-label class="w-1/2" for="longitude">Longitude</x-jet-label>
                    <x-jet-label class="w-1/2" for="latitude">Latitude</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">

                    <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2"></textarea>
                    <x-jet-input id="longitude" type="text" name="longitude" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="latitude" type="text" name="latitude" class="border p-2 w-1/2"></x-jet-input>

                </div>


                <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>

            </form>
        </div>
    </div>
    <div id="LogisticDetail" class="tabcontent">
        <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
            <form action="{{url('business')}}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                @csrf
                <h3 class="text-2xl text-gray-900 font-semi-bold text-center">Business Finance Information</h3>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="business_name">Business Name</x-jet-label>
                    <x-jet-label class="w-1/2" for="num_of_warehouse">Number of Warehouse</x-jet-label>
                    <x-jet-label class="w-1/2" for="business_type">Type of Business</x-jet-label>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="business_name" type="text" name="business_name" class="border p-2
                        w-1/2"></x-jet-input>
                    <x-jet-input id="num_of_warehouse" type="number" min="1" name="num_of_warehouse" class="border p-2
                        w-1/2"></x-jet-input>
                    <x-jet-input id="business_type" type="text" name="business_type" class="border p-2 w-1/2"></x-jet-input>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="chamber_reg_number">Chamber Registration Number</x-jet-label>
                    <x-jet-label class="w-1/2" for="chamber_reg_path">Chamber Certificate/File (If available)
                    </x-jet-label>
                    <x-jet-label class="w-1/2" for="vat_reg_certificate_number">VAT Number</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="chamber_reg_number" type="text" name="chamber_reg_number" class="border p-2
                        w-1/2"></x-jet-input>

                    <x-jet-input id="chamber_reg_path" type="file" name="chamber_reg_path_1" class="border p-2
                        w-1/2"></x-jet-input>
                    <x-jet-input id="vat_reg_certificate_number" type="text" name="vat_reg_certificate_number" class="border p-2 w-1/2"></x-jet-input>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="vat_reg_certificate_path">VAT Certificate (If available)</x-jet-label>
                    <x-jet-label class="w-1/2" for="website">Website</x-jet-label>
                    <x-jet-label class="w-1/2" for="business_email">Business Email</x-jet-label>
                    <x-jet-label class="w-1/2" for="supplier_client">Supplier/Client</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="vat_reg_certificate_path" type="file" name="vat_reg_certificate_path_2" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="website" name="website" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="business_email" type="email" name="business_email" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="supplier_client" type="text" name="supplier_client" class="border p-2 w-1/2"></x-jet-input>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="phone">Phone</x-jet-label>
                    <x-jet-label class="w-1/2" for="mobile">Mobile</x-jet-label>
                    <x-jet-label class="w-1/2" for="country">Country</x-jet-label>
                    <x-jet-label class="w-1/2" for="city">City</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">
                    <x-jet-input id="phone" type="text" name="phone" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="mobile" type="number" name="mobile" class="border p-2 w-1/2"></x-jet-input>
                    <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                        <option value="">None</option>
                        @foreach(\App\Models\User::countries() as $country)
                            <option value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                    <x-jet-input id="city" type="text" name="city" class="border p-2 w-1/2"></x-jet-input>
                </div>


                <div class="flex space-x-5 mt-3">
                    <x-jet-label class="w-1/2" for="address">Address</x-jet-label>
                    <x-jet-label class="w-1/2" for="longitude">Longitude</x-jet-label>
                    <x-jet-label class="w-1/2" for="latitude">Latitude</x-jet-label>
                </div>
                <div class="flex space-x-5 mt-3">

                    <textarea id="address" type="text" name="address" class="form-input rounded-md shadow-sm border p-2 w-1/2"></textarea>
                    <x-jet-input id="longitude" type="text" name="longitude" class="border p-2 w-1/2"></x-jet-input>
                    <x-jet-input id="latitude" type="text" name="latitude" class="border p-2 w-1/2"></x-jet-input>

                </div>


                <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>

            </form>
        </div>
    </div>
    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
</div>
