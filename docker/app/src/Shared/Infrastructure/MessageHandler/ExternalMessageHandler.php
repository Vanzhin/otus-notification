<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\MessageHandler;


use App\Notifications\Application\UseCase\Command\CreateNotification\CreateNotificationCommand;
use App\Shared\Application\Message\MessageHandlerInterface;
use App\Shared\Application\Command\CommandBusInterface;
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
            sprintf($this->messageMap($message->getEventType()), $message->getEventData()['sum']),
            $message->getEventData()['user_id'],
            null
        );
        $this->commandBus->execute($command);
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