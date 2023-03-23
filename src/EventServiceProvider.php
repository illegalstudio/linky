<?php

namespace Illegal\Linky;

use Illegal\Linky\Auth\Events\Registered;
use Illegal\Linky\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for the application.
     *
     * @return void
     */
    public function boot(): void
    { }

    /**
     * @return false
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
