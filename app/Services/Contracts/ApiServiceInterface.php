<?php

namespace App\Services\Contracts;

use Psr\Http\Message\ResponseInterface;

interface ApiServiceInterface
{
    public function getAll(string $url): ResponseInterface;

    public function create(string $url, array $data): ResponseInterface;

    public function update(string $url, int $id, array $data): ResponseInterface;

    public function delete(string $url, int $id): ResponseInterface;
}