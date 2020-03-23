<?php

namespace App\Repository;

use App\Entity\Author;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByKbsId(int $kbsId): ?Product
    {
        return $this->findOneBy(['kbsId' => $kbsId]);
    }

    public function findBySlug(string $slug): ?Product
    {
        return $this->findOneBy(['slug' => $slug]);
    }

    /**
     * @return Product[]
     */
    public function findWithoutSlug(): array
    {
        return $this->findBy(['slug' => null]);
    }

    /**
     * @return Product[]
     */
    public function findByAuthor(Author $author): array
    {
        return $this->findBy(['author' => $author]);
    }

    /**
     * @return Product[]
     */
    public function getWithCoverImg(): array
    {
        $qb = $this->createQueryBuilder('p');
        $qb->where('p.imgCover IS NOT NULL');
        $qb->andWhere('p.imgCover NOT LIKE :like')
        ->setParameter('like', "");


        return $qb->getQuery()->getResult();
    }

}
