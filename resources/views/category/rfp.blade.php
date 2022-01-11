<select class="sel_1 w-full inline" name="item_name" @if(Route::currentRouteName() != 'eCartItemEdit' || Route::currentRouteName() != 'singleCategoryECartItemEdit') required @endif style="width: 100%;">
    <option value="">{{__('portal.Select Category')}}</option>
</select>
<script>
    var mydata = [
        @include('category.sub_category_list', ['categories' => $parentCategories])
    ];
    $(".sel_1").select2ToTree({
        treeData: {
            dataArr: mydata
        },
        maximumSelectionLength: 10
    });

</script>
