<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewTemporaryPasswordNotification extends Notification
{
    use Queueable;

    private $temporaryPassword;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $temporaryPassword)
    {
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hola!')
            ->line("Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.")
            ->line("A continuación le enviamos una contraseña temporal, recomendamos cambiarla una vez iniciado sesión.")
            ->line(new HtmlString("Contraseña temporal: <strong>$this->temporaryPassword</strong>"))
            ->salutation('Saludos, FIMe.')
            ->action("Iniciar Sesión", 
                url(route('login', [
                    'email' => $notifiable->email,
                ])));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
