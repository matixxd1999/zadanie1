<?php

namespace App\Controller\Admin;

use App\Entity\WareHouses;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class WareHousesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WareHouses::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('WareHouseName', 'Nazwa Magazynu');
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
        ->setEntityPermission('ROLE_ADMIN')
        ->setPageTitle(Crud::PAGE_INDEX, 'Magazyny')
        ->setEntityLabelInSingular('Magazyn');
    }
}
