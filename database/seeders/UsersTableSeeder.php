<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $admin */
        $admin = User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@stock-api.com',
            'code' => 81472,
            'password' => bcrypt('admin')
        ]);

        $admin->assignRole(UserRoleEnum::ADMIN->value);

        /** @var User $wareHouseman */
        $wareHouseman = User::query()->create([
            'name' => 'Warehouseman',
            'email' => 'warehouseman@stock-api.com',
            'code' => 81400,
            'password' => bcrypt('warehouseman')
        ]);

        $wareHouseman->assignRole(UserRoleEnum::WAREHOUSEMAN->value);
    }
}
