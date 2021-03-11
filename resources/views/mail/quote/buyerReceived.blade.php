@component('mail::message')
# Dear User

You have received a quotation/s against your RFQ Item/s. Please login to proceed.

@component('mail::button', ['url' => config('app.url') . '/login'])
Sign In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
