@foreach($categories as $cate)
    {
        id: {{$cate->id}},
        title: "{{$cate->name . ' - ' . $cate->id}}",
        @if(count($cate->subcategory))
            subs: [@include('category.sub_category_list',['categories' => $cate->subcategory])]
        @endif
    },
@endforeach
