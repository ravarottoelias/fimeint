<?php

namespace App\Mail;

use App\User;
use App\Curso;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuccessfulInscription extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $curso;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Curso $curso, User $user)
    {
        $this->user = $user;
        $this->curso = $curso;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.success-inscription')->subject('Gracias por Inscribirse');
    }
}
