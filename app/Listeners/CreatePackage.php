<?php

namespace App\Listeners;

use App\Events\CreatePackageEvent;
use App\Services\Contracts\ApiServiceInterface;
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
        dd(1);
       app(ApiServiceInterface::class)->create($event->url, $event->data);
    }
}
