<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class ApiService
{
    public function __construct(protected ApiServiceInterface $apiService)
    { }

    public function getAll($filter): Collection
    {

    }

    public function create(array $data): Model
    {
        return $this->apiService->create($data);
    }

    public function update(int $id, array $data): Model
    {
        return $this->apiService->update($id, $data);
    }

    public function delete($id): bool
    {

    }
}