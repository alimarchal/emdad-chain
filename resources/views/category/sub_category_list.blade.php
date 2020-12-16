{{--<ul>--}}
{{--    @foreach($subcategories as $subcategory)--}}
{{--        <li>--}}
{{--            <i class="fa {{count($subcategory->subcategory)?'fa-plus':'fa-minus'}}"></i>--}}
{{--            <label>--}}
{{--                <input type="checkbox" class=" {{count($subcategory->subcategory)?'hummingbirdNoParent':''}}"> {{$subcategory->name}}--}}
{{--            </label>--}}
{{--            @if(count($subcategory->subcategory))--}}
{{--                @include('category.sub_category_list',['subcategories' => $subcategory->subcategory])--}}
{{--            @endif--}}
{{--        </li>--}}
{{--    @endforeach--}}
{{--</ul>--}}


@foreach($categories as $cate)
    {
        id: {{$cate->id}},
        title: "{{$cate->name . ' - ' . $cate->id}}",
        @if(count($cate->subcategory))
            subs: [@include('category.sub_category_list',['categories' => $cate->subcategory])]
        @endif
    },
@endforeach
