<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newNotification extends Notification
{
    use Queueable;
    protected $message;
    protected $user;
    protected $mailUrl;

    /**
     * newNotification constructor.
     * @param $message
     * @param $user
     * @param $mailUrl
     */
    public function __construct($message, $user, $mailUrl)
    {
        $this->message = $message;
        $this->user = $user;
        $this->mailUrl = $mailUrl;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast', 'mail'];
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message
        ];
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        return [
            'message' => $this->message
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Acción requerida')
            ->greeting(sprintf('Hola %s,', $this->user->name))
            ->line($this->message)
            ->action('Acción', $this->mailUrl)
            ->line('Nos vemos pronto,')
            ->salutation('Bolsa de Trabajo Ciudad Madero');
    }

}
