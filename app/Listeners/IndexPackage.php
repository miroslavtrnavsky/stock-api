<?php

namespace App\Listeners;

use App\Events\IndexPackageEvent;
use App\Services\Contracts\ApiServiceInterface;

class IndexPackage
{
    /**
     * Handle the event.
     *
     * @param  IndexPackageEvent  $event
     * @return void
     */
    public function handle(IndexPackageEvent $event)
    {
        app(ApiServiceInterface::class)->create($event->url, $event->toke);
    }
}