<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }} Mr. {{$user->name}}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- component -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-0 bg-white sm:p-6 rounded-sm">
                    <form action="{{ url('users'). '/' . $user->id }}"  method="post" class="form bg-white p-6" enctype="multipart/form-data">
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
                        <h3 class="text-2xl text-gray-900 font-semibold text-center">Mr. {{$user->name}} Profile Information</h3>
                        <p class="text-gray-600">Business Name</p>

                        <div class="flex float-right border-red-300">
                            <img class="h-10 w-10 rounded-full" src="{{ (empty($user->profile_photo_path))?Storage::url("images.png"): Storage::url($user->profile_photo_path)}}" alt="Profile Picture">
                        </div>
                        <select id="business_id" name="business_id" class="border p-2  w-1/2">
                            <option value="">None</option>
                            @foreach($business as $biz)
                                <option value="{{$biz->id}}" {{($user->business_id == $biz->id)?'selected':''}}>{{$biz->business_name}} - {{$user->business_id}}</option>
                            @endforeach
                        </select>
                        <div class="flex space-x-5 mt-3">
                            <label class="w-1/2">Name</label>
                            <label class="w-1/2">Designation</label>
                            <label class="w-1/2">Email</label>
                            <label class="w-1/2">Email Verified At</label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <input type="text" name="name" id="" placeholder="Name" class="border p-2 w-1/2" value="{{$user->name}}">
                            <input type="text" name="designation" id="" placeholder="Designation" class="border p-2 w-1/2" value="{{$user->designation}}">
                            <input type="text" name="email" id="email" placeholder="Email" class="border p-2 w-1/2" value="{{$user->email}}">
                            <input type="text" name="email_verified_at" id="email_verified_at" placeholder="Email Verified At" class="border p-2 w-1/2" value="{{$user->email_verified_at}}" readonly>
                        </div>
                        <div class="flex space-x-5 mt-4">
                            <label class="w-1/2">Registration Type</label>
                            <label class="w-1/2">Profile Approved</label>
                            <label class="w-1/2">Profile Approval ID</label>
                            <label class="w-1/2">Mobile Number</label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <input type="text" name="registration_type" id="" placeholder="Registration Type" class="border p-2 w-1/2" value="{{$user->registration_type}}">
                            <select id="profile_approved" name="profile_approved" class="border p-2  w-1/2">
                                <option value="1" {{($user->profile_approved == 1)?'selected':''}}>Yes</option>
                                <option value="0" {{($user->profile_approved == 0)?'selected':''}}>No</option>
                            </select>
                            <input type="text" name="profile_approval_id" id="profile_approval_id" placeholder="Profile Approved" class="border p-2 w-1/2" value="{{$user->profile_approval_id}}">
                            <input type="text" name="mobile" id="mobile" placeholder="Mobile" class="border p-2 w-1/2" value="{{$user->mobile}}">
                        </div>

                        <div class="flex space-x-5 mt-4">
                            <label class="w-1/2">Active/In-Active</label>
                            <label class="w-1/2">Profile Picture</label>
                        </div>
                        <div class="flex space-x-5 mt-3">
                            <select id="is_active" name="is_active" class="border p-2  w-1/2">
                                <option value="1" {{($user->is_active == 1)?'selected':''}}>Active</option>
                                <option value="0" {{($user->is_active == 0)?'selected':''}}>In-Active</option>
                            </select>
                            <input type="file" name="img" id="" class="border p-2 w-1/2" multiple>
                        </div>
                        <button class="text-white bg-red-500 border-0 py-2 px-6 mt-4 float-right mb-4 focus:outline-none hover:bg-red-600 rounded text-lg">Update</button>
                        <a href="{{route('users.index')}}" class="text-white bg-green-500 border-0 py-2 px-6 mt-4 float-right mb-4 focus:outline-none hover:bg-green-600 rounded text-lg mr-2">Back</a>

                    </form>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
