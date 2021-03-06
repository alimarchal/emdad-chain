<select class="sel_2 w-full inline" name="item_name[]" required>
    <option value="">None</option>
</select>
<script>
    var mydata = [
        @include('category.sub_category_list', ['categories' => $parentCategories])
    ];
    $(".sel_2").select2ToTree({
        treeData: {
            dataArr: mydata
        },
        maximumSelectionLength: 10
    });

</script>
