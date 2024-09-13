<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class RequestHeadersService
{
    private const USER_HEADER = 'X-User';

    private ?string $userUlid;

    public function __construct(private readonly RequestStack $requestStack)
    {
        $this->getUserUlidFromRequest();
    }

    public function getUserUlid(): ?string
    {
        return $this->userUlid;
    }

    private function getUserUlidFromRequest(): void
    {
        $userData = $this->requestStack->getCurrentRequest()->headers->get(self::USER_HEADER, '');
        $userData = json_decode($userData, true);
        $this->userUlid = $userData['ulid'] ?? null;
    }
}