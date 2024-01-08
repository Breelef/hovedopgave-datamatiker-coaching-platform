<?php

namespace App\Listeners;

use App\Actions\User\UpdateUserLastLoginAt;

class AuthLoginEventHandler
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
     */
    public function handle(object $event): void
    {
        // Set last login date
        if (! session()->has('impersonator')) {
            UpdateUserLastLoginAt::dispatch($event->user, now());
        }
    }
}
