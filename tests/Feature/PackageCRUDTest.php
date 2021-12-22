<?php

namespace Tests\Feature;

use App\Enums\PackageStateEnum;
use App\Events\Package\CreatePackageEvent;
use App\Events\Package\DeletePackageEvent;
use App\Events\Package\IndexPackageEvent;
use App\Events\Package\UpdatePackageStockEvent;
use App\Events\Package\UpdatePackagePositionEvent;
use App\Events\Package\UpdatePackageStateEvent;
use App\Models\Package;
use App\Models\Stock;
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

    public function test_index_package()
    {
        Event::fake();

        event(new IndexPackageEvent(
            url('api/packages'),
            $this->token
        ));

        Event::assertDispatched(IndexPackageEvent::class);
    }

    public function test_create_package()
    {
        $data = [
            'stock_id' => 1,
            'code' => 12353,
            'position' => 'First shelf',
            'state' => PackageStateEnum::NEW->value
        ];

        event(new CreatePackageEvent(
            url('api/packages'),
            $data ,
            $this->token
        ));

        $this->assertDatabaseHas(Package::class, $data);
    }

    public function test_update_package_state()
    {
        $package = Package::query()->find(1);

        event(new UpdatePackageStateEvent(
            url('api/packages'),
            $package->id,
            PackageStateEnum::WAITING_FOR_DELIVERY,
            $this->token
        ));

        $updated = $package->refresh();

        $this->assertEquals(PackageStateEnum::WAITING_FOR_DELIVERY->value, $updated->state);
    }

    public function test_update_package_position()
    {
        $package = Package::query()->find(1);

        event(new UpdatePackagePositionEvent(
            url('api/packages'),
            $package->id,
            'Second shelf',
            $this->token
        ));

        $updated = $package->refresh();

        $this->assertEquals('Second shelf', $updated->position);
    }

    public function test_update_package_stock()
    {
        $package = Package::query()->find(1);

        event(new UpdatePackageStockEvent(
            url('api/packages'),
            $package->id,
            Stock::query()->find(2)->id,
            $this->token
        ));

        $updated = $package->refresh();

        $this->assertEquals('Second shelf', $updated->position);
    }

    public function test_delete_package()
    {
        $package = Package::query()->create([
            'stock_id' => 1,
            'code' => 77880,
            'position' => 'somewhere',
            'state' => PackageStateEnum::STORED->value
        ]);

        event(new DeletePackageEvent(
            url('api/packages'),
            $package->id,
            $this->token
        ));

        $this->assertNull(Package::query()->find($package->id));
    }

}