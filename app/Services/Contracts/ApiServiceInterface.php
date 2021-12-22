<?php

namespace App\Services\Contracts;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

interface ApiServiceInterface
{
    public function getAll(string $url, string $token): PromiseInterface|Response;

    public function create(string $url, array $data, string $token): PromiseInterface|Response;

    public function update(string $url, int $id, array $data, string $token): PromiseInterface|Response;

    public function delete(string $url, int $id, string $token): PromiseInterface|Response;
}