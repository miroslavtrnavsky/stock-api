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
        /** @var User $warehouseman */
        $warehouseman = User::query()->roles()->where('name', UserRoleEnum::WAREHOUSEMAN->value)->first();

        $warehouseman->notify(new PackageCreated($warehouseman, $package));
    }
}