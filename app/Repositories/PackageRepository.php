<?php

namespace Repositories;

use Models\Package;
use Repositories\Contracts\BaseRepository;

final class PackageRepository extends BaseRepository
{
    protected function getModelClassName(): string
    {
        return Package::class;
    }
}