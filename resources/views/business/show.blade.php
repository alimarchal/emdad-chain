@section('headerScripts')
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
@endsection
@if (auth()->user()->rtl == 0)
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Business Information') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
{{--                @if (session()->has('error'))--}}
{{--                    <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">--}}
{{--                        <strong class="mr-1">{{ session('error') }}</strong>--}}
{{--                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">--}}
{{--                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-green-900" aria-hidden="true">×</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                @endif--}}

                @php $businessCertificate = \App\Models\BusinessUpdateCertificate::where('business_id', auth()->user()->business_id)->first(); @endphp
                @if(isset($businessCertificate))
                    <div class="text-center text-red-600 mr-5">
                        <span class="text-center text-red-600 mr-5">{{__('portal.Approval for New Uploaded Certificate(s) is pending')}}</span>
                    </div>
                @endif

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6">
                        <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> {{__('portal.Business Information')}}<br>{{$business->business_name}}</h1>
                        <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center border-2 border-t-0 border-cool-gray-700">
                            <div class="flex flex-wrap overflow-hidden">

                                {{-- Reterving Business PO Info --}}
                                @php $po = \App\Models\POInfo::where('business_id', $business->id)->first(); @endphp
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3  h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Name')}}:</strong> {{$business->business_name}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    @php $warehouseCount = \App\Models\BusinessWarehouse::where('business_id', $business->id)->count(); @endphp
                                    <p><strong>{{__('portal.Total Warehouse(s)')}}:</strong> {{$warehouseCount}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.CEO Name')}}:</strong> {{$business->user->name}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Commercial Reg No')}}:</strong> {{$business->chamber_reg_number}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Country')}}:</strong> {{$business->country}}</p>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.CEO Email')}}:</strong> {{$business->user->email}} </p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.City')}}:</strong> {{$business->city}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Address')}}:</strong> {{$business->address}}</p>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.IBAN No')}}:</strong> {{$business->iban}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <a href="{{(isset($business->vat_reg_certificate_path)?Storage::url($business->vat_reg_certificate_path):'#')}}" class="text-blue-600 visited:text-purple-600" target="blank">{{(isset($business->vat_reg_certificate_path)? __('portal.Vat certificate') : __('portal.Not Uploaded') )}}</a>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <a href="{{(isset($business->chamber_reg_path)?Storage::url($business->chamber_reg_path):'#')}}" class="text-blue-600 visited:text-purple-600" target="blank">{{(isset($business->chamber_reg_path)? __('portal.Commercial Registration Certificate') : __('portal.Not Uploaded') )}}</a>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.ID No')}}:</strong> {{$business->user->nid_num}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <a href="{{(isset($business->business_photo_url)?Storage::url($business->business_photo_url):'#')}}" class="text-blue-600 visited:text-purple-600" target="blank">{{(isset($business->business_photo_url)? __('portal.Business Logo') : __('portal.Not Uploaded') )}}</a>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.VAT Number')}}:</strong> {{$business->vat_reg_certificate_number}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 min-h-16 text-lg text-black mb-2">
                                    @if(isset($business->user->nid_photo) && $business->user->nid_photo != null)
                                        <a href="{{(isset($business->user->nid_photo)?Storage::url($business->user->nid_photo):'#')}}" class="text-blue-600 visited:text-purple-600" target="blank">{{(isset($business->user->nid_photo)? __('portal.National ID Card Photo') : __('portal.Not Uploaded') )}}</a>
                                    @else
                                        <span class="text-red-600 text-sm">{{__('portal.Upload National ID Photo')}}: </span>
                                        <a class="text-blue-600 visited:text-purple-600 py-1">
                                            <div class="flex">
                                                <form action="{{route('nationalIdCardPhoto', $business->user->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="flex-1 md:float-left w-2/5 p-2">
                                                        <input name="nid_photo" class="text-xs" type="file" required/>
                                                    </div>
                                                    <div class="flex-1 md:float-right w-2/5 p-2">
                                                        <button type="submit"
                                                                class="text-xs bg-green-600 border border-transparent rounded-md text-white text-uppercase hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                            {{__('portal.Click to Upload')}}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </a>
                                    @endif
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Bank Name')}}:</strong> {{$business->bank_name}}</p>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Website')}}:</strong> {{$business->website}}</p>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Business Email')}}:</strong> {{$business->business_email}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Phone')}}:</strong> {{$business->phone}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Mobile')}}:</strong> {{$business->mobile}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Supplier/Client')}}:</strong>
{{--                                        {{$business->user->registration_type ?? ''}}--}}
                                        @if(isset($business->user->registration_type))
                                            @if($business->user->registration_type == 'Buyer') {{__('portal.Buyer')}}
                                            @elseif($business->user->registration_type == 'Supplier') {{__('portal.Supplier')}}
                                            @else {{__('portal.N/A')}}
                                            @endif
                                        @endif
                                    </p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Latitude')}}:</strong> {{$business->latitude}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Longitude')}}:</strong> {{$business->longitude}}</p>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Total No of Monthly Order')}}:</strong> {{(isset($po->no_of_monthly_orders) ? $po->no_of_monthly_orders : 'N/A') }}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Volume')}}: </strong> {{(isset($po->volume) ? $po->volume : 'N/A')}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Type')}}: </strong>
{{--                                        {{(isset($po->type) ? $po->type : 'N/A')}}--}}
                                        @if(isset($po->type))  @if($po->type == 'Cash') {{__('portal.Cash')}} @elseif($po->type == 'Credit')  {{__('portal.Credit')}} @else {{$po->type}} @endif @endif
                                    </p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Orders Information Pictures')}}: </strong></p>
                                    <ol class="list-decimal">
                                        @if(!empty($po))
                                            @php $exp = explode(', ', $po->order_info); @endphp
                                            @if($po->order_info != null)
                                                @foreach($exp as $ex)
                                                    <li><a href="{{asset('storage/'.$ex)}}" class="hover:text-blue-900 hover:underline text-blue-900">{{__('portal.Image')}}#{{$loop->iteration}} ({{__('portal.Click to show')}})</a></li>
                                                @endforeach
                                            @else
                                                {{__('portal.N/A')}}
                                            @endif
                                        @endif
                                    </ol>
                                </div>


                                <div class="w-full lg:w-1/3 xl:w-1/2 h-auto mt-2 text-lg text-black">
                                    <p><strong>{{__('portal.Category(s) selected')}}:</strong><br>
                                        @if(auth()->user()->registration_type == 'Supplier')

                                            @php $cat = explode(',',$business->category_number); @endphp

                                            @foreach($cat as $c)
                                                @php
                                                    $catg = \App\Models\Category::find($c);
                                                    $parent= \App\Models\Category::where('id',$catg->parent_id)->first();
                                                @endphp
                                                @if ($catg != '')
                                                    {{$loop->iteration . ': ' . $catg->name . ', ' . $parent->name }} <br>
                                                @else
                                                    {{ "There is no category yet !" }}
                                                @endif
                                            @endforeach

                                        @elseif(auth()->user()->registration_type == 'Buyer')

                                            @php $cat = explode(',',$business->businessPackage->categories); @endphp

                                            @foreach($cat as $c)
                                                @php
                                                    $category = \App\Models\Category::find($c);
                                                    $children = \App\Models\Category::where('parent_id',$category->id)->get();
                                                @endphp
                                                @if ($category != '')
                                                        {{$loop->iteration . ': ' . $category->name }}
                                                    @if(count($children) > 0)
                                                        @include('business.sub_categories', compact('children'))
                                                    @endif
                                                @else
                                                    {{ "There is no category yet !" }}
                                                @endif
                                            @endforeach

                                        @endif
                                    </p>
                                </div>

                                <div class="w-full overflow-hidden">

                                    @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('SC Specialist'))
                                        <a href="{{route('business.edit',$business->id)}}"
                                           class="float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                            {{__('portal.Edit')}}
                                        </a>

                                    @endif

                                    <a href="javascript:void (0)" onclick="window.print();"
                                       class="mr-3 float-right inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:shadow-outline-yellow disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Print')}}
                                    </a>

                                    <a href="{{url()->previous()}}" style="background-color: #145EA8"
                                       class="mr-3 float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Back')}}
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


            </div>


        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Business Information') }} </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('users.sessionMessage')
                {{--@if (session()->has('error'))
                    <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-3">{{ session('error') }}</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-green-900" aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif--}}

                @php $businessCertificate = \App\Models\BusinessUpdateCertificate::where('business_id', auth()->user()->business_id)->first(); @endphp
                @if(isset($businessCertificate))
                    <div class="text-center text-red-600 mr-5">
                        <span class="text-center text-red-600 mr-5">{{__('portal.Approval for New Uploaded Certificate(s) is pending')}}</span>
                    </div>
                @endif

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-0 bg-white sm:p-6">
                        <h1 class="text-center text-3xl font-bold p-4 border-t-2 bg-opacity-5 border-black border-2"> {{__('portal.Business Information')}}<br>{{$business->business_name}}</h1>
                        <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center border-2 border-t-0 border-cool-gray-700">
                            <div class="flex flex-wrap overflow-hidden">

                                {{-- Reterving Business PO Info --}}
                                @php $po = \App\Models\POInfo::where('business_id', $business->id)->first(); @endphp
                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3  h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Name')}}:</strong> {{$business->business_name}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    @php $warehouseCount = \App\Models\BusinessWarehouse::where('business_id', $business->id)->count(); @endphp
                                    <p><strong>{{__('portal.Total Warehouse(s)')}}:</strong> {{$warehouseCount}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.CEO Name')}}:</strong> {{$business->user->name}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Commercial Reg No')}}:</strong> {{$business->chamber_reg_number}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Country')}}:</strong> {{$business->country}}</p>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.CEO Email')}}:</strong> {{$business->user->email}} </p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.City')}}:</strong>
                                        @php $cityArabicName = \App\Models\City::where('name_en', $business->city)->pluck('name_ar')->first(); @endphp
                                        {{$cityArabicName}}
                                    </p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Address')}}:</strong> {{$business->address}}</p>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.IBAN No')}}:</strong> {{$business->iban}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <a href="{{(isset($business->vat_reg_certificate_path)?Storage::url($business->vat_reg_certificate_path):'#')}}" class="text-blue-600 visited:text-purple-600" target="blank">{{(isset($business->vat_reg_certificate_path)? __('portal.Vat certificate') : __('portal.Not Uploaded') )}}</a>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <a href="{{(isset($business->chamber_reg_path)?Storage::url($business->chamber_reg_path):'#')}}" class="text-blue-600 visited:text-purple-600" target="blank">{{(isset($business->chamber_reg_path)? __('portal.Commercial Registration Certificate') : __('portal.Not Uploaded') )}}</a>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.ID No')}}:</strong> {{$business->user->nid_num}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <a href="{{(isset($business->business_photo_url)?Storage::url($business->business_photo_url):'#')}}" class="text-blue-600 visited:text-purple-600" target="blank">{{(isset($business->business_photo_url)? __('portal.Business Logo') : __('portal.Not Uploaded') )}}</a>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.VAT Number')}}:</strong> {{$business->vat_reg_certificate_number}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 min-h-16 text-lg text-black mb-2">
                                    @if(isset($business->user->nid_photo) && $business->user->nid_photo != null)
                                        <a href="{{(isset($business->user->nid_photo)?Storage::url($business->user->nid_photo):'#')}}" class="text-blue-600 visited:text-purple-600" target="blank">{{(isset($business->user->nid_photo)? __('portal.National ID Card Photo') : __('portal.Not Uploaded') )}}</a>
                                    @else
                                        <span class="text-red-600 text-sm">{{__('portal.Upload National ID Photo')}}: </span>
                                        <a class="text-blue-600 visited:text-purple-600 py-1">
                                            <div class="flex">
                                                <form action="{{route('nationalIdCardPhoto', $business->user->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="flex-1 md:float-left w-2/5 p-2">
                                                        <input name="nid_photo" class="text-xs" type="file" required/>
                                                    </div>
                                                    <div class="flex-1 md:float-right w-2/5 p-2">
                                                        <button type="submit"
                                                                class="text-xs bg-green-600 border border-transparent rounded-md text-white text-uppercase hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                                                            {{__('portal.Click to Upload')}}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </a>
                                    @endif
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Bank Name')}}:</strong>
                                        @php $bankName = \App\Models\Bank::where('name', $business->bank_name)->pluck('ar_name')->first(); @endphp
                                        {{$bankName}}
                                    </p>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Website')}}:</strong> {{$business->website}}</p>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Business Email')}}:</strong> {{$business->business_email}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Phone')}}:</strong> {{$business->phone}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Mobile')}}:</strong> {{$business->mobile}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Supplier/Client')}}:</strong>
                                        @if(isset($business->user->registration_type))
                                            @if($business->user->registration_type == 'Buyer') {{__('portal.Buyer')}}
                                            @elseif($business->user->registration_type == 'Supplier') {{__('portal.Supplier')}}
                                            @else {{__('portal.N/A')}}
                                            @endif
                                        @endif
                                    </p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Latitude')}}:</strong> {{$business->latitude}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Longitude')}}:</strong> {{$business->longitude}}</p>
                                </div>

                                <div class="w-full overflow-hidden mb-2 lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Total No of Monthly Order')}}:</strong> {{(isset($po->no_of_monthly_orders) ? $po->no_of_monthly_orders : 'N/A') }}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Volume')}}: </strong> {{(isset($po->volume) ? $po->volume : 'N/A')}}</p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Type')}}: </strong>
{{--                                        {{(isset($po->type) ? $po->type : 'N/A')}}--}}
                                        @if(isset($po->type))  @if($po->type == 'Cash') {{__('portal.Cash')}} @elseif($po->type == 'Credit')  {{__('portal.Credit')}} @else {{$po->type}} @endif @endif
                                    </p>
                                </div>

                                <div class="w-full overflow-hidden lg:w-1/3 xl:w-1/3 h-12 text-lg text-black">
                                    <p><strong>{{__('portal.Orders Information Pictures')}}: </strong></p>
                                    <ol class="list-decimal">
                                        @if(!empty($po))
                                            @php $exp = explode(', ', $po->order_info); @endphp
                                            @if($po->order_info != null)
                                                @foreach($exp as $ex)
                                                    <li><a href="{{asset('storage/'.$ex)}}" class="hover:text-blue-900 hover:underline text-blue-900">{{__('portal.Image')}}#{{$loop->iteration}} ({{__('portal.Click to show')}})</a></li>
                                                @endforeach
                                            @else
                                                {{__('portal.N/A')}}
                                            @endif
                                        @endif
                                    </ol>
                                </div>


                                <div class="w-full lg:w-1/3 xl:w-1/2 h-auto mt-2 text-lg text-black">
                                    <p><strong>{{__('portal.Category(s) selected')}}:</strong><br>
                                        @if(auth()->user()->registration_type == 'Supplier')

                                            @php $cat = explode(',',$business->category_number); @endphp

                                            @foreach($cat as $c)
                                                @php
                                                    $catg = \App\Models\Category::find($c);
                                                    $parent= \App\Models\Category::where('id',$catg->parent_id)->first();
                                                @endphp
                                                @if ($catg != '')
                                                    {{$loop->iteration . ': ' . $catg->name . ', ' . $parent->name }} <br>
                                                @else
                                                    {{ "There is no category yet !" }}
                                                @endif
                                            @endforeach

                                        @elseif(auth()->user()->registration_type == 'Buyer')

                                            @php $cat = explode(',',$business->businessPackage->categories); @endphp

                                            @foreach($cat as $c)
                                                @php
                                                    $category = \App\Models\Category::find($c);
                                                    $children = \App\Models\Category::where('parent_id',$category->id)->get();
                                                @endphp
                                                @if ($category != '')
                                                     <span class="font-sans">{{$loop->iteration}}</span> : {{$category->name_ar }}
                                                    @if(count($children) > 0)
                                                        @include('business.sub_categories', compact('children'))
                                                    @endif
                                                @else
                                                    {{ "There is no category yet !" }}
                                                @endif
                                            @endforeach

                                        @endif
                                    </p>
                                </div>

                                <div class="w-full overflow-hidden">

                                    @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('SC Specialist'))
                                        <a href="{{route('business.edit',$business->id)}}"
                                           class="mr-3 float-left inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                            {{__('portal.Edit')}}
                                        </a>
                                    @endif

                                    <a href="javascript:void (0)" onclick="window.print();"
                                       class="mr-3 float-left inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 hover:text-white active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:shadow-outline-yellow disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Print')}}
                                    </a>

                                    <a href="{{url()->previous()}}" style="background-color: #145EA8"
                                       class="mr-3 float-left inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        {{__('portal.Back')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
