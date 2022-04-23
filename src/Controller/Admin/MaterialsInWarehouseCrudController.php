<?php

namespace App\Controller\Admin;

use App\Entity\MaterialsInWarehouse;
use App\Entity\WareHouses;
use App\Repository\ArticlesRepository;
use App\Repository\MaterialsInWarehouseRepository;
use Doctrine\ORM\Query\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection as CollectionFilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MaterialsInWarehouseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MaterialsInWarehouse::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
   
        // return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            // ->setEntityLabelInSingular('Produkt')
            // ->setEntityLabelInPlural('Produkty')
            return parent::configureCrud($crud)
            ->setEntityPermission('ROLE_ADMIN');
            // ->setFormOptions()
            // in addition to a string, the argument of the singular and plural label methods
            // can be a closure that defines two nullable arguments: entityInstance (which will
            // be null in 'index' and 'new' pages) and the current page name

            // ->setEntityLabelInSingular(
            //     fn (?MaterialsInWarehouse $MaterialsInWarehouse, ?string $admin) => $MaterialsInWarehouse ? $MaterialsInWarehouse->toString() : 'Product'
            // )
            // ->setEntityLabelInPlural(function (?MaterialsInWarehouse $category, ?string $admin) {
            //     return 'edit' === $admin ? $category->getLabel() : 'Categories';
            // })
    
            // the Symfony Security permission needed to manage the entity
            // (none by default, so you can manage all instances of the entity)
            // ->setEntityPermission('ROLE_ADMIN')
        ;
    }

    // public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, CollectionFilterCollection $filters): QueryBuilder
    // {
    //     $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

    //     if ($this->isGranted('ROLE_ADMIN')) {
    //         return $queryBuilder;
    //     }

    //     return $queryBuilder
    //         ->andWhere('entity.id = :id')
    //         ->setParameter('id', $this->getUser()->getId());
    //         dump($queryBuilder);
    // }
    
    public function configureFields(string $pageName): iterable
    {
        
            // IdField::new('id'),
            // TextField::new('title'),
            // TextEditorField::new('description'),
            yield AssociationField::new('WareHouse');
            // ->setQueryBuilder(function(QueryBuilder $querybuilder){
            //     $querybuilder
            //         ->addSelect('wh.WareHouseName')
            //         ->addSelect('a.ArticleName')
            //         ->addSelect('w.Amount')
            //         ->addSelect('w.VAT')
            //         ->addSelect('w.UnitPrice')
            //         ->setParameter('userId', $id)
            //         ->where('u.id = :userId')

            //         ->leftJoin('w.Article', 'a')
            //         ->leftJoin('w.WareHouse', 'wh')
            //         ->leftJoin('wh.admins', 'u')

            //         ->orderBy('w.id', 'ASC')
            //         ->setMaxResults(10)
            //         ->getQuery()
            //         ->getResult()
            // });
            // yield Field::new(MaterialsInWarehouseRepository::class, 'WareHouseName');


            // ->formatValue(static function($value, WareHouses $WareHouseName){
            //     if (!$user = $WareHouseName->getAskedBy()){
            //         return null;
            //     }
            //     return sprintf('%s&nbsp;(%s)', $user->getUser(), $user->getWareHouseName()->count());
            // });
            yield AssociationField::new('Article', 'Artykuły');
            yield IntegerField::new('amount', "Ilość");
            yield PercentField::new('VAT');
            yield NumberField::new('UnitPrice', "Cena Jednostkowa");       

            // TextField::new('title'),
            // TextField::new('title'),
            // TextField::new('title'),
            // PercentField::new('VAT'),
            // IntegerField::new('Amount'),
            // NumberField::new('UnitPrice')        
        
    }   
}
