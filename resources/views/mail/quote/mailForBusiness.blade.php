@component('mail::quotationForBusiness', ['quote' => $quote])
    # Hi!

    {{-- config('app.url') adding in order to know from which domain the email is generated --}}
    {{config('app.url')}} - {{$quotationSendByUser->business->business_name}} responded to a requisition.
@endcomponent
