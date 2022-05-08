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
     * @Route("/reception", name="app_reference")
     */
    public function getArticle(Request $request): Response
    {
        $materialsinwarehouse = new MaterialsInWarehouse();

        $form = $this->createForm(GetArticleType::class, $materialsinwarehouse);
        $form->handleRequest($request);

      

        // dd($admin);
        if ($form->isSubmitted() && $form->isValid()){
            $dataForm = $form->getData();
            // dump($dataForm->getArticle()->getid());
            // dump($dataForm->getAmount());
            $userRepo = $this->getDoctrine()->getRepository(MaterialsInWarehouse::class);
            $materialsinwarehouseExist = $userRepo->findOneBy([
                'WareHouse' => $dataForm->getWareHouse()->getid(), 
                'Article' => $dataForm->getArticle()->getid(),
        ]);
            // dd($test);
            $em = $this->getDoctrine()->getManager();

            if ($materialsinwarehouseExist == null){
            $em->persist($materialsinwarehouse);
            }

            else{
            $materialsinwarehouseExist->setAmount($materialsinwarehouseExist->getAmount()+$dataForm->getAmount());         
            $em->persist($materialsinwarehouseExist);
            }
            
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
