<div>
    <nav class="flex flex-col sm:flex-row mt-4">
        <button wire:click="show('tab1')" class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none
        {{($tab1 == "")?$border:''}}
        font-medium">
        Business Details <img src="{{url('complete_check.jpg')}}" class="w-5 inline">
        </button>
        <button wire:click="show('tab2')" class=" {{($tab2 == "")?$border:''}} text-gray-600 py-4 px-6 block hover:text-blue-500
         focus:outline-none">
            Business Finance Details
        </button>
        <button wire:click="show('tab3')" class=" {{($tab3 == "")?$border:''}} text-gray-600 py-4 px-6 block
        hover:text-blue-500 focus:outline-none">
            Business Warehouse
        </button>
    </nav>

    <div class="content mt-1">
        <div id="tabs1" class="p-2 bg-gray-100 rounded-lg {{$tab1}}">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action=""  method="post" class="form bg-white p-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if (session()->has('message'))
                            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                                <strong class="mr-1">{{ session('message') }}</strong>
                                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                                </button>
                            </div>
                        @endif
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Business Information</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="business_name">Business Name</x-jet-label>
                            <x-jet-label class="w-1/2" for="num_of_warehouse">Number of Warehouse</x-jet-label>
                            <x-jet-label class="w-1/2" for="business_type">Type of Business</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="business_name" type="text" name="business_name" class="border p-2
                            w-1/2"></x-jet-input>
                            <x-jet-input id="num_of_warehouse" type="number" min="1" name="num_of_warehouse" class="border p-2
                            w-1/2"></x-jet-input>
                            <x-jet-input id="business_type" type="text"  name="business_type" class="border p-2 w-1/2"></x-jet-input>
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

                            <x-jet-input id="chamber_reg_path" type="file" name="chamber_reg_path" class="border p-2
                            w-1/2"></x-jet-input>
                            <x-jet-input id="vat_reg_certificate_number" type="text"  name="vat_reg_certificate_number" class="border p-2 w-1/2"></x-jet-input>
                        </div>


                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="vat_reg_certificate_path">VAT Certificate (If
                                available)</x-jet-label>

                            <x-jet-label class="w-1/2" for="country">Country</x-jet-label>
                            <x-jet-label class="w-1/2" for="city">City
                            </x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="vat_reg_certificate_path" type="file" name="vat_reg_certificate_path"
                                         class="border p-2
                            w-1/2"></x-jet-input>
                            <select name="country" id="country" class="form-input rounded-md shadow-sm border p-2 w-1/2">
                                <option value="">None</option>
                                <option value="">Pakistan</option>
                            </select>
                            <x-jet-input id="city" type="text"  name="city" class="border p-2
                            w-1/2"></x-jet-input>
                        </div>


                        <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>

                    </form>
                </div>


            </div>
        </div>

        <div id="tabs2" class="p-2 bg-gray-100 rounded-bl-sm rounded-br-sm rounded-tr-lg {{$tab2}}">
            <p>Tabl 2Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ullamcorper, justo non pharetra pulvinar,
                risus dui fringilla ante, a auctor dolor massa sed ipsum. Donec vulputate tellus sed tempor lobortis. Fusce a turpis sit amet mauris fermentum mattis vitae sed metus. Sed auctor diam eget finibus convallis.</p>
        </div>

        <div id="tabs3" class="p-2 bg-gray-100 rounded-bl-sm rounded-br-sm rounded-tr-lg {{$tab3}}">
            <p> Tab 2 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ullamcorper, justo non pharetra pulvinar,
                risus dui fringilla ante, a auctor dolor massa sed ipsum. Donec vulputate tellus sed tempor lobortis. Fusce a turpis sit amet mauris fermentum mattis vitae sed metus. Sed auctor diam eget finibus convallis.</p>
        </div>
    </div>

</div>
