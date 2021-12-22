<?php

namespace App\Listeners\Package;

use App\Events\Package\UpdatePackageStockEvent;
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
        app(ApiServiceInterface::class)->update(
            $event->url,
            $event->id,
            ['stock_id' => $event->stockId],
            $event->token
        );
    }
}