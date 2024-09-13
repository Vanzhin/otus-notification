<?php
declare(strict_types=1);

namespace App\Notifications\Domain\Aggregate\Notification;

use App\Shared\Domain\Service\UlidService;

class Notification
{
    private readonly string $ulid;
    private \DateTimeImmutable $createdAt;


    public function __construct(
        private readonly string              $message,
        private readonly string              $userUlid,
        private readonly ?NotificationDriver $driver,
    )
    {
        $this->ulid = UlidService::generate();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getDriver(): NotificationDriver
    {
        return $this->driver;
    }

    public function getUserUlid(): string
    {
        return $this->userUlid;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}