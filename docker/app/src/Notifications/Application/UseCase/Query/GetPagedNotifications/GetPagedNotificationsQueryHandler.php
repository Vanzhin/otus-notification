<?php

declare(strict_types=1);

namespace App\Notifications\Application\UseCase\Query\GetPagedNotifications;

use App\Endpoints\Domain\Repository\EndpointsFilter;
use App\Notifications\Application\DTO\NotificationDTOTransformer;
use App\Notifications\Domain\Repository\NotificationFilter;
use App\Notifications\Domain\Repository\NotificationRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Repository\Pager;


readonly class GetPagedNotificationsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private NotificationRepositoryInterface $notificationRepository,
        private NotificationDTOTransformer      $notificationDTOTransformer,
    )
    {
    }

    public function __invoke(GetPagedNotificationsQuery $query): GetPagedNotificationsQueryResult
    {
        $filter = new NotificationFilter($query->user_ulid, $query->pager);
        $paginator = $this->notificationRepository->findByFilter($filter);
        $pager = new Pager($query->pager->page, $query->pager->limit, $paginator->total);
        $notifications = $this->notificationDTOTransformer->fromNotificationEntityList($paginator->items);

        return new GetPagedNotificationsQueryResult($notifications, $pager);
    }
}
