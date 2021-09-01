<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SingleCategoryPurchaseOrderGenerated extends Notification
{
    use Queueable;

    private $userGenerated;
    private $DPOs;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userGenerated, $DPOs)
    {
        $this->userGenerated = $userGenerated;
        $this->DPOs = $DPOs;
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
        return (new MailMessage)->markdown('mail.dpo.mailForBusinessSingleCategory', ['userGenerated' =>  $this->userGenerated,'DPOs' => $this->DPOs]);
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
