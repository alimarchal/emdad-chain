<?php

namespace App\Mail;

use App\Models\Business;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contracts extends Mailable
{
    use Queueable, SerializesModels;

    protected $business;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @param Business $business
     */


    public function __construct(Business $business, User $user)
    {
        $this->business = $business;
        $this->user = $user;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $business = $this->business;
        $user = $this->user;
        return $this->markdown('emails.contracts', compact('business','user'));
    }
}
