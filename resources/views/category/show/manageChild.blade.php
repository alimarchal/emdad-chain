<ul class="list-decimal ml-6">
    @foreach ($categories as $category)
        <li>
            <span class="text-blue-900 hover:text-red-900">{{ $category->name . ' - ' . $category->name_ar . ' - ' .  $category->name_ur }} </span>
        </li>
        @if (count($category->subcategory))
            @include('category.show.manageChild',['categories' => $category->subcategory])
        @endif
    @endforeach
</ul>
