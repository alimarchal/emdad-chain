@component('mail::message')
# Congratulation

Your business has been approved pelase login to view.

@component('mail::button', ['url' => config('app.url') . '/login'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
