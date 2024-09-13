<?php

declare(strict_types=1);

namespace App\Notifications\Application\UseCase\Query\GetPagedNotifications;

use App\Shared\Domain\Repository\Pager;

readonly class GetPagedNotificationsQueryResult
{
    public function __construct(
        public array $notifications,
        public Pager $pager
    ) {
    }
}
