<?php

namespace App\Controller\Admin;

use App\Entity\WareHouses;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WareHousesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WareHouses::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
