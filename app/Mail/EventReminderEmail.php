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
        $type = $this->event->event_type == 'prepro' ? 'Preproduction' : 'Shoot';
        $subject = 'Reminder: ' . $type . ' - ' . $this->project->client->company_name . ' - ' . $this->event->event_date->format('M d, Y');
        return $this->view('emails.events.reminder')->subject($subject);
    }
}
