<?php

namespace App\Listeners;

use App\Events\JobEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobNotification
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
     * @param  JobEvent  $event
     * @return void
     */
    public function handle(JobEvent $event)
    {
        //
    }
}
