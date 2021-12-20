<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;
    public $token;
    public $email;
    public $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
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
        $minutos = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');
        $url = config('app.url', 'Laravel') . '/password/reset/' . $this->token . '?email=' . $this->email;
        return (new MailMessage)
            ->subject('Redefinição de senha')
            ->greeting('Olá, ' . strtok($this->name," "))
            ->line('Pelo visto você esqueceu sua senha... Então vamos resolver isso!')
            ->action('Clique aqui para escolher uma nova senha', $url)
            ->line('Este link expira em ' . $minutos . ' minutos.')
            ->line('Caso não tenha solicitado a modificação de sua senha, apenas desconsidere este email.')
            ->salutation('Até breve!');
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
