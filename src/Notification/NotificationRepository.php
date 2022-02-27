<?php

namespace App\Notification;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class NotificationRepository extends ServiceEntityRepository
{
    const MAXRESULTS = 100;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    public function getAll(): array
    {
        return $this->getAllQb()
            ->where('e.region != :test')
            ->setParameter('test', NotificationRegion::TEST()->getValue())
            ->getQuery()
            ->getResult();
    }

    private function getAllQb(): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.createdAt', 'DESC')
            ->setMaxResults(self::MAXRESULTS);
    }

    public function getByRegion(NotificationRegion $region): array
    {
        return $this->getAllQb()
            ->where('e.region = :region')
            ->setParameter('region', $region->getValue())
            ->getQuery()
            ->getResult();
    }
}
