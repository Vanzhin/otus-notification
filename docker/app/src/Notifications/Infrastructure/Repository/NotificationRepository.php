<?php
declare(strict_types=1);


namespace App\Notifications\Infrastructure\Repository;

use App\Notifications\Domain\Aggregate\Notification\Notification;
use App\Notifications\Domain\Repository\NotificationFilter;
use App\Notifications\Domain\Repository\NotificationRepositoryInterface;
use App\Shared\Domain\Repository\PaginationResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class NotificationRepository extends ServiceEntityRepository implements NotificationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    #[\Override] public function save(Notification $notification): void
    {
        $this->getEntityManager()->persist($notification);
        $this->getEntityManager()->flush();
    }
    public function findByFilter(NotificationFilter $filter): PaginationResult
    {
        $qb = $this->createQueryBuilder('n');

        if ($filter->user_ulid) {
            $qb->andWhere('n.userUlid = :user_ulid')
                ->setParameter('user_ulid', $filter->user_ulid);
        }

        if ($filter->pager) {
            $qb->setMaxResults($filter->pager->getLimit());
            $qb->setFirstResult($filter->pager->getOffset());
        }
        $paginator = new Paginator($qb->getQuery());

        return new PaginationResult(
            iterator_to_array($paginator->getIterator()),
            $paginator->count()
        );
    }

}