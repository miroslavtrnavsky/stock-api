<?php

namespace App\Listeners\Package;

use App\Events\Package\IndexPackageEvent;
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
        app(ApiServiceInterface::class)->create($event->url, $event->token);
    }
}