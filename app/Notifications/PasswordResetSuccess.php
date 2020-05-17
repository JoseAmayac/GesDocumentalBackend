<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetSuccess extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $saludation = "Saludos,  \n GestionDocumental";
        $url = 'localhost:4200/auth';

        return (new MailMessage)
                    ->greeting('Hola!')
                    ->salutation(html_entity_decode(preg_replace("/[\r\n]{2,}/", "\n\n", $saludation), ENT_QUOTES, 'UTF-8'))
                    ->subject('Restablecimiento de contraseña correcto')
                    ->line('La contraseña de tu cuenta ha sido cambiada correctamente, ya puedes acceder a ella.')
                    ->action('Ir a mi cuenta', $url)
                    ->line('Gracias por usar la aplicación!');
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
