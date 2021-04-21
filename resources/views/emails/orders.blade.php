@component('mail::message')

<h2 class="font-bold text-xl text-blue-800 leading-tight">
    Welcome {{ $user->gender == "Male" ?'Mr. ' . $user->name: 'Mrs. '. $user->name}}
    <br>
    Account Status: {{(isset($user->status) == 1)?'Under process':'InComplete'}}
</h2>

<div style="margin-top: 1.5rem; ">
    <div class="text-2xl text-center font-bold text-red-600">
        Business: {{$business->business_name}}<br>
    </div>
    <p class="m-2 font-bold">Welcome {{ config('app.name', 'Laravel') }} as our prospective alliance</p>
    <p class="font-bold m-2 text-justify">Thank you for choosing us to share our experience and expertise in supply chain management platform.</p>
    <p style="font-weight: bold; margin: 0.5em; text-align: justify; direction: rtl;">
        شريكنا العزيز، نرحب بك في منصة إمداد
    </p>
    <p style="font-weight: bold; margin: 0.5em; text-align: justify; direction: rtl;">
        نشكر لك اختيارنا لنشاركك خبرتنا في مجال إدارة  سلاسل الإمداد.
    </p>
    <p class="font-bold m-2 text-justify">
        At the moment your application is under review. You will receive a reply from us.
    </p>
    <p style="font-weight: bold; margin: 0.5em; text-align: justify; direction: rtl;">
        حتى اللحظة، لا يزال طلبك تحت المراجعة وستتلقى رداً منا فور انتهائه.
    </p>
    <p>
        Hopefully, soon we will be sharing with you the power of our platform which could;
    </p>
    <ol>
        <li>Bring you more business volume.</li>
        <li>Streamline your suppliers.</li>
        <li>Bring down cost of production and time.</li>
        <li>Help to solve the bottlenecks involved in the supply chain.</li>
    </ol>

{{--    <ol>--}}
{{--        <li> استقطاب المزيد من.</li>--}}
{{--        <li> تواصل انسيابي مع المورّدين.</li>--}}
{{--        <li>تقليل التكاليف الانتاجية والوقت المهدر.</li>--}}
{{--        <li>مساعدتك في حل الأزمات المتعلقة بسلاسل الإمداد.</li>--}}
{{--    </ol>--}}

</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
