<?php

namespace App\Listeners;

use App\Events\JobStateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobStateListener
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
     * @param  JobStateEvent  $event
     * @return void
     */
    public function handle(JobStateEvent $event)
    {
        //
    }
}
