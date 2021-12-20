<?php

namespace Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Http\Requests\Package\DeletePackage;
use Http\Requests\Package\IndexPackage;
use Http\Requests\Package\StorePackage;
use Http\Requests\Package\UpdatePackage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Repositories\PackageRepository;

class PackageController extends Controller
{
    public function __construct(
        private readonly PackageRepository $packageRepository
    ) { }

    public function index(IndexPackage $request): Collection
    {
        return $this->packageRepository->getAll(['*'], 'state');
    }

    public function store(StorePackage $request): Model
    {
        return $this->packageRepository->create($request->all());
    }

    public function update(UpdatePackage $request, int $id): Model
    {
        return $this->packageRepository->update($id, $request->all());
    }

    public function find(int $id): Model
    {
        return $this->packageRepository->find($id);
    }

    public function delete(DeletePackage $request, int $id): bool
    {
        return $this->packageRepository->delete($id);
    }
}