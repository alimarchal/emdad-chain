<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuotationSent extends Notification implements ShouldQueue
{
    use Queueable;

    private $quotationSendByUser;
    private $quote;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($quotationSendByUser, $quote)
    {
        $this->quotationSendByUser = $quotationSendByUser;
        $this->quote = $quote;
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
        return (new MailMessage)->subject('Requisition Response')->markdown('mail.quote.mailForBusiness', ['quotationSendByUser' => $this->quotationSendByUser , 'quote' => $this->quote]);
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
