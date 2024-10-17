<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Profile;

use App\Shared\Application\Api\ProfileApiInterface;
use App\Shared\Application\Service\ProfileServiceInterface;
use App\Shared\Domain\Service\Profile\Mappers\ResponseMapper;
use App\Shared\Domain\Service\Profile\Response\BasicResponse;

class ProfileService implements ProfileServiceInterface
{
    public function __construct(private readonly ProfileApiInterface $api, private readonly ResponseMapper $mapper)
    {
    }

    public function getProfile(string $userId): BasicResponse
    {
        $profile = $this->api->getProfileByUserId($userId);
        return $this->mapper->buildBasicResponse($profile);
    }
}