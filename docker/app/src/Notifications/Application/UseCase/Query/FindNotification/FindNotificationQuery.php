<?php

declare(strict_types=1);

namespace App\Notifications\Application\UseCase\Query\FindNotification;

use App\Shared\Application\Query\Query;

readonly class FindNotificationQuery extends Query
{
    public function __construct(public string $notificationUlid)
    {
    }
}
