<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $eventer;
    public $recipient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($eventer, $recipient)
    {
        $this->eventer = $eventer;
        $this->recipient = $recipient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->eventer);
        return $this->view('emails.events.reminder');
    }
}
