<?php

namespace Repositories;

use App\Models\Stock;
use Repositories\Contracts\BaseRepository;

final class StockRepository extends BaseRepository
{
    protected function getModelClassName(): string
    {
        return Stock::class;
    }
}