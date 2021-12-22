<?php

namespace App\Listeners;

use App\Events\UpdatePackageStateEvent;
use App\Services\Contracts\ApiServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
