<?php

namespace Tests\Feature;

use App\Enums\PackageStateEnum;
use App\Events\CreatePackageEvent;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PackageCRUDTest extends TestCase
{
    public function test_create_package()
    {
        Event::fake();

        event(new CreatePackageEvent(route('packages.store'), [
            'stock_id' => 1,
            'code' => 12353,
            'position' => 'First shelf',
            'state' => PackageStateEnum::NEW->value
        ]));

        Event::assertDispatched(CreatePackageEvent::class);
    }
}