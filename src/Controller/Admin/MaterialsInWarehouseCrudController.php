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
        return parent::configureCrud($crud)
            ->setEntityPermission('ROLE_ADMIN')
            ->setPageTitle(Crud::PAGE_INDEX, 'Materiały w Magazynach')
            ->setEntityLabelInSingular('Artykuł do magazynu');
    }

    public function configureFields(string $pageName): iterable
    {

        yield AssociationField::new('WareHouse', 'Magazyn');
        yield AssociationField::new('Article', 'Artykuły');
        yield IntegerField::new('amount', "Ilość");
        yield PercentField::new('VAT');
        yield NumberField::new('UnitPrice', "Cena Jednostkowa");
    }
}
