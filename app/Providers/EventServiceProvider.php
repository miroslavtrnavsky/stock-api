<?php

namespace App\Providers;

use App\Events\Package\CreatePackageEvent;
use App\Events\Package\DeletePackageEvent;
use App\Events\Package\IndexPackageEvent;
use App\Events\Package\UpdatePackagePositionEvent;
use App\Events\Package\UpdatePackageStateEvent;
use App\Events\Package\UpdatePackageStockEvent;
use App\Listeners\Package\CreatePackage;
use App\Listeners\Package\DeletePackage;
use App\Listeners\Package\IndexPackage;
use App\Listeners\Package\UpdatePackagePosition;
use App\Listeners\Package\UpdatePackageState;
use App\Listeners\Package\UpdatePackageStock;
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
        IndexPackageEvent::class => [
            IndexPackage::class
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
        ],
        DeletePackageEvent::class => [
            DeletePackage::class
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
