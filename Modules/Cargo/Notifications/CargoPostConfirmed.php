<?php

namespace Modules\Cargo\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Cargo\Entities\CargoPost;

class CargoPostConfirmed extends Notification
{
    use Queueable;
    protected $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(CargoPost $post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable){
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable){
        return [
            'post_id' => $this->post->id,
            'post' => $this->post
        ];
    }
}
