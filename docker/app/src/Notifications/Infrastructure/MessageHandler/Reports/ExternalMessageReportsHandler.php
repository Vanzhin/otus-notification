<?php
declare(strict_types=1);

namespace App\Notifications\Infrastructure\MessageHandler\Reports;


use App\Notifications\Application\UseCase\Command\CreateNotification\CreateNotificationCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Domain\Message\ExternalMessage;

final readonly class ExternalMessageReportsHandler
{
    public function __construct(
        private CommandBusInterface $commandBus,
    )
    {
    }

    public function handle(ExternalMessage $message): void
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
}