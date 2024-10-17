<?php
declare(strict_types=1);

namespace App\Notifications\Infrastructure\MessageHandler;


use App\Notifications\Infrastructure\MessageHandler\Reports\ExternalMessageReportsHandler;
use App\Notifications\Infrastructure\MessageHandler\Users\ExternalMessageUsersHandler;
use App\Shared\Application\Message\MessageHandlerInterface;
use App\Shared\Domain\Message\ExternalMessage;

final readonly class ExternalMessageHandler implements MessageHandlerInterface
{
    public function __construct(
        private ExternalMessageUsersHandler   $externalMessageUsersHandler,
        private ExternalMessageReportsHandler $externalMessageReportsHandler,
    )
    {
    }

    public function __invoke(ExternalMessage $message)
    {
        if (in_array($message->getEventType(), ['user_created'])) {
            $this->externalMessageUsersHandler->handle($message);
            return;
        }
        //все остальное сюда
        $this->externalMessageReportsHandler->handle($message);
    }
}