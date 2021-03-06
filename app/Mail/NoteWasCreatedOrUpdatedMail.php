<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NoteWasCreatedOrUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $note;
    public $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($note, $project)
    {
        $this->note = $note;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Notes from WVLA/WGMB - " . $this->note->title;
        return $this->view('emails.notes.created')->subject($subject);
    }
}
