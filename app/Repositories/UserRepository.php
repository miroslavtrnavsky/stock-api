<?php

namespace Repositories;

use App\Models\User;
use Repositories\Contracts\BaseRepository;

final class UserRepository extends BaseRepository
{
    protected function getModelClassName(): string
    {
        return User::class;
    }
}