<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdminCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Admin::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
            yield IdField::new('id')->hideOnForm();
            yield TextField::new('FirstName');
            yield TextField::new('LastName');
            yield TextField::new('username');
            yield TextField::new('password')->hideOnIndex();
            // $roles=['Magazyn 1', 'Magazyn 2','Magazyn 3', 'Magazyn 4'];
            // yield ChoiceField::new('Warehouse')->setChoices(array_combine($roles, $roles));
            yield AssociationField::new('Warehouse');
            $roles=['ROLE_ADMIN', 'ROLE_USER'];
            yield ChoiceField::new('roles')
            ->setChoices(array_combine($roles, $roles))
            ->allowMultipleChoices()
            ->renderExpanded();
      
    }
    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
        ->setEntityPermission('ROLE_ADMIN');
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
        ->setPermission(Action::INDEX, 'ROLE_ADMIN');
    }
    
}
