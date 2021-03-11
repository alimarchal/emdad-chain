@component('mail::message')
# Congratulations

Your quotation for {{ $item->item_name }} has been accepted. Please login to proceed futher and view your delivery menu.

@component('mail::button', ['url' => config('app.url') . '/login'])
Sign In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
