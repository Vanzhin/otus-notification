<?php
declare(strict_types=1);

namespace App\Shared\Domain\Service\Profile\Mappers;

use App\Shared\Domain\Service\Profile\Response\BasicResponse;
use Psr\Http\Message\ResponseInterface;

class ResponseMapper
{
    private function build(ResponseInterface $response)
    {
        return json_decode($response->getBody()->__toString(), true);
    }

    public function buildBasicResponse(ResponseInterface $response): BasicResponse
    {
        $build = $this->build($response);
        return new BasicResponse(
            $response->getStatusCode(),
            $build['data'] ?? null,
            $build['message'] ?? null,
            $build['errors'] ?? null,
        );
    }

    public function buildGetAccountBalanceResponse(ResponseInterface $response): BasicResponse
    {
        $build = $this->build($response);
        return new BasicResponse(
            $response->getStatusCode(),
            (float)$build['data']['account']['balance'] ?? null,
            $build['message'] ?? null,
            $build['errors'] ?? null,
        );
    }
}