@component('mail::message')
# User Registration

Your new Username is: {{ $user->email }}. <br>
Password: {{ $pass }}

@component('mail::button', ['url' => config('app.name') . '/login'])
Sign In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
