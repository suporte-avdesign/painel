<?php

namespace AVDPainel\Listeners;

use AVDPainel\Events\AdminResponseContactEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminResponseContactListener
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
     * @param  AdminResponseContactEvent  $event
     * @return void
     */
    public function handle(AdminResponseContactEvent $event)
    {
        //
    }
}
