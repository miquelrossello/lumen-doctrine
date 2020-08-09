<?php

namespace App\Infrastructure\Shared\Providers;

use App\Infrastructure\Events\ExampleEvent;
use App\Infrastructure\Listeners\ExampleListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     * @var array
     */
    protected $listen = [
        ExampleEvent::class => [
            ExampleListener::class,
        ],
    ];
}
