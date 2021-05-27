@section('headerScripts')
    <style>
        body {
            font-family: Helvetica, sans-serif;
            font-size: 15px;
        }

        a {
            text-decoration: none;
        }

        ul.tree,
        .tree li {
            list-style: none;
            margin: 0;
            padding: 0;
            cursor: pointer;
        }

        .tree ul {
            display: none;
        }

        .tree>li {
            display: block;
            background: #eee;
            margin-bottom: 2px;
        }

        .tree span {
            display: block;
            padding: 10px 12px;

        }

        .icon {
            display: inline-block;
        }

        .tree .hasChildren>.expanded {
            background: #999;
        }

        .tree .hasChildren>.expanded a {
            color: #fff;
        }

        .icon:before {
            content: "+";
            display: inline-block;
            min-width: 20px;
            text-align: center;
        }

        .tree .icon.expanded:before {
            content: "-";
        }

        .show-effect {
            display: block !important;
        }

    </style>
@endsection

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
                    <h2 class="text-2xl font-bold text-center">All Categories</h2>
                    <h3 class="text-2xl text-blue-600">Category -- Registered Buyers -- Registered Suppliers -- Active RFQs</h3>
                    <x-jet-validation-errors class="mb-4" />

                    @if (session('message'))
                        <div class="mb-4 font-medium text-sm text-red-600 text-2xl">
                            {{ session('message') }}
                        </div>
                    @endif

                    @include('manageChild',['categories' => $category])
                    <script>
                        function clicked(e) {
                            if (!confirm('Do you want to delete?')) {
                                e.preventDefault();
                            }
                        }

                    </script>
                    <div class="flex justify-end">
                        <a href="{{ route('category.create') }}" class="inline-flex px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
