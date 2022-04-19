<?php

namespace App\Controller\Admin;

use App\Entity\MaterialsInWarehouse;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;

class MaterialsInWarehouseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MaterialsInWarehouse::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
   
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('Produkt')
            ->setEntityLabelInPlural('Produkty')
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
            ->setEntityPermission('ROLE_ADMIN')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            // TextField::new('title'),
            // TextEditorField::new('description'),
            AssociationField::new('WareHouse'),
            AssociationField::new('Article'),
            // TextField::new('title'),
            // TextField::new('title'),
            // TextField::new('title'),
            // PercentField::new('VAT'),
            // IntegerField::new('Amount'),
            // NumberField::new('UnitPrice')        
        ];
    }
    
}
