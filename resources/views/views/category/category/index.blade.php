<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
<link href="select2/src/select2totree.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="select2/src/select2totree.js"></script>
<form method="post" action="test">
    @csrf
<select id="sel_1" style="width:32em" multiple name="category[]">
</select>
    <input type="submit">
    </form>
<script>
    var mydata = [

        @include('category.category.sub_category_list',['categories' => $parentCategories])
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
    $("#sel_1").select2ToTree({treeData: {dataArr: mydata}, maximumSelectionLength: 100});
</script>