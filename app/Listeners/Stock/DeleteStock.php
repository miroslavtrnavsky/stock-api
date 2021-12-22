<?php

namespace App\Listeners\Stock;

use App\Events\Stock\DeleteStockEvent;
use App\Services\Contracts\ApiServiceInterface;

class DeleteStock
{
    /**
     * Handle the event.
     *
     * @param  DeleteStockEvent  $event
     * @return void
     */
    public function handle(DeleteStockEvent $event)
    {
        app(ApiServiceInterface::class)->delete($event->url, $event->id, $event->token);
    }
}