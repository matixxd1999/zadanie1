<?php

namespace App\Controller\Admin;

use App\Entity\MaterialsInWarehouse;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MaterialsInWarehouseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MaterialsInWarehouse::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            // TextField::new('title'),
            // TextEditorField::new('description'),
            AssociationField::new('ArticleID'),
            AssociationField::new('WareHouseID')
        ];
    }
    
}
