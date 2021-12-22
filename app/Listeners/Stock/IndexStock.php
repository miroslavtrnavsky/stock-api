<?php

namespace App\Listeners\Stock;

use App\Events\Stock\IndexStockEvent;
use App\Services\Contracts\ApiServiceInterface;

class IndexStock
{
    /**
     * Handle the event.
     *
     * @param  IndexStockEvent  $event
     * @return void
     */
    public function handle(IndexStockEvent $event)
    {
        app(ApiServiceInterface::class)->create($event->url, $event->token);
    }
}