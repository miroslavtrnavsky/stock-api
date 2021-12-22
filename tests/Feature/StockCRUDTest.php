<?php

namespace Tests\Feature;

use App\Events\Stock\CreateStockEvent;
use App\Events\Stock\DeleteStockEvent;
use App\Events\Stock\IndexStockEvent;
use App\Events\Stock\UpdateStockEvent;
use App\Models\Stock;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class StockCRUDTest extends TestCase
{
    CONST TEST_USER_CODE = 81472;
    CONST TEST_USER_PASSWORD = 'stockadmin';

    private string $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->token = Http::post(url('api/login'), ['code' => self::TEST_USER_CODE, 'password' => self::TEST_USER_PASSWORD])->json('token');
    }

    public function test_index_stock()
    {
        Event::fake();

        event(new IndexStockEvent(
            url('api/stocks'),
            $this->token
        ));

        Event::assertDispatched(IndexStockEvent::class);
    }

    public function test_create_stock()
    {
        $data = [
            'name' => 'Test stock',
            'street' => 'Trees',
            'street_no' => '22',
            'zip' => '11111',
            'city' => 'Bratislava',
            'type' => self::class
        ];

        event(new CreateStockEvent(
            url('api/stocks'),
            $data,
            $this->token
        ));

        $this->assertDatabaseHas(Stock::class, $data);
    }

    public function test_update_stock()
    {
        $stock = Stock::query()->find(1);

        $data = [
            'name' => 'Big stock',
            'street' => 'Rivers',
            'street_no' => '25',
            'zip' => '99999',
            'city' => 'London',
            'type' => self::class
        ];

        event(new UpdateStockEvent(
            url('api/stocks'),
            $stock->id,
            $data,
            $this->token
        ));

        $updated = $stock->refresh();

        $this->assertEquals($data, [
            'name' => $updated->name,
            'street' => $updated->street,
            'street_no' => $updated->street_no,
            'zip' => $updated->zip,
            'city' => $updated->city,
            'type' => $updated->type
        ]);
    }

    public function test_delete_stock()
    {
        $stock = Stock::query()->create([
            'name' => 'test',
            'street' => 'test',
            'street_no' => '22',
            'zip' => '12343',
            'city' => 'test',
            'type' => 'test'
        ]);

        event(new DeleteStockEvent(
            url('api/stocks'),
            $stock->id,
            $this->token
        ));

        $this->assertNull(Stock::query()->find($stock->id));
    }
}