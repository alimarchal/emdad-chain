<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
{{--<link href="https://bootswatch.com/cosmo/bootstrap.min.css" rel="stylesheet" type="text/css">--}}
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{url('treeviewdata/hummingbird-treeview.css')}}" rel="stylesheet" type="text/css">



<div class="container">
    <div id="treeview_container" class="hummingbird-treeview well h-scroll-large">

        <ul id="treeview" class="hummingbird-base">
            @foreach($parentCategories as $parent)
                <li>
                    <i class="fa fa-plus"></i> <label> <input type="checkbox">{{$parent->name}}</label>
                    @if(count($parent->subcategory))
                        @include('category.sub_category_list',['subcategories' => $parent->subcategory])
                    @endif
                </li>
            @endforeach
        </ul>

    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="{{url('treeviewdata/hummingbird-treeview.js')}}"></script>
<script>
    $("#treeview").hummingbird();
    $("#checkAll").click(function () {
        $("#treeview").hummingbird("checkAll");
    });
    $("#uncheckAll").click(function () {
        $("#treeview").hummingbird("uncheckAll");
    });
    $("#collapseAll").click(function () {
        $("#treeview").hummingbird("collapseAll");
    });
    $("#checkNode").click(function () {
        $("#treeview").hummingbird("checkNode", {attr: "id", name: "node-0-2-2", expandParents: false});
    });
</script>
