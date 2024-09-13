<?php
declare(strict_types=1);


namespace App\Notifications\Domain\Factory;

use App\Notifications\Domain\Aggregate\Notification\Notification;
use App\Notifications\Domain\Aggregate\Notification\NotificationDriver;

class NotificationFactory
{
    public function create(
        string  $message,
        string  $user_ulid,
        ?string $driver,
    ): Notification
    {
        $notificationDriver = NotificationDriver::EMAIL;

        if ($driver) {
            $notificationDriver = NotificationDriver::from($driver);
        }
        return new Notification(
            $message,
            $user_ulid,
            $notificationDriver,
        );
    }
}