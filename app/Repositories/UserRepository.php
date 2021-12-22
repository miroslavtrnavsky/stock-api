<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\BaseRepository;

final class UserRepository extends BaseRepository
{
    protected function getModelClassName(): string
    {
        return User::class;
    }
}