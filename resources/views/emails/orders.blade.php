@component('mail::message')
# Introduction

<h2 class="font-bold text-xl text-blue-800 leading-tight">
    Welcome {{ $user->gender == "Male" ?'Mr. ' . $user->name: 'Mrs. '. $user->name}}
    <br>
    Account Status: {{(isset($user->status) == 1)?'Under process':'InComplete'}}
</h2>

<div class="mt-6 text-black text-2xl">
    <div class="text-2xl text-center font-bold">
        Business: {{$business->business_name}}<br>
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

Thanks,<br>
{{ config('app.name') }}
@endcomponent
