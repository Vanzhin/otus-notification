<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Profile\Response;

class BasicResponse implements \JsonSerializable
{
    public function __construct(
        private int     $httpStatus,
        private mixed   $data,
        private ?string $message,
        private ?array  $errors
    )
    {
    }

    /**
     * @return array|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function isSuccess(): bool
    {
        return $this->getHttpStatus() >= 200 && $this->getHttpStatus() < 300;
    }

    /**
     * @return int
     */
    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isEmptySet(): bool
    {
        return [] === $this->data;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}