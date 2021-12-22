<?php

namespace App\Listeners\Package;

use App\Events\Package\UpdateStockEvent;
use App\Services\Contracts\ApiServiceInterface;

class UpdatePackageStock
{
    /**
     * Handle the event.
     *
     * @param  UpdateStockEvent  $event
     * @return void
     */
    public function handle(UpdateStockEvent $event)
    {
        app(ApiServiceInterface::class)->update(
            $event->url,
            $event->id,
            ['stock_id' => $event->stockId],
            $event->token
        );
    }
}