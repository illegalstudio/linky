<?php

namespace Illegal\Linky\Listeners;

use Illuminate\Auth\Events\Registered;

/**
 * Dummy listener for Registered event.
 * It is used to disable sending email verification notification from the main Laravel app.
 */
class DummySendEmailVerificationNotification
{
    /**
     * Do nothing
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        return;
    }
}
