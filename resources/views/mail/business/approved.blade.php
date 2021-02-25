@component('mail::message')
# Congratulation

Your business has been approved pelase login to view.

@component('mail::button', ['url' => config('app.url')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
