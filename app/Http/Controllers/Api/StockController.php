<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\DeleteStock;
use App\Http\Requests\Stock\StoreStock;
use App\Http\Requests\Stock\UpdateStock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\StockRepository;

class StockController extends Controller
{
    public function __construct(
        private readonly StockRepository $stockRepository
    ) { }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->stockRepository->getAll();
    }

    /**
     * @param StoreStock $request
     * @return Model
     */
    public function store(StoreStock $request): Model
    {
        return $this->stockRepository->create($request->validated());
    }

    /**
     * @param UpdateStock $updateStock
     * @param int $id
     * @return Model
     */
    public function update(UpdateStock $updateStock, int $id): Model
    {
        return $this->stockRepository->update($id, $updateStock->validated());
    }

    /**
     * @param int $id
     * @return Model
     */
    public function show(int $id): Model
    {
        return $this->stockRepository->find($id);
    }

    /**
     * @param DeleteStock $deleteStock
     * @param int $id
     * @return bool
     */
    public function destroy(DeleteStock $deleteStock, int $id): bool
    {
        return $this->stockRepository->delete($id);
    }
}