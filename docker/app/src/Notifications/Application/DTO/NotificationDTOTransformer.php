<?php

declare(strict_types=1);

namespace App\Notifications\Application\DTO;


use App\Notifications\Domain\Aggregate\Notification\Notification;

class NotificationDTOTransformer
{
    public function fromNotificationEntity(Notification $notification): NotificationDTO
    {
        $dto = new NotificationDTO();
        $dto->ulid = $notification->getUlid();
        $dto->message = $notification->getMessage();
        $dto->driver = $notification->getDriver()->value;
        $dto->user_ulid = $notification->getUserUlid();
        $dto->created_at = $notification->getCreatedAt()->format(DATE_ATOM);

        return $dto;
    }

    public function fromNotificationEntityList(array $entities): array
    {
        /** @var NotificationDTO[] $notification */
        $notifications = [];
        foreach ($entities as $entity) {
            $notifications[] = $this->fromNotificationEntity($entity);
        }

        return $notifications;
    }
}
