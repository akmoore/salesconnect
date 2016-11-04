<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $name;
    public $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $name, $project)
    {
        $this->event = $event;
        $this->name = $name;
        $this->project = $project;
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
