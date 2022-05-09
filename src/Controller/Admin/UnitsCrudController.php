<?php

namespace App\Controller\Admin;

use App\Entity\Units;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UnitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Units::class;
    }

    public function configureFields(string $pageName): iterable
    {

            yield TextField::new('UnitShortName', 'Skrót Jednostki');
            yield TextField::new('UnitLongName', 'Pełna Nazwa Jednostki');
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
        ->setEntityPermission('ROLE_ADMIN')
        ->setPageTitle(Crud::PAGE_INDEX, 'Jednostki')
        ->setEntityLabelInSingular('Jednostka');
    }
}
