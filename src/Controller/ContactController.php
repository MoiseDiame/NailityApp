<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Mailing\Mailer;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(ProductRepository $productRepository, Request $request, Mailer $mailer): Response
    {
        $contactForm = $this->createForm(ContactType::class, [
            'action' => $this->generateUrl('contact')
        ]);
        $bestSeller = $productRepository->findBy(['best' => true]);
        $newProducts = $productRepository->findBy(['new' => true]);

        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted()) {
            $mailer->sendEmail();
            return $this->redirectToRoute('shop');
        } else {

            return $this->render('contact/index.html.twig', [
                'contactForm' => $contactForm->createView(),
                'bestSellers' => $bestSeller,
                'newProducts' => $newProducts,
            ]);
        }
    }
}
