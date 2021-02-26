@component('mail::message')
# Modification Required

Your qoutation {{ $item->item_name }} requires some modification. Please login to make changes.

@component('mail::button', ['url' => config('app.url') . '/login'])
Sign In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
