<?php

namespace App\Listeners;

use App\Events\Downlaodfile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DownlaodfileListener
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
     * @param  Downlaodfile  $event
     * @return void
     */
    public function handle(\App\Events\DownlaodfileEvent $event)
    {
        dispatch((new \App\Jobs\Downloadjob($event->fileinfo))->onQueue('queue'));
    }
}
