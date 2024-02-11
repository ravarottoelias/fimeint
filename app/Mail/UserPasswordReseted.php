<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserPasswordReseted extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $newPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $newPass)
    {
        $this->user = $user;
        $this->newPassword = $newPass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.user-password-reseted')->subject('Nueva clave para Fimeint.org');
    }
}
