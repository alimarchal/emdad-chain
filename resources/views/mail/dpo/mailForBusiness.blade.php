@component('mail::POMailForBusiness', ['dpo' => $dpo])
    # Hi!

    {{-- config('app.url') adding in order to know from which domain the email is generated --}}
    {{config('app.url')}} - {{$userGenerated->business->business_name}} generated a Purchase Order.
@endcomponent


