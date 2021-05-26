<ul class="list-decimal ml-6">
    @foreach ($categories as $category)

        <li><a @if(auth()->user()->hasRole('SuperAdmin')) href="{{route('category.edit',$category->id)}}" @endif class="text-blue-900 hover:text-red-900 hover:underline">
                {{ $category->name . ' - ' . $category->name_ar . ' - ' .  $category->name_ur }}</a>

            --
{{--            @php $count = \App\Models\BusinessCategory::where('category_number', $category->id)->count(); @endphp--}}
{{--            <a @if($count > 0) class="text-green-600 hover:underline" href="{{route('categoryRelatedBusiness', encrypt($category->id))}}"  @else class="text-red-600 hover:underline" style="cursor: no-drop" @endif > Registered Businesses {{$count}} </a>--}}
            @php
                    $businessCategorires = \App\Models\BusinessCategory::where('category_number', $category->id)->get()->pluck('business_id');

                    $buyerBusinesses = \App\Models\Business::whereIn('id', $businessCategorires)->where('business_type', 'Buyer')->count();
                    $supplierBusinesses = \App\Models\Business::whereIn('id', $businessCategorires)->where('business_type', 'Supplier')->count();
            @endphp
            <a @if(count($businessCategorires) > 0) class="text-green-600 hover:underline" href="{{route('categoryRelatedBusiness', encrypt($category->id))}}"  @else class="text-red-600 hover:underline" style="cursor: no-drop" @endif >

                Buyer Businesses  -- {{$buyerBusinesses}} --
                Supplier Businesses {{$supplierBusinesses}}

            </a>


            --
            @php
                $RFQCounts = \App\Models\EOrderItems::where(['item_code' => $category->id, 'bypass' => 0])->where( 'quotation_time', '>=', \Carbon\Carbon::now())->get();
            @endphp
            <a @if(count($RFQCounts) > 0) class="text-green-600 hover:underline" href="{{route('activeRFQs', encrypt($category->id))}}"  @else class="text-red-600 hover:underline" style="cursor: no-drop" @endif >
                Active RFQs {{count($RFQCounts)}} </a>

            @if(auth()->user()->hasRole('SuperAdmin'))
                --
            <form class="inline" method="POST" action="{{ route('category.destroy', $category->id) }}">@csrf @method('delete')
                <input type="submit"  onclick="clicked(event)"  class="text-blue-800 hover:underline bg-white" value="Delete*" style="cursor: pointer">
            </form>
            @endif

        </li>
        @if (count($category->subcategory))
            @include('manageChild',['categories' => $category->subcategory])
        @endif
    @endforeach
</ul>
