<?php

namespace App\Repositories;

use App\Models\Package;
use App\Repositories\Contracts\BaseRepository;

final class PackageRepository extends BaseRepository
{
    protected function getModelClassName(): string
    {
        return Package::class;
    }
}