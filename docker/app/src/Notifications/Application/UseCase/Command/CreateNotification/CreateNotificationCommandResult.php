<?php

declare(strict_types=1);

namespace App\Notifications\Application\UseCase\Command\CreateNotification;

class CreateNotificationCommandResult
{
    public function __construct(
        public string $ulid,
    )
    {
    }
}
