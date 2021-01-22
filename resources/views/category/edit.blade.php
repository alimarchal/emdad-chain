<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h2 class="text-2xl font-bold text-center">Edit Category</h2>
                    <x-jet-validation-errors class="mb-4" />

                    @if (session('message'))
                        <div class="mb-4 font-medium text-sm text-red-600 text-2xl">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('category.update',$category->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 gap-6">

                            <div class="col-span-12">
                                <label class="block font-medium text-sm text-gray-700 mb-3" for="parent_category">
                                    Current parent category
                                </label>

                                <input class="form-input mb-3 rounded-md shadow-sm mt-1 block w-full" id="name_ar" value="@if(!empty(\App\Models\Category::where('id', $category->parent_id)->first()->name)){{ \App\Models\Category::where('id', $category->parent_id)->first()->name . ' - ' . \App\Models\Category::where('id', $category->parent_id)->first()->name_ar }}@else Main @endif" disabled>
                                <label class="block font-medium text-sm text-gray-700 mb-3" for="parent_category">
                                    Change parent category (leave blank if you do not want to change)
                                </label>
                                @include('category.edit.edit')
                                <label class="block font-medium text-sm text-gray-700 mt-4" for="name">
                                    Category Name English
                                </label>
                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" type="text" name="name" required value="{{ $category->name }}">

                                <label class="block font-medium text-sm text-gray-700 mt-4" style="direction: rtl;" for="name_ar">
                                    اسم التصنيف بالعربي
                                </label>
                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name_ar" style="direction: rtl;" type="text" name="name_ar" required value="{{ $category->name_ar }}">

                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Update
                            </button>

                            <a href="{{route('showAllCategory')}}"
                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Cancel
                            </a>
                        </div>
                    </form>


                    <hr class="m-4">

                    <div class="flex justify-end">
                        <a href="{{ url('category/show') }}"
                            class="inline-flex px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            show all Categoriess
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
