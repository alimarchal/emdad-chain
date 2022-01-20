<?php

namespace App\Notifications\User;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuotationCategory extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $item_code;
    private $rfq_type;

    public function __construct($item_code, $rfq_type)
    {
        $this->item_code = $item_code;
        $this->rfq_type = $rfq_type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'notification_data' => 'New requisition ' . Category::find($this->item_code)->name . ' received',
            'url_route' => (($this->rfq_type == 1) ? route('viewRFQs') : route('singleCategoryRFQs')),
            'quotation_type' => $this->rfq_type,
        ];
    }
}
