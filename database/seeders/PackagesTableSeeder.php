<?php

namespace Database\Seeders;

use App\Enums\PackageStateEnum;
use App\Models\Package;
use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::query()->create([
            'stock_id' => 1,
            'code' => 99999,
            'position' => 'Shelf 1',
            'state' => PackageStateEnum::NEW->value
        ]);

        Package::query()->create([
            'stock_id' => 1,
            'code' => 88888,
            'position' => 'Shelf 2',
            'state' => PackageStateEnum::STORED->value
        ]);

        Package::query()->create([
            'stock_id' => 2,
            'code' => 77777,
            'position' => 'Shelf 3',
            'state' => PackageStateEnum::STORED->value
        ]);
    }
}
