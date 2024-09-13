<?php

declare(strict_types=1);

namespace App\Notifications\Application\UseCase\Query\GetPagedNotifications;

use App\Shared\Application\Query\Query;
use App\Shared\Domain\Repository\Pager;

readonly class GetPagedNotificationsQuery extends Query
{
    public function __construct(public Pager $pager, public ?string $user_ulid = null)
    {
    }
}
