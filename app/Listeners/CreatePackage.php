<?php

namespace App\Listeners;

use App\Events\CreatePackageEvent;
use App\Services\Contracts\ApiServiceInterface;
use App\Services\PackageApiClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
