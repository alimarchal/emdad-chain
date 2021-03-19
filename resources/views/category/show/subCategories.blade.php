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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h2 class="text-2xl font-bold text-center">Categories with sub categories</h2>

                    @include('category.show.manageChild',['categories' => $category])
                    <div class="flex justify-end">
                        <a href="{{ route('parentCategories') }}" class="inline-flex px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
