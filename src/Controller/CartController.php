<?php

namespace App\Controller;

use App\CartManagement\CartManager;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\returnSelf;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart")
     */
    public function index(CartManager $cartManager, ProductRepository $productRepository): Response
    {
        $cart = [];

        if ($cartManager->get('cart')) {

            foreach ($cartManager->get('cart') as $id => $quantity) {

                $product = $productRepository->findOneById($id);

                /**
                 * Ajout d'une condition pour éviter l'ajout d'un produit de façon intempestive via URL (cart/add/...)
                 */
                if ($product) {
                    $category = $product->getCategory();

                    $vspParse = $cartManager->parseVspSize();

                    $cart[] = [
                        "product" => $product,
                        "quantity" => $quantity,
                        "category" => $category->getName(),
                        "vspParse" => $vspParse
                    ];
                } else {
                    $cartManager->delete($id);
                    continue;
                }
            }
        }
        // dd($cart);
        return $this->render('cart/index.html.twig', [
            'cart' => $cart
        ]);
    }


    /**
     * @Route("/cart/add/{id}", name="add_to_cart")
     */
    public function add(Request $request, CartManager $cartManager, $id): Response
    {
        /**
         * Ajout d'un message flash à l'utilisateur et le client reste sur
         * la meme page afin de poursuivre ses achats 
         */

        $cartManager->add($id);
        $this->addFlash('success', 'Article ajouté au panier');
        $route = $request->headers->get('referer');

        return $this->redirect($route);
    }

    /**
     * @Route("/cart/remove", name="remove_all_cart")
     */
    public function remove(CartManager $cartManager): Response
    {
        $cartManager->remove();
        return $this->redirectToRoute('shop');
    }

    /**
     * @Route("/cart/delete/{id}", name="delete_to_cart")
     */
    public function delete(CartManager $cartManager, $id): Response
    {
        $cartManager->delete($id);

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/decrease/{id}", name="decrease_to_cart")
     */
    public function decrease(CartManager $cartManager, $id): Response
    {
        $cartManager->decrease($id);

        return $this->redirectToRoute('cart');
    }
}
