@role('CEO')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

    {{-- Message Before and After Resistration --}}
    @if(Auth::user()->status == 0 || Auth::user()->status == null )
        <div class="text-black text-2xl">

            @if (auth()->user()->rtl == 0)
                <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto mb-4 m-auto"/>
                Thank you for signing up! Your email address has been verified.
            @php
                $isBusinessDataExist = \App\Models\Business::where('user_id', Auth::user()->id)->first();
                if ($isBusinessDataExist) {
                    $isBusinessWarehouseDataExist = \App\Models\BusinessWarehouse::where('business_id', $isBusinessDataExist->id)->first();
                    $isBusinessPOIExist = \App\Models\POInfo::where('business_id', $isBusinessDataExist->id)->first();
                }
            @endphp
                <br>Now you need to fill up the
                @if(is_null($isBusinessDataExist))
                    business
                @elseif(is_null($isBusinessWarehouseDataExist))
                    warehouse
                @elseif(is_null($isBusinessPOIExist))
                    P.O. Info
                @endif
                registration form  before adding any user/s.
            @else
                <img src="{{url('registration_step/E-2.png')}}" alt="User Registration" class="block w-auto mb-4 m-auto"/>
                نشكرك لتسجيلك معنا
                !
                تم تفعيل بريدك الإلكتروني بنجاح. <br>
                بإمكانك الآن تعبئة بيانات استمارة نشاطك التجاري قبل إضافة أي من المستخدمين.
            @endif
        </div>
    @elseif(Auth::user()->status == 1 && Auth::user()->registration_type == "Buyer")

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            @if (auth()->user()->rtl == 0)

                Welcome {{ auth()->user()->gender == "Male" ?'Mr. ' . Auth::user()->name: 'Mrs.'. Auth::user()->name}}

                <span class="float-right text-red-900 font-bold">{{(isset(Auth::user()->status) == 1)?'Under process':'InComplete'}}</span>
                <span class=" float-right text-black-600 font-bold">Account Status:&nbsp;&nbsp;</span>
                <img src="{{url('registration_step/E-3.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
            @else
                مرحباً {{ auth()->user()->gender == "Male" ?'Mr. ' . Auth::user()->name: 'Mrs.'. Auth::user()->name}}

                <span class="float-left text-red-900 font-bold">{{(isset(Auth::user()->status) == 1)?'Under process':'InComplete'}}</span>
                <span class=" float-left text-black-600 font-bold">حالة الحساب:&nbsp;&nbsp;</span>

                <img src="{{url('registration_step/E-3.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
            @endif

        </h2>
        <div class="mt-6 text-black text-2xl">

            @if (auth()->user()->rtl == 0)
                <div class="text-2xl text-center font-bold">
                    Business: {{ Auth::user()->business->business_name }}<br>
                </div>
                <p class="m-2 font-bold">Welcome {{ config('app.name', 'Laravel') }} as our prospective alliance</p>
                <p class="font-bold m-2 text-justify">Thank you for choosing us to share our experience and expertise in supply chain management platform.</p>
                <p class="text-blue-900 font-bold m-2 text-justify">At the moment your application is under review. You will receive a reply from us within 10 working days.</p>
                <p class="m-2">Hopefully, soon we will be sharing with you the power of our platform which could;</p>
                <ol class="list-decimal ml-12 text-indigo-900 font-bold">
                    <li>Save you a huge amount depending on the size of your purchases.</li>
                    <li>Help to solve the bottlenecks involved in the supply chain.</li>
                    <li>Streamline the return system (for defective or unwanted products).</li>
                </ol>
            @else
                <div class="text-2xl text-center font-bold">
                    النشاط التجاري: {{ Auth::user()->business->business_name }}<br>

                    <img src="{{url('registration_step/E-3.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>

                </div>
                <p class="m-2 font-bold">مرحباً {{ config('app.name', 'Laravel') }} as our prospective alliance</p>
                <p class="font-bold m-2 text-justify">Thank you for choosing us to share our experience and expertise in supply chain management platform.</p>
                <p class="text-blue-900 font-bold m-2 text-justify">At the moment your application is under review. You will receive a reply from us within 10 working days.</p>
                <p class="m-2">Hopefully, soon we will be sharing with you the power of our platform which could;</p>
                <ol class="list-decimal ml-12 text-indigo-900 font-bold">
                    <li>Save you a huge amount depending on the size of your purchases.</li>
                    <li>Help to solve the bottlenecks involved in the supply chain.</li>
                    <li>Streamline the return system (for defective or unwanted products).</li>
                </ol>
            @endif
        </div>





    @elseif(Auth::user()->status == 1 && Auth::user()->registration_type == "Supplier")
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome {{ auth()->user()->gender == "Male" ?'Mr. ' . Auth::user()->name: 'Mrs.'. Auth::user()->name}}

            <span class="float-right text-red-900 font-bold">{{(isset(Auth::user()->status) == 1)?'Under process':'InComplete'}}</span>
            <span class=" float-right text-black-600 font-bold">Account Status:&nbsp;&nbsp;</span>
            <img src="{{url('registration_step/E-3.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>
        </h2>
        <div class="mt-6 text-black text-2xl">
            <div class="text-2xl text-center font-bold">
                Business: {{ Auth::user()->business->business_name }}<br>
            </div>
            <p class="m-2 font-bold">Welcome {{ config('app.name', 'Laravel') }} as our prospective alliance</p>
            <p class="font-bold m-2 text-justify">Thank you for choosing us to share our experience and expertise in supply chain management platform.</p>
            <p class="text-blue-900 font-bold m-2 text-justify">At the moment your application is under review. You will receive a reply from us.</p>
            <p class="m-2">Hopefully, soon we will be sharing with you the power of our platform which could;</p>
            <ol class="list-decimal ml-12 text-indigo-900 font-bold">
                <li>Bring you more business volume.</li>
                <li>Streamline your suppliers.</li>
                <li>Bring down cost of production and time.</li>
                <li>Help to solve the bottlenecks involved in the supply chain.</li>
            </ol>
        </div>
    @elseif (Auth::user()->status == 'Approved')
        <h1>Business is Approved</h1>
    @elseif (Auth::user()->status == 'Rejected')
        <h1>Your Business is rejected</h1>
    @endif

    @if(is_null(Auth::user()->registration_type))
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1 mt-4">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        <a href="#">
                            @if (auth()->user()->rtl == 0)
                                Please select your registration type
                            @else
                                رجاءً قم باختيار نوع التسجيل
                            @endif
                        </a>
                    </div>
                </div>

                @if(is_null(Auth::user()->registration_type))
                    <div class="ml-12">
                        <div class="mt-2 text-sm text-gray-500">
{{--                            <img src="{{url('registration_step/E-3.png')}}" alt="User Registration" class="block w-auto my-2 m-auto"/>--}}
                            <form action="{{url('registrationType')}}" method="post">
                                @csrf
                                <select id="registration_type" name="registration_type" class="border p-2 w-full" required>
                                    @if (auth()->user()->rtl == 0)
                                        <option value="">None</option>
                                    @else
                                        <option value="">لم يتم التحديد</option>
                                    @endif
                                    @if (auth()->user()->rtl == 0)
                                        <option value="Buyer">Buyer</option>
                                        <option value="Supplier">Supplier</option>
                                    @else
                                        <option value="Buyer">مشتري</option>
                                        <option value="Supplier">مورّد</option>
                                    @endif
                                </select>
                                <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                                @if (auth()->user()->rtl == 0)
                                    <input type="submit" value="Proceed" class="text-white p-2 float-right rounded mt-4" style="background-color: #144ab8;">
                                @else
                                    <input type="submit" value="متابعة" class="text-white p-2 float-right rounded mt-4" style="background-color: #144ab8;">
                                @endif
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

</div>
@endrole
