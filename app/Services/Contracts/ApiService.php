<?php

namespace App\Services\Contracts;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class ApiService
{
    public function __construct(
        protected ApiServiceInterface $apiService,
        private ?Client $client = null
    ) {
        $this->client ??= new Client();
    }

    abstract public function getAll(string $url): ResponseInterface;
    abstract public function create(string $url,array $data): ResponseInterface;
    abstract public function update(string $url, int $id, array $data): ResponseInterface;
    abstract public function delete(string $url, int $id): ResponseInterface;

    /**
     * @param string $url
     * @param array $data
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function postCall(string $url, array $data): ResponseInterface
    {
        return $this->client->request('POST', $url, [
            'form_params' => $data
        ]);
    }

    /**
     * @param string $url
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getCall(string $url): ResponseInterface
    {
        return $this->client->request('GET', $url);
    }

    /**
     * @param string $url
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function deleteCall(string $url): ResponseInterface
    {
        return $this->client->request('DELETE', $url);
    }
}