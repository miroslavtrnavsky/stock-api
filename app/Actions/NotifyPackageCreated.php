<?php

namespace App\Actions;

use App\Enums\UserRoleEnum;
use App\Models\Package;
use App\Models\User;
use App\Notifications\PackageCreated;

class NotifyPackageCreated
{
    /**
     * @param Package $package
     */
    public function execute(Package $package): void
    {
        $warehousemans = User::query()->onlyWarehousemans()->get();

        $warehousemans->each(fn (User $warehouseman) =>
            $warehouseman->notify(new PackageCreated($warehouseman, $package))
        );
    }
}