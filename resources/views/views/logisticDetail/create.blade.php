<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }} Mr.
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action="{{url('business')}}" method="post" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Order Details</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="no_of_drivers">Order No</x-jet-label>
                            <x-jet-label class="w-1/2" for="vehicle_types">Order Types</x-jet-label>
{{--                            <x-jet-label class="w-1/2" for="temperature_facility">Temperature Facility</x-jet-label>--}}
{{--                            <x-jet-label class="w-1/2" for="working_time">Working Time</x-jet-label>--}}
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-input id="no_of_drivers" type="text" name="business_name" class="border p-2 w-1/2"></x-jet-input>
                            <x-jet-input id="vehicle_types" type="number" min="1" name="num_of_warehouse" class="border p-2 w-1/2"></x-jet-input>
{{--                            <x-jet-input id="temperature_facility" type="text" name="business_type" class="border p-2 w-1/2"></x-jet-input>--}}
{{--                            <x-jet-input id="working_time" type="text" name="business_type" class="border p-2 w-1/2"></x-jet-input>--}}
                        </div>

                        <h2 class="text-2xl text-center mt-4">Under Construction.... Working.....</h2>
{{--                        <x-jet-button class="float-right mt-4 mb-4">Save & Next</x-jet-button>--}}

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
