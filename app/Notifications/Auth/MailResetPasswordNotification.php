<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailResetPasswordNotification extends Notification
{
    use Queueable;

    protected $token;
    protected $url;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {   
        // Asignamos el token
        $this->token = $token;

        // Asignamos la URL de la aplicación desde el archivo .env
        $this->url = env('APP_URL', "http://localhost:3000");
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // http://localhost:3000/reset-account/{token}
        $resetUrl = $this->url . '/reset-account/' . $this->token;

        return (new MailMessage)
            ->subject('Solicitud para cambio de contraseña')
            ->line('Has recibido este correo porque se ha solicitado un restablecimiento de contraseña para tu cuenta.')
            ->action('Cambiar contraseña', $resetUrl)
            ->line('Si no has solicitado un cambio de contraseña, puedes ignorar este correo.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
