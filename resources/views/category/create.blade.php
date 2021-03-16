<x-app-layout>
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
                    <h2 class="text-2xl font-bold text-center">Create Categories</h2>
                    <x-jet-validation-errors class="mb-4" />

                    @if (session('message'))
                        <div class="mb-4 font-medium text-sm text-red-600 text-2xl">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="grid grid-cols-12 gap-6">

                            <div class="col-span-12">
                                <label class="block font-medium text-sm text-gray-700 mb-3" for="parent_category">
                                    Select Parent Category
                                </label>
                                @include('category.adminCategoryIndex')

                                <label class="block font-medium text-sm text-gray-700 mt-4" for="name">
                                    Category Name English
                                </label>
                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" type="text" name="name" required>

                                <label class="block font-medium text-sm text-gray-700 mt-4" style="direction: rtl;" for="name_ar">
                                    اسم التصنيف بالعربي
                                </label>
                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name_ar" style="direction: rtl;" type="text" name="name_ar" required>

                                <label class="block font-medium text-sm text-gray-700 mt-4" style="direction: rtl;" for="name_ur">
                                    قسم کا نام (اردو)
                                </label>
                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name_ar" style="direction: rtl;" type="text" name="name_ur" required>

                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Create
                            </button>
                        </div>
                    </form>


                    <hr class="m-4">

                    <div class="flex justify-end">
                        <a href="{{ url('category/show') }}" class="inline-flex px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            show all Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
