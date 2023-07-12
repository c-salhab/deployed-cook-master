<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    /**
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
        return $this->subject('Event Cancellation')->view('emails.cancel');
    }
}
