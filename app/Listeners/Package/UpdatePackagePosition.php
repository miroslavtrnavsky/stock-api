<?php

namespace App\Listeners\Package;

use App\Events\Package\UpdatePackagePositionEvent;
use App\Services\Contracts\ApiServiceInterface;

class UpdatePackagePosition
{
    /**
     * Handle the event.
     *
     * @param  UpdatePackagePositionEvent  $event
     * @return void
     */
    public function handle(UpdatePackagePositionEvent $event)
    {
        app(ApiServiceInterface::class)->update(
            $event->url,
            $event->id,
            ['position' => $event->position],
            $event->token
        );
    }
}