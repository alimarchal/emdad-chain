@component('mail::message')
# Dear User

You have received quote again your RFQ Item please login to view your quote.

@component('mail::button', ['url' => config('app.url') . '/login'])
Sign In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
