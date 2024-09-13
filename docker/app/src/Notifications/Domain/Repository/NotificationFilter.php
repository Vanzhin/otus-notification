<?php
declare(strict_types=1);


namespace App\Notifications\Domain\Repository;

use App\Shared\Domain\Repository\Pager;

class NotificationFilter
{
    public function __construct(
        public ?string $user_ulid = null,
        public ?Pager  $pager = null,
    )
    {
        if (!$pager) {
            $this->pager = Pager::fromPage();
        }
    }
}