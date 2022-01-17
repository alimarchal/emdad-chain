<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseOrderGenerated extends Notification implements ShouldQueue
{
    use Queueable;

    private $userGenerated;
    private $dpo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userGenerated, $dpo)
    {
        $this->userGenerated = $userGenerated;
        $this->dpo = $dpo;
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
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('Generated a Purchase Order')->markdown('mail.dpo.mailForBusiness', ['userGenerated' => $this->userGenerated, 'dpo' => $this->dpo]);
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
