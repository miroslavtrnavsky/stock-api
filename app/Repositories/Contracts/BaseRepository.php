<?php

namespace App\Repositories\Contracts;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model|EloquentBuilder|QueryBuilder $model;

    public function __construct(
        private Container $app,
    ) {
        $this->model = $this->app->make($this->getModelClassName());
    }

    abstract protected function getModelClassName(): string;

    /**
     * Provides QueryBuilder
     *
     * @return Model|EloquentBuilder|QueryBuilder
     */
    public function getQueryBuilder(): Model|EloquentBuilder|QueryBuilder
    {
        return $this->model;
    }

    public function getAll(
        array $columns = ['*'],
        string $orderBy = null,
        string $order = "desc",
        int $limit = null
    ): Collection
    {
        $query = $this->getQueryBuilder();

        if (! is_null($orderBy)) {
            $query = $query->orderBy($orderBy, $order);
        }

        if (intval($limit) > 0) {
            $query = $query->limit(intval($limit));
        }

        return $query->get($columns);
    }

    public function find(int $id, array $columns = ['*']): ?Model
    {
        return $this->getQueryBuilder()->find($id);
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes = []): Model
    {
        return $this->model->find($id)->update($attributes);
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }
}