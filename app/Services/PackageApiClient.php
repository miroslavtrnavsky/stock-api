<?php

namespace App\Services;

use App\Services\Contracts\ApiService;
use App\Services\Contracts\ApiServiceInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class PackageApiClient extends ApiService implements ApiServiceInterface
{
    /**
     * @param string $url
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getAll(string $url): ResponseInterface
    {
        return $this->getCall($url);
    }

    /**
     * @param string $url
     * @param array $data
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function create(string $url, array $data): ResponseInterface
    {
        return $this->postCall($url, $data);
    }

    /**
     * @param string $url
     * @param int $id
     * @param array $data
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function update(string $url, int $id, array $data): ResponseInterface
    {
        return $this->postCall($url . DIRECTORY_SEPARATOR . $id, $data);
    }

    /**
     * @param string $url
     * @param int $id
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function delete(string $url, int $id): ResponseInterface
    {
        return $this->deleteCall($url . DIRECTORY_SEPARATOR . $id);
    }
}