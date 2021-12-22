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

    /**
     * @param array|string[] $columns
     * @param string|null $orderBy
     * @param string $order
     * @param int|null $limit
     * @return Collection
     */
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

    /**
     * @param int $id
     * @param array|string[] $columns
     * @return Model|null
     */
    public function find(int $id, array $columns = ['*']): ?Model
    {
        return $this->getQueryBuilder()->find($id);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return Model
     */
    public function update(int $id, array $attributes = []): Model
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }
}