<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Entity\Articles;
use App\Entity\MaterialsInWarehouse;
use App\Entity\Units;
use App\Entity\WareHouses;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig');    
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zadanie');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Jednostki', 'fas fa-list', Units::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Artykuły', 'fas fa-shopping-basket', Articles::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Magazyny', 'fas fa-warehouse', WareHouses::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Materiały w Magazynach', 'fas fa-boxes', MaterialsInWarehouse::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Użytkownicy', 'fas fa-users', Admin::class) ->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToRoute('Przyjęcie Artykułu', 'fas fa-cart-plus', 'app_reception');
        yield MenuItem::linkToRoute('Wydanie Artykułu', 'fas fa-cart-arrow-down', 'app_release_article');


    }
}
