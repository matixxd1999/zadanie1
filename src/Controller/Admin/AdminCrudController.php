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
        // $result =  Admin::class;

        // dd($result);

        return Admin::class;
    }

    // public function index(Request $request, UserInterface $user): Response
    // {
    //     $idUser = $user->getId();
    //     $test = $this->getDoctrine()
    //     ->getRepository(MaterialsInWarehouse::class)
    //     ->WarehouseFilterByUserId($idUser);
    //     return $this->encode($test);
    // }

 




    
    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')->hideOnForm();
            yield TextField::new('FirstName');
            yield TextField::new('LastName');
            yield TextField::new('username');

            // $adminId = $this->get('request_stack')->getCurrentRequest()->query->all();
            // $admin = $this->getDoctrine()->getRepository(Admin::class)->find(2)->getPassword();

            // dump($adminId);
            // dd($admin);

            yield TextField::new('password')
            ->setLabel("New Password")
            ->setFormType(PasswordType::class)

            ->setFormTypeOption('empty_data', '')            //$admin - hasło gdy jest puste pole

            ->setRequired(false)
            ->setHelp('Jeśli pole zostanie puste przy edycji to nadpisuje hasło')
            ->hideOnIndex();





            // yield TextField::new('password')->hideOnIndex();
            // yield TextField::new('password')->setFormType(PasswordType::class);
            // $roles=['Magazyn 1', 'Magazyn 2','Magazyn 3', 'Magazyn 4'];
            // yield ChoiceField::new('Warehouse')->setChoices(array_combine($roles, $roles));
            yield AssociationField::new('Warehouse');
            $roles=['ROLE_ADMIN', 'ROLE_USER'];
            yield ChoiceField::new('roles')
            ->setChoices(array_combine($roles, $roles))
            ->allowMultipleChoices()
            ->renderExpanded();


           
            // return [$password];
    }









    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {

        // dd($this->get('request_stack')->getCurrentRequest()->request->all());
        // $adminId = $this->get('request_stack')->getCurrentRequest()->query->all()['entityId'];
        
        // $admin = $this->getDoctrine()
        // ->getRepository(Admin::class)
        // ->find(2)->getPassword();

        // $admin = $this->getDoctrine()
        // ->getRepository(Admin::class)
        // ->findAll();

        // $currentPassword = getPassword($admin);
        // dd($adminId);
        // dump($admin);
        // dump($currentPassword);
        // dd($this->get('request_stack')->getCurrentRequest()->query->all()['entityId']);

        // set new password with encoder interface
        if (method_exists($entityInstance, 'setPassword')) {

            $clearPassword = trim($this->get('request_stack')->getCurrentRequest()->request->all()['Admin']['password']);
            // dd($clearPassword);
            ///MyLog::info("clearPass:" . $clearPassword);
            
            // save password only if is set a new clearpass
            if ( !empty($clearPassword) ) {
                ////MyLog::info("clearPass not empty! encoding password...");
                $encodedPassword = $this->passwordEncoder->encodePassword($this->getUser(), $clearPassword);
                $entityInstance->setPassword($encodedPassword);
                
            } 
            else{

            }
            
        }

        parent::updateEntity($entityManager, $entityInstance);
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
