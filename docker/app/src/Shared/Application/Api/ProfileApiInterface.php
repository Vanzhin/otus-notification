<?php
declare(strict_types=1);


namespace App\Shared\Application\Api;

use Psr\Http\Message\ResponseInterface;

interface ProfileApiInterface
{
    public function getProfileByUserId(string $userId): ResponseInterface;
}