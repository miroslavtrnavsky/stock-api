<?php

namespace Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Repositories\PackageRepository;

class PackageController extends Controller
{
    public function __construct(
        private PackageRepository $packageRepository
    ) { }

    public function index(): Collection
    {
        return $this->packageRepository->getAll();
    }

    public function store(Request $request): Model
    {
        return $this->packageRepository->create($request->all());
    }

    public function update(int $id, Request $request): Model
    {
        return $this->packageRepository->update($id, $request->all());
    }

    public function find(int $id): Model
    {
        return $this->packageRepository->find($id);
    }

    public function delete(int $id): bool
    {
        return $this->packageRepository->delete($id);
    }
}