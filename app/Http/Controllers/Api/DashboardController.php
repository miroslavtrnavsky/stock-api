<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\IndexPackage;
use App\Repositories\PackageRepository;
use Http\Requests\Activity\IndexActivity;
use Illuminate\Database\Eloquent\Collection;
use OwenIt\Auditing\Models\Audit;

class DashboardController extends Controller
{
    public function __construct(
        private readonly PackageRepository $packageRepository
    ) { }

    /**
     * @param IndexPackage $request
     * @return Collection
     */
    public function getPackagesByState(IndexPackage $request): Collection
    {
        return $this->packageRepository->getAll(['*'], 'state');
    }

    /**
     * @param IndexActivity $request
     * @return Collection
     */
    public function getActivities(IndexActivity $request): Collection
    {
        return Audit::query()->get();       //TODO: make a resource with specified attributes (not specified in the assignment)
    }
}