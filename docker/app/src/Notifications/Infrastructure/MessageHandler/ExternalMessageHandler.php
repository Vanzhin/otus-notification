<?php
declare(strict_types=1);

namespace App\Notifications\Infrastructure\MessageHandler;


use App\Notifications\Application\UseCase\Command\CreateNotification\CreateNotificationCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Message\MessageHandlerInterface;
use App\Shared\Domain\Message\ExternalMessage;

final readonly class ExternalMessageHandler implements MessageHandlerInterface
{
    public function __construct(
        private CommandBusInterface $commandBus,
    )
    {
    }

    public function __invoke(ExternalMessage $message)
    {
        $command = new CreateNotificationCommand(
            sprintf('Report status changed to \'%s\'. (Report ID %s)', $message->getEventType(), $message->getEventData()['id']),
            $message->getEventData()['creator_id'],
            null
        );
        $this->commandBus->execute($command);

        if (in_array($message->getEventType(), ['created', 'send_to_approve'])) {
            $command = new CreateNotificationCommand(
                sprintf('Report status changed to \'%s\'. (Report ID %s)', $message->getEventType(), $message->getEventData()['id']),
                $message->getEventData()['approver_id'],
                null
            );
            $this->commandBus->execute($command);
        }
    }

    private function messageMap(string $eventType): string
    {
        return match ($eventType) {
            'payment await' => 'Your order in the amount of %g is awaiting payment.',
            'paid' => 'Your order for the amount of %g has been paid for.',
            default => 'Your order for the amount of %g has been created.',
        };
    }
}