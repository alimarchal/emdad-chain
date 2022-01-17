<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SingleCategoryDeliveryCompleted extends Notification implements ShouldQueue
{
    use Queueable;
    private $deliveryID;
    private $deliveries;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($deliveries, $deliveryID)
    {
        $this->deliveryID = $deliveryID;
        $this->deliveries = $deliveries;
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
        return (new MailMessage)->subject('DN-'. $this->deliveryID . ' has been delivery')->markdown('mail.delivery.singleCategory', [ 'deliveryID' => $this->deliveryID, 'deliveries' => $this->deliveries]);
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
