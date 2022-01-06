<?php

namespace App\Notifications;

use App\Notifications\Channels\GhasedakChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActiveCode extends Notification
{
    use Queueable;

    public $code;

    public $phone;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code , $phone)
    {
        $this->code = $code;
        $this->phone = $phone;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [GhasedakChannel::class];
    }


    public function toGhasedakSms($notifiable)
    {
        return [
            'text' => " code: {$this->code} \n \n کد اختصاصی شما برای ورود به وبسایت اتوکالا ",
            'phone' => $this->phone,
            'code' => $this->code
        ];
    }
}
