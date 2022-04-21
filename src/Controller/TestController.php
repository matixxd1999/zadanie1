<?php

namespace App\Controller;

use App\Entity\MaterialsInWarehouse;
use App\Entity\WareHouses;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MaterialsInWarehouseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="app_test")
     */
    public function index(Request $request, UserInterface $user): Response
    {

        $idUser = $user->getId();
        // $idUser = 2;

        $test = $this->getDoctrine()
        ->getRepository(MaterialsInWarehouse::class)
        ->WarehouseFilterByUserId($idUser);

        dump($user);
        dump($test);

        // $magazyn = $this->getDoctrine()
        //     ->getRepository(MaterialsInWarehouse::class)
        //     ->find($user->getId());

        // dump($user->getId());


        // dump($test);
        die;


        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
