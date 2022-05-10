<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\User;

class AdminCrudController extends AbstractCrudController
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserCrudController constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public static function getEntityFqcn(): string
    {
        return Admin::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('FirstName', 'Imię');
        yield TextField::new('LastName', 'Nazwisko');
        yield TextField::new('username', 'nick');
        yield TextField::new('password', 'hasło')
            ->setLabel("New Password")
            ->setFormType(PasswordType::class)
            ->setFormTypeOption('empty_data', '')
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->onlyWhenCreating();

        yield AssociationField::new('Warehouse', 'Magazyn');
        $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        yield ChoiceField::new('roles', 'Uprawnienia')
            ->setChoices(array_combine($roles, $roles))
            ->allowMultipleChoices()
            ->renderExpanded();
    }


    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->encodePassword($entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }

    // public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    // {
    //     $this->encodePassword($entityInstance);
    //     parent::updateEntity($entityManager, $entityInstance);
    // }

    private function encodePassword(Admin $user)
    {
        if ($user->getPassword() !== null) {
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
        }
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityPermission('ROLE_ADMIN')
            ->setPageTitle(Crud::PAGE_INDEX, 'Użytkownicy')
            ->setEntityLabelInSingular('Użytkownik');
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->setPermission(Action::INDEX, 'ROLE_ADMIN');
    }
}
