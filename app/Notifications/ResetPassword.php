<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    public $token;

    /**
     * Create a new notification instance.
     * @param $token
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
        return (new MailMessage)
            ->subject('Recuperação de Senha')
            ->line('Você está recebendo este e-mail porque um pedido de recuperação de senha para sua conta foi solicitado.')
            ->action('Redefinir Senha', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('Se você não solicitou uma recuperação da senha, nenhuma ação será necessária.');
    }

}
