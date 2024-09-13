<?php
declare(strict_types=1);


namespace App\Notifications\Domain\Aggregate\Notification;

enum NotificationDriver: string
{
    case EMAIL = 'email';

    case SHORT_MESSAGE = 'sms';

    case TELEGRAM = 'telegram';
}