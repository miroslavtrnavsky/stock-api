<?php

namespace Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Http\Requests\Stock\DeleteStock;
use Http\Requests\Stock\StoreStock;
use Http\Requests\Stock\UpdateStock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Repositories\StockRepository;

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
        return $this->stockRepository->create($request->all());
    }

    public function update(UpdateStock $updateStock, int $id): Model
    {
        return $this->stockRepository->update($id, $updateStock->all());
    }

    public function find(int $id): Model
    {
        return $this->stockRepository->find($id);
    }

    public function delete(DeleteStock $deleteStock, int $id): bool
    {
        return $this->stockRepository->delete($id);
    }
}