<?php

declare(strict_types=1);

namespace App\Notifications\Application\UseCase\Command\CreateNotification;

use App\Shared\Application\Command\Command;

readonly class CreateNotificationCommand extends Command
{
    public function __construct(
        public string  $message,
        public string  $userUlid,
        public ?string $driver,
    )
    {
    }
}
