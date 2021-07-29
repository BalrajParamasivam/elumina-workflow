<?php

namespace App\Listeners;

use App\Events\RegisterStatusUpdateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\Registered;

class RegisterStatusUpdateListener
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
     * @param  RegisterStatusUpdateEvent  $event
     * @return void
     */
    public function handle(RegisterStatusUpdateEvent $event)
    {
        Mail::to($event->register->email)->send(new Registered($event->register->status));
    }
}
