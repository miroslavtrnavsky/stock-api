<?php

namespace App\Http\Controllers\Api;

use App\Actions\NotifyPackageCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Package\DeletePackage;
use App\Http\Requests\Package\IndexPackage;
use App\Http\Requests\Package\StorePackage;
use App\Http\Requests\Package\UpdatePackage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\PackageRepository;

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
        $package = $this->packageRepository->create($request->validated());

        if ($package) {
            app(NotifyPackageCreated::class)->execute($package);
        }

        return $package;
    }

    public function update(UpdatePackage $request, int $id): Model
    {
        return $this->packageRepository->update($id, $request->validated());
    }

    public function show(int $id): Model
    {
        return $this->packageRepository->find($id);
    }

    public function destroy(DeletePackage $request, int $id): bool
    {
        return $this->packageRepository->delete($id);
    }
}