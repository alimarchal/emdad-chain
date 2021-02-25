@component('mail::message')
# Congratulations

Your quote {{ $item->name }} has been accepted please login to proceed futher.

@component('mail::button', ['url' => config('app.url') . '/login'])
Sign In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
