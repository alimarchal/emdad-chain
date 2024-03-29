<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
<link href="{{ url('select2/src/select2totree.css') }}" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{ url('select2/src/select2totree.js') }}"></script>
{{-- <form method="post" action="test"> --}}
{{-- @csrf --}}
<style>
    .select2-container--default .select2-results>.select2-results__options {
        max-height: 350px;
        overflow-y: auto;
    }

</style>
<select id="sel_1" class="form-input rounded-md shadow-sm border p-2 w-1/2" style="width: 100%;" multiple name="category[]" @if(Route::currentRouteName() == 'business.create') required @endif >

</select>
<script>
    var mydata = [

        @include('category.category.sub_category_list', ['categories' => $parentCategories])
        // {id:1, text:"USA", inc:[
        //         {text:"west", inc:[
        //                 {id:111, text:"California", inc:[
        //                         {id:1111, text:"Los Angeles", inc:[
        //                                 {id:11111, text:"Hollywood"}
        //                             ]},
        //                         {id:1112, text:"San Diego"}
        //                     ]},
        //                 {id:112, text:"Oregon"}
        //             ]}
        //     ]},
        // {id:2, text:"India"},
        // {id:3, text:"中国"}
    ];


    // console.log(mydata);
    @if(auth()->user()->registration_type == 'Buyer')
        @if(count($categories) == 1)
        $("#sel_1").select2ToTree({
            treeData: {
                dataArr: mydata
            },
            maximumSelectionLength: 5
        });
        @elseif(count($categories) > 1 || count($categories) <= 3)
        $("#sel_1").select2ToTree({
            treeData: {
                dataArr: mydata
            },
            maximumSelectionLength: 15
        });
        @elseif(count($categories) > 3 || count($categories) <= 5)
        $("#sel_1").select2ToTree({
            treeData: {
                dataArr: mydata
            },
            maximumSelectionLength: 50
        });
        @endif

    @elseif(auth()->user()->registration_type == 'Supplier')
        $("#sel_1").select2ToTree({
            treeData: {
                dataArr: mydata
            },
            // maximumSelectionLength: 25
        });

        /* Adding below conditions for Super Admin can update User's Categories/Business */
    @elseif(auth()->user()->hasRole('SuperAdmin') && $businessPackage->business_type == 1)
            @if(count($categories) == 1)
            $("#sel_1").select2ToTree({
                treeData: {
                    dataArr: mydata
                },
                maximumSelectionLength: 5
            });
            @elseif(count($categories) > 1 || count($categories) <= 3)
            $("#sel_1").select2ToTree({
                treeData: {
                    dataArr: mydata
                },
                maximumSelectionLength: 15
            });
            @elseif(count($categories) > 3 || count($categories) <= 5)
            $("#sel_1").select2ToTree({
                treeData: {
                    dataArr: mydata
                },
                maximumSelectionLength: 50
            });
        @endif

    @elseif(auth()->user()->hasRole('SuperAdmin') && $businessPackage->business_type == 2)
            $("#sel_1").select2ToTree({
            treeData: {
                dataArr: mydata
            },
            // maximumSelectionLength: 25
        });
    @endif

</script>
