<?php

namespace Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Repositories\StockRepository;

class StockController extends Controller
{
    public function __construct(
        private StockRepository $stockRepository
    ) { }

    public function index(): Collection
    {
        return $this->stockRepository->getAll();
    }

    public function store(Request $request): Model
    {
        return $this->stockRepository->create($request->all());
    }

    public function update(int $id, Request $request): Model
    {
        return $this->stockRepository->update($id, $request->all());
    }

    public function find(int $id): Model
    {
        return $this->stockRepository->find($id);
    }

    public function delete(int $id): bool
    {
        return $this->stockRepository->delete($id);
    }
}