<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h2 class="text-2xl font-bold text-center">Create Library</h2>
                    <x-jet-validation-errors class="mb-4"/>

                    @if (session('message'))
                        <div class="mb-4 font-medium text-sm text-red-600 text-2xl">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('library.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 gap-6">

                            <div class="col-span-12">

                                <label class="block font-medium text-sm text-gray-700 mt-4" for="title">
                                    Title of Video
                                </label>
                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="title" type="text" name="title" required>

                                <label class="block font-medium text-sm text-gray-700 mt-4" for="url">
                                    Video URL
                                </label>
                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="url" type="text" name="url" required>



                                <label class="block font-medium text-sm text-gray-700 mt-4" for="attachment_url_1">
                                    Attachment (File PDF, DOCX)
                                </label>
                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="attachment_url" type="file" name="attachment_url_1">


                                <div class="flex flex-wrap overflow-hidden">

                                    <div class="w-1/3 overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="language">
                                            Language
                                        </label>
                                    </div>

                                    <div class="w-1/3 overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="user_type">
                                            User Type
                                        </label>
                                    </div>

                                    <div class="w-1/3 overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <label class="block font-medium text-sm text-gray-700 mt-4" for="order">
                                            Sort Order
                                        </label>
                                    </div>

                                    <div class="w-1/3 overflow-hidden lg:w-1/3 xl:w-1/3">

                                        <select id="language" name="language" class="form-input rounded-md shadow-sm mt-1 w-full" required>
                                            <option value="">None</option>
                                            <option value="Arabic">Arabic</option>
                                            <option value="English">English</option>
                                            <option value="Urdu">Urdu</option>
                                        </select>
                                    </div>

                                    <div class="w-1/3 overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <select id="user_type" name="user_type" class="form-input rounded-md shadow-sm mt-1 w-full" required>
                                            <option value="">None</option>
                                            <option value="Buyer">Buyer</option>
                                            <option value="Supplier">Supplier</option>
                                        </select>
                                    </div>

                                    <div class="w-1/3 overflow-hidden lg:w-1/3 xl:w-1/3">
                                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="order" type="number" name="order" min="1" required>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                {{__('portal.Create')}}
                            </button>
                        </div>
                    </form>


                    <hr class="m-4">

                    <div class="flex justify-end">
                        <a href="{{ route('library.index') }}"
                           class="inline-flex px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            {{__('portal.Show all')}}
                            <SMS></SMS>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
