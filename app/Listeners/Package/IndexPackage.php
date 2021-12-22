<?php

namespace App\Listeners\Package;

use App\Events\Package\IndexStockEvent;
use App\Services\Contracts\ApiServiceInterface;

class IndexPackage
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