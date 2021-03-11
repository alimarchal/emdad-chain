@component('mail::message')
# Preparing Delivery

Your delivery is preparing. Please login to view status.

@component('mail::button', ['url' => config('app.url') . '/login'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
