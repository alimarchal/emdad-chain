<select class="sel_1 w-full inline" name="item_name" required style="width: 100%;">
    <option value="">None</option>
</select>
<script>
    var mydata = [
        @include('category.sub_category_list', ['categories' => $parentCategories])
    ];
    $(".sel_1").select2ToTree({
        treeData: {
            dataArr: mydata
        },
        maximumSelectionLength: 100
    });

</script>
