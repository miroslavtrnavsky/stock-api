<?php

namespace App\Providers;

use App\Events\CreatePackageEvent;
use App\Events\UpdatePackagePositionEvent;
use App\Events\UpdatePackageStateEvent;
use App\Events\UpdatePackageStockEvent;
use App\Listeners\CreatePackage;
use App\Listeners\UpdatePackagePosition;
use App\Listeners\UpdatePackageState;
use App\Listeners\UpdatePackageStock;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreatePackageEvent::class => [
            CreatePackage::class
        ],
        UpdatePackageStateEvent::class => [
            UpdatePackageState::class
        ],
        UpdatePackagePositionEvent::class => [
            UpdatePackagePosition::class
        ],
        UpdatePackageStockEvent::class => [
            UpdatePackageStock::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(CreatePackageEvent::class, [CreatePackage::class, 'handle']);
    }
}
