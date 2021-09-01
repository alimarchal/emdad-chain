<?php

namespace App\Notifications;

use App\Models\DraftPurchaseOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DpoApproved extends Notification
{
    use Queueable;
    private $dpo;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(DraftPurchaseOrder $draftPurchaseOrder)
    {
        $this->dpo = $draftPurchaseOrder;
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
        return (new MailMessage)->subject('Congratulations! You have accepted the Quote.')->markdown('mail.dpo.approved',  ['dpo' => $this->dpo]);
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
