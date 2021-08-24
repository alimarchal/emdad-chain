@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h2 class="text-2xl font-bold text-center">{{__('portal.Create SMS')}}</h2>
                        <x-jet-validation-errors class="mb-4"/>

                        @if (session('message'))
                            <div class="mb-4 font-medium text-sm text-red-600 text-2xl">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form action="{{ route('smsMessages.update',$smsMessages->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-12 gap-6">

                                <div class="col-span-12">
                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="category">
                                        {{__('portal.Category')}}
                                    </label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{$smsMessages->category}}" id="category" type="text" name="category" required>

                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="arabic_message">
                                        {{__('portal.Arabic Message')}}
                                    </label>
                                    <textarea class="form-input rounded-md shadow-sm mt-1 block w-full" style="direction: rtl;" id="arabic_message" type="text" name="arabic_message" required>{{$smsMessages->arabic_message}}</textarea>

                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="english_message">
                                        {{__('portal.English Message')}}
                                    </label>
                                    <textarea class="form-input rounded-md shadow-sm mt-1 block w-full" id="english_message" type="text" name="english_message" required>{{$smsMessages->english_message}}</textarea>

                                </div>
                            </div>

                            <div class="mt-5">
                                <button type="submit"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    {{__('portal.Update')}}
                                </button>
                            </div>
                        </form>


                        <hr class="m-4">

                        <div class="flex justify-end">
                            <a href="{{ route('smsMessages.index') }}"
                               class="inline-flex px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                {{__('portal.Cancel')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h2 class="text-2xl font-bold text-center">{{__('portal.Create SMS')}}</h2>
                        <x-jet-validation-errors class="mb-4"/>

                        @if (session('message'))
                            <div class="mb-4 font-medium text-sm text-red-600 text-2xl">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form action="{{ route('smsMessages.update',$smsMessages->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-12 gap-6">

                                <div class="col-span-12">
                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="category">
                                        {{__('portal.Category')}}
                                    </label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{$smsMessages->category}}" id="category" type="text" name="category" required>

                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="arabic_message">
                                        {{__('portal.Arabic Message')}}
                                    </label>
                                    <textarea class="form-input rounded-md shadow-sm mt-1 block w-full" style="direction: rtl;" id="arabic_message" type="text" name="arabic_message" required>{{$smsMessages->arabic_message}}</textarea>

                                    <label class="block font-medium text-sm text-gray-700 mt-4" for="english_message">
                                        {{__('portal.English Message')}}
                                    </label>
                                    <textarea class="form-input rounded-md shadow-sm mt-1 block w-full" id="english_message" type="text" name="english_message" required>{{$smsMessages->english_message}}</textarea>

                                </div>
                            </div>

                            <div class="mt-5">
                                <button type="submit"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    {{__('portal.Update')}}
                                </button>
                            </div>
                        </form>


                        <hr class="m-4">

                        <div class="flex justify-end">
                            <a href="{{ route('smsMessages.index') }}"
                               class="inline-flex px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                {{__('portal.Cancel')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
