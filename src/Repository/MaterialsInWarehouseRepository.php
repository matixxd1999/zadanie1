<?php

namespace App\Repository;

use App\Entity\MaterialsInWarehouse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaterialsInWarehouse|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaterialsInWarehouse|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaterialsInWarehouse[]    findAll()
 * @method MaterialsInWarehouse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterialsInWarehouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaterialsInWarehouse::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MaterialsInWarehouse $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(MaterialsInWarehouse $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return MaterialsInWarehouse[] Returns an array of MaterialsInWarehouse objects
     */
    public function WarehouseFilterByUserId($id)
    {
        $result = $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $id)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;

        dd($result);

        return $result;

    }
    

    /*
    public function findOneBySomeField($value): ?MaterialsInWarehouse
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
