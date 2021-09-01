@component('mail::mailForBusiness', ['eOrderItems' => $eOrderItems])
  # Hi!

  {{-- config('app.url') adding in order to know from which domain the email is generated --}}
    {{config('app.url')}} - {{$user->business->business_name}} generated a Requisition.
@endcomponent


