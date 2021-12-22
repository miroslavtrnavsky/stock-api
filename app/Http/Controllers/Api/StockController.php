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

    public function index(): Collection
    {
        return $this->stockRepository->getAll();
    }

    public function store(StoreStock $request): Model
    {
        \Log::info($request->validated());
        return $this->stockRepository->create($request->validated());
    }

    public function update(UpdateStock $updateStock, int $id): Model
    {
        return $this->stockRepository->update($id, $updateStock->validated());
    }

    public function show(int $id): Model
    {
        return $this->stockRepository->find($id);
    }

    public function destroy(DeleteStock $deleteStock, int $id): bool
    {
        return $this->stockRepository->delete($id);
    }
}