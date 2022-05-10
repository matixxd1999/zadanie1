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
        $message = '';

        if ($form->isSubmitted() && $form->isValid()) {
            $newPassword = $form->getData()->getPassword();
            $hashNewPassword = $this->passwordEncoder->encodePassword($user, $newPassword);
            $userRepo = $this->getDoctrine()->getRepository(Admin::class);
            $passwordExist = $userRepo->find($idUser);
            $paste = $passwordExist->setPassword($hashNewPassword);


            $em = $this->getDoctrine()->getManager();
            $em->persist($paste);
            $em->flush();
            $message = 'Hasło zostało pomyślnie zmienione !!!';
        }

        return $this->render('change_password/index.html.twig', [
            'PasswordForm' => $form->createView(),
            'message' => $message,
        ]);
    }
}
