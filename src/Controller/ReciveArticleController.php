<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\MaterialsInWarehouse;
use App\Form\GetArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ReciveArticleController extends AbstractController
{
    /**
     * @Route("/reception", name="app_reception")
     */
    public function getArticle(Request $request, UserInterface $user): Response
    {
        $materialsinwarehouse = new MaterialsInWarehouse();
        $message = '';

        $form = $this->createForm(
            GetArticleType::class,
            $materialsinwarehouse,
            ['idUser' => $user->getId()]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dataForm = $form->getData();
            $userRepo = $this->getDoctrine()->getRepository(MaterialsInWarehouse::class);
            $materialsinwarehouseExist = $userRepo->findOneBy([
                'WareHouse' => $dataForm->getWareHouse()->getid(),
                'Article' => $dataForm->getArticle()->getid(),
            ]);
            $em = $this->getDoctrine()->getManager();
            $vat = ($dataForm->getVAT()) / 100;

            if ($materialsinwarehouseExist == null) {
                $materialsinwarehouse->setVAT($vat);
                $em->persist($materialsinwarehouse);
            } else {
                $materialsinwarehouseExist->setAmount($materialsinwarehouseExist->getAmount() + $dataForm->getAmount());
                $materialsinwarehouseExist->setVAT($vat);
                $materialsinwarehouseExist->setUnitPrice($dataForm->getUnitPrice());

                $em->persist($materialsinwarehouseExist);
            }

            $em->flush();
            $message = 'Towar dodano do magazynu !!!';
        }

        return $this->render('recive_article/index.html.twig', [
            'ArticleForm' => $form->createView(),
            'message' => $message,
        ]);
    }
}
