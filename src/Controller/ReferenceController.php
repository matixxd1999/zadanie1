<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\MaterialsInWarehouse;
use App\Form\GetArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReferenceController extends AbstractController
{
    /**
     * @Route("/", name="app_reference")
     */
    public function getArticle(Request $request): Response
    {
        $materialsinwarehouse = new MaterialsInWarehouse();

        $form = $this->createForm(GetArticleType::class, $materialsinwarehouse);
        $form->handleRequest($request);

        // $admin = $this->getDoctrine()
        // ->getRepository(MaterialsInWarehouse::class)
        // ->WarehouseFilterByUserId(2);

        $admin = $this->getDoctrine()
        ->getRepository(Articles::class)
        ->findAll();

        dd($admin);
        if ($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($materialsinwarehouse);
            $em->flush();
        }






        return $this->render('reference/index.html.twig', [
            'ArticleForm' => $form->createView()
        ]);
    }




    // public function index(): Response
    // {
    //     return $this->render('reference/index.html.twig', [
    //         'controller_name' => 'ReferenceController',
    //     ]);
    // }
}
