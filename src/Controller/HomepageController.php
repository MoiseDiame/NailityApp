<?php

namespace App\Controller;

use App\Form\SearchProductType;
use App\Repository\ProductRepository;
use App\SearchClasses\SearchProduct;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $bestSeller = $productRepository->findBy(['best' => true]);
        $newProducts = $productRepository->findBy(['new' => true]);
        return $this->render('homepage/index.html.twig', [
            'bestSellers' => $bestSeller,
            'newProducts' => $newProducts,
        ]);
    }
}
