<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSubscriberNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $projects;

    public function __construct($projects)
    {
        $this->projects = $projects;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.Mail_Subscriber_Notification');
    }
}
