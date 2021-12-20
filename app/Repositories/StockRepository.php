<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Repositories\Contracts\BaseRepository;

final class StockRepository extends BaseRepository
{
    protected function getModelClassName(): string
    {
        return Stock::class;
    }
}