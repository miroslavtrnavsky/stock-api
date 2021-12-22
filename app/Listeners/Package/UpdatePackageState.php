<?php

namespace App\Listeners\Package;

use App\Events\Package\UpdatePackageStateEvent;
use App\Services\Contracts\ApiServiceInterface;

class UpdatePackageState
{
    /**
     * Handle the event.
     *
     * @param  UpdatePackageStateEvent  $event
     * @return void
     */
    public function handle(UpdatePackageStateEvent $event)
    {
        app(ApiServiceInterface::class)->update(
            $event->url,
            $event->id,
            ['state' => $event->state],
            $event->token
        );
    }
}
