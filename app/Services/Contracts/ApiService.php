<?php

namespace App\Services\Contracts;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class ApiService
{
    /**
     * @param string $url
     * @param array $data
     * @param string $token
     * @return PromiseInterface|Response
     */
    protected function postRequest(string $url, array $data, string $token): PromiseInterface|Response
    {
        return Http::withToken($token)->post($url, $data);
    }

    /**
     * @param string $url
     * @param array $data
     * @param string $token
     * @return PromiseInterface|Response
     */
    protected function putRequest(string $url, array $data, string $token): PromiseInterface|Response
    {
        return Http::withToken($token)->put($url, [
            'form_params' => $data
        ]);
    }

    /**
     * @param string $url
     * @param string $token
     * @return PromiseInterface|Response
     */
    protected function getRequest(string $url, string $token): PromiseInterface|Response
    {
        return Http::withToken($token)->get($url);
    }

    /**
     * @param string $url
     * @param string $token
     * @return PromiseInterface|Response
     */
    protected function deleteRequest(string $url, string $token): PromiseInterface|Response
    {
        return Http::withToken($token)->delete($url);
    }

    /**
     * @param string $url
     * @param string $token
     * @return PromiseInterface|Response
     */
    public function getAll(string $url, string $token): PromiseInterface|Response
    {
        return $this->getRequest($url, $token);
    }

    /**
     * @param string $url
     * @param array $data
     * @param string $token
     * @return PromiseInterface|Response
     */
    public function create(string $url, array $data, string $token): PromiseInterface|Response
    {
        return $this->postRequest($url, $data, $token);
    }

    /**
     * @param string $url
     * @param int $id
     * @param array $data
     * @param string $token
     * @return PromiseInterface|Response
     */
    public function update(string $url, int $id, array $data, string $token): PromiseInterface|Response
    {
        return $this->putRequest($url . DIRECTORY_SEPARATOR . $id, $data, $token);
    }

    /**
     * @param string $url
     * @param int $id
     * @param string $token
     * @return PromiseInterface|Response
     */
    public function delete(string $url, int $id, string $token): PromiseInterface|Response
    {
        return $this->deleteRequest($url . DIRECTORY_SEPARATOR . $id, $token);
    }
}