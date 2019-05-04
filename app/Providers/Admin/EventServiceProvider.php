<?php

namespace AVDPainel\Providers\Admin;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'AVDPainel\Events\AdminResponseContactEvent' => [
            'AVDPainel\Listeners\AdminResponseContactListener'
        ],
        'AVDPainel\Events\UserAddressCreatedEvent' => [
            'AVDPainel\Listeners\UserAddressCreatedListener',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
