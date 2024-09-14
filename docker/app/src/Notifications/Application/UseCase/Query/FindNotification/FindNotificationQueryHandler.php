<?php

declare(strict_types=1);

namespace App\Notifications\Application\UseCase\Query\FindNotification;

use App\Notifications\Application\DTO\NotificationDTOTransformer;
use App\Notifications\Domain\Repository\NotificationRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

readonly class FindNotificationQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private NotificationRepositoryInterface $notificationRepository,
        private NotificationDTOTransformer      $notificationDTOTransformer,
    )
    {
    }

    public function __invoke(FindNotificationQuery $query): FindNotificationQueryResult
    {
        $notification = $this->notificationRepository->findOneByUlid($query->notificationUlid);
        if (!$notification) {
            return new FindNotificationQueryResult(null);
        }
        $notificationDTO = $this->notificationDTOTransformer->fromNotificationEntity($notification);

        return new FindNotificationQueryResult($notificationDTO);
    }
}
