<?php
declare(strict_types=1);


namespace App\Shared\Infrastructure\Api\Profile;

use App\Shared\Application\Api\ProfileApiInterface;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

final class Api extends Client implements ProfileApiInterface
{
    private const string URI_GET_MY_PROFILE = '/profile/my';


    public function getProfileByUserId(string $userId): ResponseInterface
    {
        return $this->get(self::URI_GET_MY_PROFILE,
            [
                RequestOptions::HEADERS => $this->addXUserHeader($userId),
            ]
        );
    }

    private function addXUserHeader(string $userId, array $headers = []): array
    {
        $headers['X-User'] = json_encode(['ulid' => $userId]);
        return $headers;
    }
}