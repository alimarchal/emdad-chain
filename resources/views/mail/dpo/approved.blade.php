@component('mail::message')
# Congratulations

You have accepted the Qoute #: {{ $dpo->qoute_no }} and Your purchase order number is: {{ $dpo->id }}.

@component('mail::button', ['url' => config('app.url' . '/login' )])
Login In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
