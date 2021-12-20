<?php

namespace App\Services\Contracts;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

abstract class ApiService
{
    public function __construct(
        protected ApiServiceInterface $apiService,
        private ?Client $client = null
    ) {
        $this->client ??= new Client();
    }

    /**
     * @param string $url
     * @param array $data
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function postRequest(string $url, array $data): ResponseInterface
    {
        return $this->client->request('POST', $url, [
            'form_params' => $data
        ]);
    }

    /**
     * @param string $url
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function getRequest(string $url): ResponseInterface
    {
        return $this->client->request('GET', $url);
    }

    /**
     * @param string $url
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function deleteRequest(string $url): ResponseInterface
    {
        return $this->client->request('DELETE', $url);
    }

    /**
     * @param string $url
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getAll(string $url): ResponseInterface
    {
        return $this->getRequest($url);
    }

    /**
     * @param string $url
     * @param array $data
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function create(string $url, array $data): ResponseInterface
    {
        return $this->postRequest($url, $data);
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
        return $this->postRequest($url . DIRECTORY_SEPARATOR . $id, $data);
    }

    /**
     * @param string $url
     * @param int $id
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function delete(string $url, int $id): ResponseInterface
    {
        return $this->deleteRequest($url . DIRECTORY_SEPARATOR . $id);
    }
}