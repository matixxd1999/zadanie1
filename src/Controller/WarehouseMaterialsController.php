<?php

namespace App\Controller;

use App\Entity\MaterialsInWarehouse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class WarehouseMaterialsController extends AbstractController
{
    /**
     * @Route("/warehousematerials", name="app_warehouse_materials")
     */
    public function index(HttpFoundationRequest $request, UserInterface $user): Response
    {
        $idUser = $user->getId();
        $materials = $this->getDoctrine()
        ->getRepository(MaterialsInWarehouse::class)->WarehouseFilterByUserId($user->getId());

        // dd($materials);

        return $this->render('warehouse_materials/index.html.twig', [
            'materials' => $materials,
        ]);
    }
}
