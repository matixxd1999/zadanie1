<?php

namespace App\Controller;

use App\Entity\MaterialsInWarehouse;
use App\Form\ReleaseArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReleaseArticleController extends AbstractController
{
    /**
     * @Route("/release", name="app_release_article")
     */
    public function getArticle(Request $request): Response
    {
        $materialsinwarehouse = new MaterialsInWarehouse();

        $form = $this->createForm(ReleaseArticleType::class, $materialsinwarehouse);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $dataForm = $form->getData();
            $userRepo = $this->getDoctrine()->getRepository(MaterialsInWarehouse::class);
            $materialsinwarehouseExist = $userRepo->findOneBy([
                'WareHouse' => $dataForm->getWareHouse()->getid(), 
                'Article' => $dataForm->getArticle()->getid(),
        ]);

            $em = $this->getDoctrine()->getManager();

            if ($materialsinwarehouseExist == null){
            $em->persist($materialsinwarehouse);
            }

            else if($materialsinwarehouseExist->getAmount() >= $dataForm->getAmount()){
            $materialsinwarehouseExist->setAmount($materialsinwarehouseExist->getAmount()-$dataForm->getAmount());         
            $em->persist($materialsinwarehouseExist);
            }
            else{
                echo 'Brak towaru w magazynie !!!';
            }

            return $this->redirectToRoute('admin');
            $em->flush();
        }


        return $this->render('release_article/index.html.twig', [
            'ArticleForm' => $form->createView()
        ]);
    }
}
