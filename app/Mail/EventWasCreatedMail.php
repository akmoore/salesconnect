<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Calendar;

class EventWasCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $project;
    public $person;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $project, $person)
    {
        $this->event    = $event;
        $this->project  = $project;
        $this->person   = $person;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $type = $this->event->event_type == 'prepro' ? 'Preproduction' : 'Shoot';
        $subject = $type . ' - ' . $this->project->client->company_name . ' - ' . $this->event->event_date->format('M d, Y');
        return $this->view('emails.events.created')->subject($subject);
    }
}
