<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    /**
     * Crée une nouvelle instance du message.
     *
     * @param  \App\Models\Events  $event
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     *
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thank you for registering to the event')->view('emails.event');
    }
}
