<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ApiServiceInterface
{
    function create(array $data): Model;

    public  function update(int $id, array $data): Model;

    public function delete($id): bool;

    public function getAll($filter): Collection;
}