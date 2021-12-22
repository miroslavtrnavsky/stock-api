<?php

namespace App\Listeners\Package;

use App\Events\Package\DeleteStockEvent;
use App\Services\Contracts\ApiServiceInterface;

class DeletePackage
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