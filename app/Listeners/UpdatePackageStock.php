<?php

namespace App\Listeners;

use App\Events\UpdatePackageStockEvent;
use App\Services\Contracts\ApiServiceInterface;

class UpdatePackageStock
{
    /**
     * Handle the event.
     *
     * @param  UpdatePackageStockEvent  $event
     * @return void
     */
    public function handle(UpdatePackageStockEvent $event)
    {
        app(ApiServiceInterface::class)->update($event->url, $event->id, $event->stockId, $event->token);
    }
}