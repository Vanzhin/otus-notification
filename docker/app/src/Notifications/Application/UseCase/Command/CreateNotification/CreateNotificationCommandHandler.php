<?php

declare(strict_types=1);

namespace App\Notifications\Application\UseCase\Command\CreateNotification;

use App\Notifications\Domain\Factory\NotificationFactory;
use App\Notifications\Domain\Repository\NotificationRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

readonly class CreateNotificationCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private NotificationFactory             $notificationFactory,
        private NotificationRepositoryInterface $notificationRepository,
    )
    {
    }

    public function __invoke(CreateNotificationCommand $command): CreateNotificationCommandResult
    {
        $notification = $this->notificationFactory->create(
            $command->message,
            $command->userUlid,
            $command->driver,
        );
        $this->notificationRepository->save($notification);

        return new CreateNotificationCommandResult(
            $notification->getUlid()
        );
    }
}
