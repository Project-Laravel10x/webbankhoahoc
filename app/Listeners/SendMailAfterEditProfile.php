<?php

namespace App\Listeners;

use App\Events\EditProfile;
use App\Jobs\SendEmailUpdateProfile;
use App\Mail\ProfileUpdatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailAfterEditProfile implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(EditProfile $event): void
    {
        SendEmailUpdateProfile::dispatch($event->student);
    }
}
