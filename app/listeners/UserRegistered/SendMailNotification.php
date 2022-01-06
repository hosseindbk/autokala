<?php

namespace App\listeners\UserRegistered;

use App\Event\UserActivation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserActivation  $event
     * @return void
     */
    public function handle(UserActivation $event)
    {
        //
    }
}
