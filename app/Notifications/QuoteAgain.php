<?php

namespace App\Notifications;

use App\Models\EOrderItems;
use App\Models\Qoute;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuoteAgain extends Notification
{
    use Queueable;

    private $item;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Qoute $qoute)
    {
        $this->item = EOrderItems::find($qoute->e_order_items_id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.quote.quoteAgain',['item' => $this->item]);
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
            //
        ];
    }
}
