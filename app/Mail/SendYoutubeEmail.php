<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendYoutubeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $youtube;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($project, $youtube)
    {
        $this->project = $project;
        $this->youtube = $youtube;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->project->client->company_name . ' YouTube Video is Available';
        return $this->view('emails.youtube.send')->subject($subject);
    }
}
