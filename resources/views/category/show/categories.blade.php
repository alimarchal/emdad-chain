<x-app-layout>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="{{ url('select2/src/select2totree.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ url('select2/src/select2totree.js') }}"></script>
    <style>
        .select2-container--default .select2-results>.select2-results__options {
            max-height: 350px;
            overflow-y: auto;
        }

    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - Welcome
            {{ auth()->user()->gender == 'Male' ? 'Mr. ' . Auth::user()->name : 'Mrs.' . Auth::user()->name }}

            <span class="float-right text-red-900 font-bold">{{ isset(Auth::user()->status) == 1 ? 'Under process' : 'InComplete' }}</span>
            <span class=" float-right text-black-600 font-bold">Account Status:&nbsp;&nbsp;</span>

        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h2 class="text-2xl font-bold text-center">Categories</h2>
                    <x-jet-validation-errors class="mb-4" />

                    @if (session('message'))
                        <div class="mb-4 font-medium text-sm text-red-600 text-2xl">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{route('updatePackageCategories')}}" method="post">
                        @csrf
                        <input type="hidden" name="business_id" value="{{$businessPackage->id}}">
                        <div class="grid grid-cols-12 gap-6">

                            <div class="col-span-12">
                                <label class="block font-medium text-sm text-gray-700 mb-3" for="parent_category">
                                    Select Category
                                </label>
                                <select id="sel_1" class="w-full inline" name="category_id[]" multiple required>
                                    @foreach ($parentCategories as $cate)
                                        <option value="{{ $cate->id }}">{{ strtoupper($cate->name) }} - {{ $cate->name_ar }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        &nbsp;
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-Blue-600 transition ease-in-out duration-150">
                                Submit
                            </button>
                        </div>
                    </form>


                    <hr class="m-4">

                    <div class="flex justify-start">
                        <a href="{{ route('subCategories') }}" class="inline-flex px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            show all Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@php
    $businessPackage = \App\Models\BusinessPackage::where('user_id', auth()->id())->first();
    $categories = \App\Models\Package::where('id', $businessPackage->package_id)->first();
@endphp

@if($categories->package_type == 'Basic')

    <script>
    $("#sel_1").select2ToTree({
        maximumSelectionLength: 1
    });
    </script>

@elseif($categories->package_type == 'Silver')

    <script>
    $("#sel_1").select2ToTree({
        maximumSelectionLength: 2
    });
    </script>

@elseif($categories->package_type == 'Gold')

    <script>
    $("#sel_1").select2ToTree({
        maximumSelectionLength: 3
    });
    </script>

@elseif($categories->package_type == 'Platinum')

    <script>
    $("#sel_1").select2ToTree({
        maximumSelectionLength: 5
    });
    </script>

@endif


