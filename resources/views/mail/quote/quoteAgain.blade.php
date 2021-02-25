@component('mail::message')
# Modification Required

Your qoutation {{ $item->item_name }} required modification please login to quote again.

@component('mail::button', ['url' => config('app.url') . '/login'])
Sign In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
