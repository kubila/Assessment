<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use App\Notifications\UserRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;

class SendRegisteredNotification
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(NewUserRegistered $event)
    {
        Notification::send($event->user, new UserRegistered($event->user));

    }
}
