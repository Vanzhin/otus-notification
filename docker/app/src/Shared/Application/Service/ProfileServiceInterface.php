<?php
declare(strict_types=1);


namespace App\Shared\Application\Service;

use App\Shared\Domain\Service\Profile\Response\BasicResponse;


interface ProfileServiceInterface
{
    public function getProfile(string $userId): BasicResponse;

}