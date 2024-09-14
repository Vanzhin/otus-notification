<?php
declare(strict_types=1);


namespace App\Notifications\Domain\Repository;

use App\Notifications\Domain\Aggregate\Notification\Notification;
use App\Shared\Domain\Repository\PaginationResult;

interface NotificationRepositoryInterface
{
    public function save(Notification $notification): void;

    public function findByFilter(NotificationFilter $filter): PaginationResult;

    public function findOneByUlid(string $ulid): ?Notification;

}