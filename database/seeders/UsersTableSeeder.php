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
            'email' => 'admin@wbpo.com',
            'code' => 81472,
            'password' => bcrypt('stockadmin')
        ]);

        $admin->assignRole(UserRoleEnum::ADMIN->value);

        $users = User::factory(10)->create();
        $users->each(fn (User $user) => $user->assignRole(UserRoleEnum::WAREHOUSEMAN->value));
    }
}
