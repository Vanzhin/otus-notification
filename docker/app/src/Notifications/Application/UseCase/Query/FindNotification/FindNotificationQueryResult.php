<?php

declare(strict_types=1);

namespace App\Notifications\Application\UseCase\Query\FindNotification;

use App\Notifications\Application\DTO\NotificationDTO;

readonly class FindNotificationQueryResult
{
    public function __construct(public ?NotificationDTO $notification)
    {
    }
}
