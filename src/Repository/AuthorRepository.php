<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    /**
     * @return Author[] array
     */
    public function findByDay(\DateTimeInterface $date): array
    {
        return $this->createQueryBuilder('a')
            ->select('a, p')
            ->join('a.blogPosts', 'p')
            ->andWhere('p.published_at = :date')
            ->setParameter('date', $date->format('Y-m-d'))
            ->orderBy('p.published_at')
            ->getQuery()
            ->getResult();
            #->getResult(AbstractQuery::HYDRATE_ARRAY);
    }
}
