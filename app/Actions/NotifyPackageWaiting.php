<?php

namespace App\Actions;

use App\Enums\UserRoleEnum;
use App\Models\Package;
use App\Models\User;
use App\Notifications\PackageCreated;

class NotifyPackageWaiting
{
    public function execute(Package $package): void
    {
        /** @var User $warehouseman */
        $warehousemans = User::query()->roles()->where('name', UserRoleEnum::WAREHOUSEMAN->value)->get();

        $warehousemans->each(fn (User $warehouseman) =>
            $warehouseman->notify(new PackageCreated($warehouseman, $package))
        );
    }
}