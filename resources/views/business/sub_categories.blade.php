@if(auth()->user()->rtl == 0)
    @foreach($children as $child)
        <ul style="margin-left: 30px;">
            <li> {{$loop->iteration}}: {{$child->name}}</li>
            @php $children = \App\Models\Category::where('parent_id',$child->id)->get(); @endphp
            @if(count($children) > 0)
                @include('business.sub_categories', compact('children'))
            @endif
        </ul>
    @endforeach
@else
    @foreach($children as $child)
        <ul style="margin-right: 30px;">
            <li> <span class="font-sans">{{$loop->iteration}}</span> : {{$child->name_ar}}</li>
            @php $children = \App\Models\Category::where('parent_id',$child->id)->get(); @endphp
            @if(count($children) > 0)
                @include('business.sub_categories', compact('children'))
            @endif
        </ul>
    @endforeach
@endif
