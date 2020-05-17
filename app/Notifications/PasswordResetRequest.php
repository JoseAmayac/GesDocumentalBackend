<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetRequest extends Notification implements ShouldQueue
{
    use Queueable;

    protected $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $url = 'localhost:4200/reset/recover/'.$this->token;

        $saludation = "Saludos,  \n GestionDocumental";

        return (new MailMessage)
                    ->greeting('Hola!')
                    ->salutation(html_entity_decode(preg_replace("/[\r\n]{2,}/", "\n\n", $saludation), ENT_QUOTES, 'UTF-8'))
                    ->subject('Recuperación de contraseña')
                    ->line('Estas recibiendo este email porque recibimos una solicitud de cambio de contraseña desde tu cuenta.')
                    ->action('Restablecer contraseña', $url)
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
