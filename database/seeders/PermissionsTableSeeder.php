<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    CONST WAREHOUSEMAN_PERMISSIONS = [
        'package.read',
        'package.update'
    ];

    CONST ADMIN_PERMISSIONS = [
        'user.create',
        'user.update',
        'stock.read',
        'stock.create',
        'stock.update',
        'stock.delete',
        'package.read',
        'package.create',
        'package.update',
        'package.delete',
        'activity.read'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(self::ADMIN_PERMISSIONS)->each(function ($permissionName) {
            /** @var Permission $permission */
            $permission = Permission::create(['name' => $permissionName]);
            $permission->assignRole(UserRoleEnum::ADMIN->value);

            if (in_array($permissionName, self::WAREHOUSEMAN_PERMISSIONS)) {
                $permission->assignRole(UserRoleEnum::WAREHOUSEMAN->value);
            }
        });
    }
}
