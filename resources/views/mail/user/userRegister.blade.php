@component('mail::message')
# New Registration

New CEO Registered as {{$user->registration_type}}<br>
Mobile # {{$user->mobile}}<br>
Email: {{$user->email}}<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
