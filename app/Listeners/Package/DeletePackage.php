<?php

namespace App\Listeners\Package;

use App\Events\Package\DeletePackageEvent;
use App\Services\Contracts\ApiServiceInterface;

class DeletePackage
{
    /**
     * Handle the event.
     *
     * @param  DeletePackageEvent  $event
     * @return void
     */
    public function handle(DeletePackageEvent $event)
    {
        app(ApiServiceInterface::class)->delete($event->url, $event->id, $event->token);
    }
}