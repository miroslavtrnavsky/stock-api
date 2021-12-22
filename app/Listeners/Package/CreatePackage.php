<?php

namespace App\Listeners\Package;

use App\Events\Package\CreateStockEvent;
use App\Services\Contracts\ApiServiceInterface;

class CreatePackage
{
    /**
     * Handle the event.
     *
     * @param  CreateStockEvent  $event
     * @return void
     */
    public function handle(CreateStockEvent $event)
    {
        app(ApiServiceInterface::class)->create($event->url, $event->data, $event->token);
    }
}
