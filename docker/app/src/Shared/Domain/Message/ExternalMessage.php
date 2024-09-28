<?php
declare(strict_types=1);


namespace App\Shared\Domain\Message;

readonly class ExternalMessage implements MessageInterface
{
    public function __construct(
        private string $event_type,
        private array  $event_data
    )
    {
    }

    public function getEventType(): string
    {
        return $this->event_type;
    }

    public function getEventData(): array
    {
        return $this->event_data;
    }
}