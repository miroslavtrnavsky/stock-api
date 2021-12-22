<?php

namespace App\Providers;

use App\Events\Package\CreatePackageEvent;
use App\Events\Package\DeletePackageEvent;
use App\Events\Package\IndexPackageEvent;
use App\Events\Package\UpdatePackagePositionEvent;
use App\Events\Package\UpdatePackageStateEvent;
use App\Events\Package\UpdatePackageStockEvent;
use App\Events\Stock\CreateStockEvent;
use App\Events\Stock\DeleteStockEvent;
use App\Events\Stock\IndexStockEvent;
use App\Events\Stock\UpdateStockEvent;
use App\Listeners\Package\CreatePackage;
use App\Listeners\Package\DeletePackage;
use App\Listeners\Package\IndexPackage;
use App\Listeners\Package\UpdatePackagePosition;
use App\Listeners\Package\UpdatePackageState;
use App\Listeners\Package\UpdatePackageStock;
use App\Listeners\Stock\CreateStock;
use App\Listeners\Stock\DeleteStock;
use App\Listeners\Stock\IndexStock;
use App\Listeners\Stock\UpdateStock;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        ],

        IndexStockEvent::class => [
            IndexStock::class
        ],
        CreateStockEvent::class => [
            CreateStock::class
        ],
        UpdateStockEvent::class => [
            UpdateStock::class
        ],
        DeleteStockEvent::class => [
            DeleteStock::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
