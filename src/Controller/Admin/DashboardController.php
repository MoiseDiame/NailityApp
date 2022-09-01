<?php

namespace App\Controller\Admin;

use App\Entity\Vsp;
use App\Entity\VspColor;
use App\Entity\VspPrice;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/gestion", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Naility Shop');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Boutique', 'fa fa-home');
        yield MenuItem::subMenu('Vernis', 'fas fa-list-ul')->setSubItems([
            MenuItem::linkToCrud('Références de vernis', 'fas fa-tag', Vsp::class),
            MenuItem::linkToCrud('Coloris de vernis', 'fas fa-tag', VspColor::class),
            MenuItem::linkToCrud('Prix', 'fas fa-euro-sign', VspPrice::class)

        ]);
    }
}
