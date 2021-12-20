<?php

namespace App\Services;

use App\Enums\PackageStateEnum;
use App\Services\Contracts\ApiService;
use App\Services\Contracts\ApiServiceInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class PackageApiClient extends ApiService implements ApiServiceInterface
{
    /**
     * @param string $url
     * @param int $id
     * @param string $newPosition
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function updatePackagePosition(string $url, int $id, string $newPosition): ResponseInterface
    {
        return $this->update($url, $id, ['position' => $newPosition]);
    }

    /**
     * @param string $url
     * @param int $id
     * @param PackageStateEnum $newState
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function updatePackageStatus(string $url, int $id, PackageStateEnum $newState): ResponseInterface
    {
        return $this->update($url, $id, ['state' => $newState->value]);
    }

    /**
     * @param string $url
     * @param int $id
     * @param int $newStockId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function updatePackageStock(string $url, int $id, int $newStockId): ResponseInterface
    {
        return $this->update($url, $id, ['stock_id' => $newStockId]);
    }
}