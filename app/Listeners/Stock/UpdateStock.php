<?php

namespace App\Listeners\Stock;

use App\Events\Stock\UpdateStockEvent;
use App\Services\Contracts\ApiServiceInterface;

class UpdateStock
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
            $event->data,
            $event->token
        );
    }
}
