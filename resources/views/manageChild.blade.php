<ul class="list-disc ml-6">
    @foreach ($categories as $category)
    <li><a href="#" class="text-blue-900 hover:text-red-900 hover:underline">{{$category->name . ' - ' . $category->name_ar}}</a> -- 
        <form class="inline" method="POST" action="{{route('category.destroy',$category->id)}}">@csrf @method('delete')
            <input type="submit" class="text-orange-900 hover:underline bg-white" value="Delete*">
        </form>
            </li>
    @if (count($category->subcategory))
        @include('manageChild',['categories' => $category->subcategory])
    @endif
@endforeach
</ul>

