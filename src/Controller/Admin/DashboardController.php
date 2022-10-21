<?php

namespace App\Controller\Admin;

use App\Entity\ElectricDevices;
use App\Entity\Product;
use App\Entity\ProductCategory;
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
        yield MenuItem::subMenu('Produits', 'fas fa-list-ul')->setSubItems([
            MenuItem::linkToCrud('Vernis', 'fas fa-tags', Product::class)
                ->setController(VernisCrudController::class),
            MenuItem::linkToCrud('Matériels électriques', 'fas fa-plug', Product::class)
                ->setController(ElectricDevicesCrudController::class)
        ]);

        yield    MenuItem::linkToCrud('Coloris de vernis', 'fas fa-tag', VspColor::class);
        yield    MenuItem::linkToCrud('Prix des vernis', 'fas fa-euro-sign', VspPrice::class);

        yield MenuItem::linkToCrud('Listing des produits', 'fas fa-tags', Product::class)
            ->setController(ProductCrudController::class);
        yield MenuItem::linkToCrud('Catégories produits', 'fas fa-sitemap', ProductCategory::class);
    }
}
