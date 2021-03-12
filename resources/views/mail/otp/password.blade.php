@component('mail::message')
# One time password for delivery receiving

@component('mail::button', ['url' => '#'])
OTP CODE: {{$otp}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
