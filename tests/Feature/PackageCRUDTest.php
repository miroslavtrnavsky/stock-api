<?php

namespace Tests\Feature;

use App\Enums\PackageStateEnum;
use App\Events\CreatePackageEvent;
use App\Events\UpdatePackagePositionEvent;
use App\Events\UpdatePackageStateEvent;
use App\Listeners\CreatePackage;
use App\Models\Package;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PackageCRUDTest extends TestCase
{
    CONST TEST_USER_CODE = 81472;
    CONST TEST_USER_PASSWORD = 'stockadmin';

    private string $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->token = Http::post(url('api/login'), ['code' => self::TEST_USER_CODE, 'password' => self::TEST_USER_PASSWORD])->json('token');
    }

    public function test_create_package()
    {
        event(new CreatePackageEvent(url('api/packages'), [
            'stock_id' => 1,
            'code' => 12353,
            'position' => 'First shelf',
            'state' => PackageStateEnum::NEW->value
        ], $this->token));

        $this->assertDatabaseCount(Package::class, 4);
    }

//    public function test_update_package_state()
//    {
//        Event::fake();
//
//        event(new UpdatePackageStateEvent(
//            url('api/packages'),
//            Package::query()->find(1)->id,
//            PackageStateEnum::WAITING_FOR_DELIVERY
//        ));
//
//        Event::assertDispatched(UpdatePackageStateEvent::class);
//    }
//
//    public function test_update_package_position()
//    {
//        Event::fake();
//
//        event(new UpdatePackagePositionEvent(
//            url('api/packages'),
//            Package::query()->find(1)->id,
//            'Second shelf'
//        ));
//
//        Event::assertDispatched(UpdatePackagePositionEvent::class);
//    }
}