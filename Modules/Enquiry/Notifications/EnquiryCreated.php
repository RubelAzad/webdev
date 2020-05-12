<?php

namespace Modules\Enquiry\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Enquiry\Entities\Enquiry;

class EnquiryCreated extends Notification
{
    use Queueable;
    protected $enquiry;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;
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
            ->line('Dear ' . $this->enquiry->name .',')
            ->line('You have sent the following enquiry to us')
            ->line('Name: ' . $this->enquiry->name)
            ->line('Contact Number: ' . $this->enquiry->phone_number)
            ->line('Email: ' . $this->enquiry->email)
            ->line('Subject: ' . $this->enquiry->subject)
            ->line('Message: ' . $this->enquiry->message)
            ->line('Thank you for contacting us. We aim to response your query as soon as possible');
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
