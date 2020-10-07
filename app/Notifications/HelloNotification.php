<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
//use NotificationChannels\WebPush\WebPushMessage;
//use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\PusherPushNotifications\PusherChannel;
use NotificationChannels\PusherPushNotifications\PusherMessage;

class HelloNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
       // return ['database', 'broadcast', WebPushChannel::class];
      return ['database', 'broadcast', PusherChannel::class];
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
            'title' => 'notification!!!',
            'body' => 'Please recharge your package',
            'action_url' => 'https://laravel.com',
            'created' => Carbon::now()->toIso8601String()
        ];
    }

    

    public function toPushNotification($notifiable, $notification)
    {
        return PusherMessage::create()
           ->title('Hello from Laravel!')
           ->icon('/notification-icon.png')
            ->body('Thank you for using our application.')
           ->action('View app', 'view_app')
          ->data(['id' => $notification->id]);
    }

    /**
     * Get the web push representation of the notification.
     *
     * @param  mixed  $notifiable
     * @param  mixed  $notification
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    // public function toWebPush($notifiable, $notification)
    // {
    //     return (new WebPushMessage)
    //         ->title('Hello from Laravel!')
    //         ->icon('/notification-icon.png')
    //         ->body('Thank you for using our application.')
    //         ->action('View app', 'view_app')
    //         ->data(['id' => $notification->id])
    //          ->options(['TTL' => 1000]);
    // }
}