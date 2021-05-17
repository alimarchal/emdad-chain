@extends('ire.english.layout.app')
@section('headerScripts')
@endsection
@section('body')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            @if($errors->any())
                <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    @if($errors->first('current_password'))<li><strong class="mr-1"> Current password did not match </strong></li> @endif
                    @if($errors->first('password'))<li><strong class="mr-1"> Password not confirmed</strong></li> @endif
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action="{{route('adminPercentageStore')}}" method="POST" class="form bg-white p-6  mb-4" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Change Password</h3>
                        <div class="flex space-x-5 mt-3">
                            <x-jet-label class="w-1/2" for="current_password">Current Password</x-jet-label>
                            <x-jet-label class="w-1/2" for="password">New Password</x-jet-label>
                            <x-jet-label class="w-1/2" for="password_confirmation">Confirm Password</x-jet-label>
                        </div>
                        <div class="flex space-x-5 mt-3" required>
                            <x-jet-input id="current_password" type="text" name="current_password" class="border p-2 w-1/2" value="{{ old('current_password') }}" step="1" min="1" placeholder="Enter Current Password" ></x-jet-input>
                            <x-jet-input id="password" type="text" name="password" class="border p-2 w-1/2" value="{{ old('password') }}" step="1" min="1" placeholder="Enter password" ></x-jet-input>
                            <x-jet-input id="percentage" type="text" name="password_confirmation" class="border p-2 w-1/2" value="{{ old('password_confirmation') }}" step="0.01" min="1" placeholder="Confirm Password" ></x-jet-input>
                        </div>
                        <br>

                        <x-jet-button class="float-right mt-4 mb-4">Create</x-jet-button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection


