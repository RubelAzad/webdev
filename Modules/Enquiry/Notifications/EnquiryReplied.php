<?php

namespace Modules\Enquiry\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Enquiry\Entities\Enquiry;
use Modules\Enquiry\Entities\EnquiryReply;

class EnquiryReplied extends Notification
{
    use Queueable;

    protected $enquiry;
    protected $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Enquiry $enquiry, EnquiryReply $reply)
    {
        $this->enquiry = $enquiry;
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Dear ' . $this->enquiry->name . ',')
            ->line(config('app.name') . ' has replied your enquiry. Please do not reply via this email. Please click the bellow link if you wish to reply this message')
            ->line('------------------')
            ->line($this->reply->message)
            ->line('------------------')
            ->action('Reply', url('enquiry/view/' . $this->enquiry->link))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
