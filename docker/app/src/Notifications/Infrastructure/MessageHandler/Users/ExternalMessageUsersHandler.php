<?php
declare(strict_types=1);

namespace App\Notifications\Infrastructure\MessageHandler\Users;


use App\Notifications\Application\UseCase\Command\CreateNotification\CreateNotificationCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Service\ProfileServiceInterface;
use App\Shared\Domain\Message\ExternalMessage;

final readonly class ExternalMessageUsersHandler
{
    public function __construct(
        private CommandBusInterface     $commandBus,
        private ProfileServiceInterface $profileService,
    )
    {
    }

    public function handle(ExternalMessage $message): void
    {
        $userId = $message->getEventData()['user_id'];
        $response = $this->profileService->getProfile($userId);

        if ($response->isSuccess()) {
            $profileData = $response->getData();
            $name = $profileData['name'];
            $command = new CreateNotificationCommand(
                sprintf('Hello %s. Welcome to the service.', $name ?? 'User without name'),
                $userId,
                null
            );
            $this->commandBus->execute($command);
        }
    }
}