<?php

namespace App\Repository;

use App\Entity\Export;
use App\Filter\Export\ExportFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Export>
 *
 * @method Export|null find($id, $lockMode = null, $lockVersion = null)
 * @method Export|null findOneBy(array $criteria, array $orderBy = null)
 * @method Export[]    findAll()
 * @method Export[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Export::class);
    }

        /**
         * @return Export[] Returns an array of Export objects
         */
        public function findByFilter(array $filter): array
        {
            $qb = $this->createQueryBuilder('e')
                ->orderBy('e.id', 'ASC');

            $this->addFilterParams($filter, $qb);

            return $qb->getQuery()->getResult();
        }

        private function addFilterParams(array $filter, QueryBuilder &$qb): void
        {
            if($filter['fromDate']) {
                $qb->andWhere('e.date >= :fromDate')
                    ->setParameter('fromDate', $filter['fromDate']);
            }

            if($filter['toDate']) {
                $qb->andWhere('e.date <= :toDate')
                    ->setParameter('toDate', $filter['toDate']);
            }

            if($filter['place']) {
                $qb->andWhere('e.place like :place')
                    ->setParameter('place', '%' . $filter['place'] . '%');
            }
        }
}


