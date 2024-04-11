<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageRecived extends Mailable
{
    use Queueable, SerializesModels;

    public $messageRecived;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messageRecived)
    {
        $this->messageRecived = $messageRecived;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.message-recived')->subject('Mensaje Sitio web FIMe');
    }
}
