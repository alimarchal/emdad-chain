@section('headerScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        {{-- <h2 class="text-2xl font-bold py-2 text-center m-15">Items List @if (!$collection->count()) seems empty @endif
        </h2> --}}
        <div class="flex space-x-5 mt-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <form action="{{ route('role.store') }}" method="post" class="form bg-white p-6" enctype="multipart/form-data">
            @csrf
            {{-- @method('PUT') --}}

            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Add a Role')}}</h3>
            <p class="text-gray-600">{{__('portal.Role name')}}</p>

            <div class="flex space-x-5 mt-3">
                <input type="text" name="name" id="" class="border p-2 w-full">

                {{--            <input type="text" placeholder="Guard Name, Web" name="guard_name" id="" class="border p-2 w-1/2" value="web" hidden>--}}
            </div>

            <p class="text-gray-600" style="margin-top:10px">{{__('portal.Permissions')}}</p>

            <div class="flex space-x-5 mt-3">
                <select class="w-full inline js-example-basic-multiple" multiple="multiple" name="permissions[]" required>
                    @foreach($permissions as $permission)
                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                    class="inline-flex items-center  justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150"
                    style="margin-top: 15px;">{{__('portal.Create new role')}}</button>

        </form>


        <div class="mt-5 float-right">
            <a href="{{ route('role.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                {{__('portal.Back')}}
            </a>
            <a href="{{ route('role.create') }}" style="background-color: #145EA8"
               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                {{__('portal.Add new Role')}}
            </a>
        </div>

        <div class="mt-5">

        </div>

    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('User List') }} </h2>
        </x-slot>

        @if (session()->has('message'))
            <div class="block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">{{ session('message') }}</strong>
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        {{-- <h2 class="text-2xl font-bold py-2 text-center m-15">Items List @if (!$collection->count()) seems empty @endif
        </h2> --}}
        <div class="flex space-x-5 mt-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <form action="{{ route('role.store') }}" method="post" class="form bg-white p-6" enctype="multipart/form-data">
            @csrf
            {{-- @method('PUT') --}}

            <h3 class="text-2xl text-gray-900 font-semibold text-center">{{__('portal.Add a Role')}}</h3>
            <p class="text-gray-600">{{__('portal.Role name')}}</p>

            <div class="flex space-x-5 mt-3">
                <input type="text" name="name" id="" class="border p-2 w-full">

                {{--            <input type="text" placeholder="Guard Name, Web" name="guard_name" id="" class="border p-2 w-1/2" value="web" hidden>--}}
            </div>

            <p class="text-gray-600" style="margin-top:10px">{{__('portal.Permissions')}}</p>

            <div class="flex space-x-5 mt-3">
                <select class="w-full inline js-example-basic-multiple" multiple="multiple" name="permissions[]" required>
                    @foreach($permissions as $permission)
                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                    class="inline-flex items-center  justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150"
                    style="margin-top: 15px;">{{__('portal.Create new role')}}</button>

        </form>


        <div class="mt-5 float-left">
            <a href="{{ route('role.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                {{__('portal.Back')}}
            </a>
            <a href="{{ route('role.create') }}" style="background-color: #145EA8"
               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 hover:text-white focus:outline-none active:bg-red-600 transition ease-in-out duration-150">
                {{__('portal.Add new Role')}}
            </a>
        </div>

        <div class="mt-5">

        </div>

    </x-app-layout>
@endif

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
