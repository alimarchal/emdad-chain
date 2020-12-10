<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }} Mr.
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('users.sessionMessage')
            <!-- component -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action="{{ route('businessFinanceDetail.store') }}" method="post" class="form bg-white p-6 mb-4" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Step # 2: Business Finance Information</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="business_id">Business Name</x-jet-label>
                            <x-jet-label class="w-1/2" for="designation">Designation</x-jet-label>
                            <x-jet-label class="w-1/2" for="name">Name</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <select name="business_id" id="business_id" class="form-input rounded-md shadow-sm border p-2 w-1/2" required>
                                <option value="">None</option>
                                @foreach($business as $biz)
                                    <option value="{{$biz->id}}" selected>{{$biz->business_name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input id="business_id" type="text" min="1" name="designation" class="border p-2 w-1/2"></x-jet-input>
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
                        <x-jet-button class="float-right mt-4 mb-4">Skip</x-jet-button>
                        <x-jet-button class="float-right mt-4 mb-4 mr-4">Save & Next</x-jet-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
