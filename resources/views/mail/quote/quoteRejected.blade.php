@component('mail::message')
# Dear User

Your quotation for {{ $item->item_name }} has been rejected by the buyer.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
