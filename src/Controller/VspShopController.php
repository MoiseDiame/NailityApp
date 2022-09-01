<?php

namespace App\Controller;

use App\Form\VspColorFilterType;
use App\Repository\VspPriceRepository;
use App\Repository\VspRepository;
use App\Repository\VspSizeRepository;
use App\SearchClasses\VspColorFilter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VspShopController extends AbstractController
{
    /**
     * @Route("/shop/vsp", name="vsp_shop")
     */
    public function index(VspRepository $vsprepository, VspSizeRepository $vspSizeRepository, VspPriceRepository $vspPriceRepository, Request $request): Response
    {
        $vsp = $vsprepository->findAll();
        $vspSize = $vspSizeRepository->findAll();
        $vspPrice = $vspPriceRepository->findAll();
        $filter = new VspColorFilter;
        $filter_form = $this->createForm(VspColorFilterType::class, $filter);
        // dd($vspPrice);
        $filter_form->handleRequest($request);

        if (($filter_form->isSubmitted()) && ($filter_form->isValid())) {
            $vsp = $vsprepository->filterByColor($filter);
        }

        return $this->render('vsp_shop/index.html.twig', [
            'vsps' => $vsp,
            'vspSizes' => $vspSize,
            'vspPrice' => $vspPrice,
            'filter_form' => $filter_form->createView()
        ]);
    }
    /**
     * @Route("/shop/vsp/{slug}", name="vsp_show_details")
     */

    public function show($slug, VspRepository $vspRepository): Response
    {
        $vsp = $vspRepository->findOneBySlug($slug);
        return $this->render('vsp_shop/show_details.html.twig', [
            'vsp' => $vsp
        ]);
    }
}
