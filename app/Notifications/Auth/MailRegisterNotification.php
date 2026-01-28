<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailRegisterNotification extends Notification
{
    use Queueable;

    protected $name;

    /**
     * Create a new notification instance.
     */
    public function __construct($name)
    {
        // Almacenar el nombre del nuevo usuario registrado
        $this->name = $name;
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
        return (new MailMessage)
            ->bcc(
                env('MAIL_COPY_TO') // Dirección de copia oculta desde el archivo .env
            ) // Copia oculta a la dirección configurada
            ->subject('Registro realizado con éxito')
            ->line('Hemos realizado el registro de su cuenta exitosamente, ' . $this->name . '!')
            ->line('Ahora puede iniciar sesión y comenzar a utilizar nuestra aplicación.')
            ->action('Inicio', url('/'))
            ->line('¡Gracias por usar nuestra aplicación!');
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
