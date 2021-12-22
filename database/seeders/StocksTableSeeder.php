<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::query()->create([
            'name' => 'Stock 1',
            'street' => 'Street',
            'street_no' => '25',
            'zip' => '12345',
            'city' => 'Bratislava',
            'type' => self::class
        ]);

        Stock::query()->create([
            'name' => 'Stock 2',
            'street' => 'Street',
            'street_no' => '44',
            'zip' => '66600',
            'city' => 'London',
            'type' => self::class
        ]);
    }
}
