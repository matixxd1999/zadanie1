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
    public function WarehouseFilterByUserId(int $id)
    {
        return $this->createQueryBuilder('w')
            // ->addSelect('w.id')
            // ->addSelect('u.id AS userId')
            // ->Select('wh.WareHouseName AS yerrr')
            ->Select('wh.WareHouseName AS warehouseName')
            ->addSelect('wh.id AS idWarehouse')
            ->addSelect('a.ArticleName AS article')
            ->addSelect('w.Amount AS amount')
            ->addSelect('un.UnitShortName AS unit')
            ->addSelect('w.VAT AS vat')
            ->addSelect('w.UnitPrice AS price')
            ->setParameter('userId', $id)
            ->where('u.id = :userId')

            ->leftJoin('w.Article', 'a')
            ->leftJoin('w.WareHouse', 'wh')
            ->leftJoin('wh.admins', 'u')
            ->leftJoin('a.UnitShortName', 'un')

            ->orderBy('wh.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return MaterialsInWarehouse[] Returns an array of MaterialsInWarehouse objects
     */
    public function WarehouseMaterials(int $id)
    {
        return $this->createQueryBuilder('w')
            ->Select('a.ArticleName')
            ->addSelect('w.Amount')
            ->addSelect('w.VAT')
            ->addSelect('w.UnitPrice')
            ->addSelect('wh.id')
            ->addSelect('wh.WareHouseName')

            ->setParameter('userId', $id)
            ->where('u.id = :userId')

            ->leftJoin('w.Article', 'a')
            ->leftJoin('w.WareHouse', 'wh')
            ->leftJoin('wh.admins', 'u')

            ->groupBy('wh.id')
            ->addGroupBy('a.id')
            ->orderBy('wh.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
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
