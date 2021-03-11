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

<select id="sel_1" class="w-full inline" name="parent_id" required>
    <option value="">None</option>
    <option value="0">Main Parent</option>
</select>

<script>
    var mydata = [

        @include('category.adminCategory', ['categories' => $parentCategories])
    ];
    $("#sel_1").select2ToTree({
        treeData: {
            dataArr: mydata
        },
        maximumSelectionLength: 25
    });

</script>
