<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class MailNotification extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    private string $content;
    /**
     * @var string
     */
    private string $subject;

    /**
     * Create a new notification instance.
     *
     * @param string $subject
     * @param string $content
     */
    public function __construct(string $subject, string $content)
    {
        $this->content = $content;
        $this->subject = $subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->line(new HtmlString($this->content));
    }
}
