<?php

namespace Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function getAll(): Collection;

    public function find(int $id): Model;

    public function create(array $attributes): Model;

    public function update(int $id, array $attributes = []): Model;

    public function delete(int $id): bool;
}