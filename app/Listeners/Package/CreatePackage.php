<?php

namespace App\Listeners\Package;

use App\Events\Package\CreatePackageEvent;
use App\Services\Contracts\ApiServiceInterface;

class CreatePackage
{
    /**
     * Handle the event.
     *
     * @param  CreatePackageEvent  $event
     * @return void
     */
    public function handle(CreatePackageEvent $event)
    {
        app(ApiServiceInterface::class)->create($event->url, $event->data, $event->token);
    }
}
