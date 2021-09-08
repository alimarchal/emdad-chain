@component('mail::message')
# New Registration

{{config('app.url')}} <br>
New CEO {{$user->name}} Registered as {{$user->registration_type}}<br>
Mobile # {{$user->mobile}}<br>
Email: {{$user->email}}<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
