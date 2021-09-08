<?php

namespace App\Notifications;

use App\Models\SmsMessages;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class userVerifiedEmail extends Notification
{
    use Queueable;

    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;

        $user_language = $user->rtl;
        $domain = config('app.url');
        $message = $domain ." New CEO " . $user->name ."Registered as " . $user->registration_type
            . "\nMobile #: " . $user->mobile . "\nEmail: " . $user->email;

        if ($user_language == 0) {
            User::send_sms($user->mobile, SmsMessages::find(1)->english_message);
            User::send_sms('+966581382822', $message);
            User::send_sms('+966555390920', $message);
            User::send_sms('+966593388833', $message);
        } else if ($user_language == 1) {
            User::send_sms('+966581382822', $message);
            User::send_sms('+966555390920', $message);
            User::send_sms('+966593388833', $message);
            User::send_sms($user->mobile, SmsMessages::find(1)->arabic_message);
        }
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
        /*return (new MailMessage)
                    ->greeting('Hi!')
                    ->subject('New CEO registered')
                    ->line(config('app.url') . ' - CEO '. $this->user->name .' registered as ' .  $this->user->registration_type);*/
        return (new MailMessage)->subject('New CEO Registered')->markdown('mail.user.userRegister', ['user' => $this->user]);
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
