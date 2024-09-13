<?php

declare(strict_types=1);

namespace App\Notifications\Application\DTO;

class NotificationDTO
{
    public string $ulid;
    public string $message;
    public string $user_ulid;
    public string $driver;
    public string $created_at;
}
