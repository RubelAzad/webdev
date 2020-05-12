<?php

namespace Modules\Pickup\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Pickup\Entities\Pickup;

class NewPickupRequestCreated extends Notification
{
    use Queueable;
    protected $pickup;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Pickup $pickup)
    {
        $this->pickup = $pickup;
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
    public function toMail($notifiable){

        return (new MailMessage)
            ->subject('A new pickup request has been created')
            ->greeting('Dear ' . $this->pickup->name .',')
            ->line('We would like to let you know, you have successfully created new pickup request to collect your parcel from your preferred location.')
            ->line('We will let you know the driver details as soon as we assign a driver to collect your parcel.')
            ->line('Please do not hesitate to contact us in-case you have any query. Thank you for using our application!');
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
