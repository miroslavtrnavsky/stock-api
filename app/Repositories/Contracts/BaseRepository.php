<?php

namespace Repositories\Contracts;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

abstract class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(
        private Container $app,
        protected Model|EloquentBuilder|QueryBuilder $model
    ) {
        $this->model = $this->app->make($this->getModelClassName());
    }

    abstract protected function getModelClassName();

    /**
     * Provides QueryBuilder
     *
     * @return Model|EloquentBuilder|QueryBuilder
     */
    public function getQueryBuilder(): Model|EloquentBuilder|QueryBuilder
    {
        return $this->model;
    }

}