@role('CEO')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

    {{-- Message Before and After Resistration --}}
    @if(Auth::user()->status == 0 || Auth::user()->status == null)
        <div class="mt-6 text-red-500 text-2xl">
            Thank you for signing up! Your email address has been verified.
            <br>Now you need to fill up the registration form, before adding any user/s.
        </div>
    @elseif(Auth::user()->status == 1 && Auth::user()->registration_type == "Contracts")
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome {{ auth()->user()->gender == "Male" ?'Mr. ' . Auth::user()->name: 'Mrs.'. Auth::user()->name}}

            <span class="float-right text-red-900 font-bold">{{(isset(Auth::user()->status) == 1)?'Under process':'InComplete'}}</span>
            <span class=" float-right text-black-600 font-bold">Account Status:&nbsp;&nbsp;</span>

        </h2>
        <div class="mt-6 text-black text-2xl">
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
        </div>
    @elseif(Auth::user()->status == 1 && Auth::user()->registration_type == "Orders")
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome {{ auth()->user()->gender == "Male" ?'Mr. ' . Auth::user()->name: 'Mrs.'. Auth::user()->name}}

            <span class="float-right text-red-900 font-bold">{{(isset(Auth::user()->status) == 1)?'Under process':'InComplete'}}</span>
            <span class=" float-right text-black-600 font-bold">Account Status:&nbsp;&nbsp;</span>

        </h2>
        <div class="mt-6 text-black text-2xl">
            <div class="text-2xl text-center font-bold">
                Business: {{ Auth::user()->business->business_name }}<br>
            </div>
            <p class="m-2 font-bold">Welcome {{ config('app.name', 'Laravel') }} as our prospective alliance</p>
            <p class="font-bold m-2 text-justify">Thank you for choosing us to share our experience and expertise in supply chain management platform.</p>
            <p class="text-blue-900 font-bold m-2 text-justify">At the moment your application is under review. You will receive a reply from us within 10 working days.</p>
            <p class="m-2">Hopefully, soon we will be sharing with you the power of our platform which could;</p>
            <ol class="list-decimal ml-12 text-indigo-900 font-bold">
                <li>Bring you more business volume.</li>
                <li>Streamline your suppliers.</li>
                <li>Bring down cost of production and time.</li>
                <li>Help to solve the bottlenecks involved in the supply chain.</li>
            </ol>
        </div>
    @endif

    @if(is_null(Auth::user()->registration_type))
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1 mt-4">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="#">Please select your registration
                            type</a>
                    </div>
                </div>

                @if(is_null(Auth::user()->registration_type))
                    <div class="ml-12">
                        <div class="mt-2 text-sm text-gray-500">
                            <form action="{{url('registrationType')}}" method="post">
                                @csrf
                                <select id="registration_type" name="registration_type" class="border p-2 w-full" required>
                                    <option value="">None</option>
                                    <option value="Contracts">Contracts</option>
                                    <option value="Orders">Orders</option>
                                </select>
                                <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                                <input type="submit" value="Proceed" class="text-white p-2 float-right rounded mt-4"
                                       style="background-color: #144ab8;">
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif


</div>
@endrole
