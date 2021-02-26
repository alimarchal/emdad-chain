@component('mail::message')
# Congratulations

Your quotation for {{ $item->name }} has been accepted. Please login to proceed futher.

@component('mail::button', ['url' => config('app.url') . '/login'])
Sign In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
