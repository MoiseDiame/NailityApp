<?php

namespace App\Controller\Admin;

use App\Entity\Vsp;
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
        yield MenuItem::linkToCrud('Vernis Semi-Permanents', 'fas fa-tag', Vsp::class);
    }
}
