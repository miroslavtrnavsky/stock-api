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

    /**
     * @param IndexPackage $request
     * @return Collection
     */
    public function index(IndexPackage $request): Collection
    {
        return $this->packageRepository->getAll(['*'], 'state');
    }

    /**
     * @param StorePackage $request
     * @return Model
     */
    public function store(StorePackage $request): Model
    {
        $package = $this->packageRepository->create($request->validated());

        if ($package) {
            app(NotifyPackageCreated::class)->execute($package);
        }

        return $package;
    }

    /**
     * @param UpdatePackage $request
     * @param int $id
     * @return Model
     */
    public function update(UpdatePackage $request, int $id): Model
    {
        return $this->packageRepository->update($id, $request->validated());
    }

    /**
     * @param int $id
     * @return Model
     */
    public function show(int $id): Model
    {
        return $this->packageRepository->find($id);
    }

    /**
     * @param DeletePackage $request
     * @param int $id
     * @return bool
     */
    public function destroy(DeletePackage $request, int $id): bool
    {
        return $this->packageRepository->delete($id);
    }
}