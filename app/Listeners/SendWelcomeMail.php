<?php

namespace App\Listeners;

use App\Models\SmsMessages;
use App\Models\User;
use App\Notifications\UserRegister;
use Illuminate\Support\Facades\Notification;

class SendWelcomeMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $user_language = $event->user->rtl;
        $message = env('APP_URL') . "\nNew CEO Registered as " . $event->user->registration_type
            . "\nMobile #: " . $event->user->mobile . "\nEmail: " . $event->user->email;
        if ($user_language == 0) {
            User::send_sms($event->user->mobile, SmsMessages::find(1)->english_message);
            User::send_sms('+966581382822', $message);
            User::send_sms('+966555390920', $message);
            User::send_sms('+966593388833', $message);
        } else if ($user_language == 1) {
            User::send_sms('+966581382822', $message);
            User::send_sms('+966555390920', $message);
            User::send_sms('+966593388833', $message);
            User::send_sms($event->user->mobile, SmsMessages::find(1)->arabic_message);
        }
        $user_id = $event->user->id;
        Notification::route('mail', 'business@emdad-chain.com')
            ->notify(new UserRegister($user_id));
    }
}
