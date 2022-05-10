<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\ChangePasswordType;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ChangePasswordController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/change/password", name="app_change_password")
     */
    public function index(HttpFoundationRequest $request, UserInterface $user): Response
    {
        $users = new Admin();
        $idUser = $user->getId();
        $form = $this->createForm(ChangePasswordType::class, $users);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $newPassword = $form->getData()->getPassword();
            $hashNewPassword = $this->passwordEncoder->encodePassword($user, $newPassword);
            $userRepo = $this->getDoctrine()->getRepository(Admin::class);
            $passwordExist = $userRepo->find($idUser);
            $paste = $passwordExist->setPassword($hashNewPassword);


            $em = $this->getDoctrine()->getManager();
            $em->persist($paste);
            $em->flush();
            echo('<h1><style=color:red>Hasło zmienione pomyślnie</style></h1>');



            // dump($passwordExist);
            // dump($paste);
            // dump($newPassword);
            // dump($hashNewPassword);
            // dump($em);
            // dd($idUser);

        }




        



            return $this->render('change_password/index.html.twig', [
                'PasswordForm' => $form->createView()
            ]);
        
    }
}
