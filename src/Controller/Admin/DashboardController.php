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
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zadanie');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Jednostki', 'fas fa-list', Units::class);
        yield MenuItem::linkToCrud('Artykuły', 'fas fa-list', Articles::class);
        yield MenuItem::linkToCrud('Magazyny', 'fas fa-list', WareHouses::class);
        yield MenuItem::linkToCrud('Materiały w Magazynach', 'fas fa-list', MaterialsInWarehouse::class);
        yield MenuItem::linkToCrud('Użytkownicy', 'fas fa-list', Admin::class)
        ->setPermission('ROLE_ADMIN');


    }
}
