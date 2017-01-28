<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InactiveUsersNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $users;
    public function __construct($users)
    {
        $this->users =$users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.inactive_users_notification');
    }
}
