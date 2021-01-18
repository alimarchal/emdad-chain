<ul class="nested">
    @foreach ($categories as $category)
    <li><span class="caret">{{$category->id}}</span></li>
    @if (count($category->subcategory))
        @include('manageChild',['categories' => $category->subcategory])
    @endif
@endforeach
</ul>

