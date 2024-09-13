<?php
declare(strict_types=1);


namespace App\Notifications\Infrastructure\Controller;

use App\Notifications\Application\UseCase\Command\CreateNotification\CreateNotificationCommand;
use App\Notifications\Application\UseCase\Query\GetPagedNotifications\GetPagedNotificationsQuery;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Domain\Repository\Pager;
use App\Shared\Domain\Service\RequestHeadersService;
use App\Shared\Infrastructure\Exception\AppException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('notification', name: 'app_api_notification_')]
class NotificationController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface     $queryBus,
        private readonly CommandBusInterface   $commandBus,
        private readonly RequestHeadersService $headersService,
    )
    {
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $message = $data['message'] ?? null;
        $userUlid = $data['user_ulid'] ?? null;
        $driver = $data['driver'] ?? null;

        if (!$message || !$userUlid) {
            throw new AppException('No message or user id provided.');
        }
        $command = new CreateNotificationCommand($message, $userUlid, $driver);
        $result = $this->commandBus->execute($command);

        return new JsonResponse($result);
    }

    #[Route('/list', name: 'list', methods: ['POST'])]
    public function list(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $userUlid = $data['filter']['user_ulid'] ?? null;
        $page = (int)$request->query->get('page');
        $limit = (int)$request->query->get('limit');
        $query = new GetPagedNotificationsQuery(Pager::fromPage($page, $limit), $userUlid,);
        $result = $this->queryBus->execute($query);

        return new JsonResponse($result);
    }
}

