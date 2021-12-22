<?php

namespace App\Listeners\Stock;

use App\Events\Stock\CreateStockEvent;
use App\Services\Contracts\ApiServiceInterface;

class CreateStock
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
