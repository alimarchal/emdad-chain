<?php

namespace App\Notifications;

use App\Models\EOrderItems;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RFQCreatedByUser extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    private $eOrderItems;
    public $subject;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $eOrders)
    {
        $this->user = $user;
        $this->subject = "test";
        $this->eOrderItems = EOrderItems::where('e_order_id', $eOrders->id)->get();
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
        return (new MailMessage)->subject('New RFQ Received')->markdown('mail.rfq.createdMailForBusiness', ['user' => $this->user, 'eOrderItems' => $this->eOrderItems]);
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
