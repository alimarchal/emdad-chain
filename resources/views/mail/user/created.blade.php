@component('mail::message')
# User Registration
By signing in, you are agreeing emdad's <a href="{{route('policyProcedure.eula')}}" target="_blank"><u>policies and procedures.</u></a> <br>
Your new Username is: {{ $user->email }}. <br>
Password: {{ $pass }}

@component('mail::button', ['url' => config('app.url') . '/login'])
Sign In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
