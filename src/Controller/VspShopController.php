<?php

namespace App\Controller;

use App\Repository\VspRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VspShopController extends AbstractController
{
    /**
     * @Route("/vsp/shop", name="vsp_shop")
     */
    public function index(VspRepository $repository): Response
    {
        $vsp = $repository->findAll();
        return $this->render('vsp_shop/index.html.twig', [
            'vsps' => $vsp,
        ]);
    }
}
