@component('mail::message')
# One time password for delivery receiving
Your delivery is here. Please share the OTP code with the driver after unloading the delivery.

@component('mail::button', ['url' => '#'])
OTP CODE: {{$otp}}
@endcomponent

Thanks you for using,<br>
{{ config('app.name') }} Platform
@endcomponent
