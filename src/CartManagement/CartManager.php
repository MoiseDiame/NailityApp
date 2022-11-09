<?php

namespace App\CartManagement;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartManager
{
    private $session;

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }


    public function add($id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $this->session->set('cart', $cart);
    }

    public function set($cart)
    {
        return $this->session->set('cart', $cart);
    }


    public function get()
    {
        return $this->session->get('cart');
    }

    public function remove()
    {
        return $this->session->remove('cart');
    }

    public function delete($id)
    {
        $cart = $this->session->get('cart', []);

        unset($cart[$id]);

        return $this->session->set('cart', $cart);
    }

    public function decrease($id)
    {
        $cart = $this->session->get('cart', []);

        if ($cart[$id] > 1) {
            $cart[$id]--;
        } else {
            unset($cart[$id]);
        }
        return $this->session->set('cart', $cart);
    }

    public function getCartWeight()
    {
        $cart = $this->session->get('cart', []);
        $cartWeight = 0;
        if ($cart) {

            foreach ($cart as $id => $quantity) {

                $product = $this->productRepository->findOneById($id);
                $weight = $product->getWeight();
                $cartWeight = $cartWeight + $weight * $quantity;
            }
        }
        return $cartWeight;
    }

    /**
     * Cette fonction permet de dénombrer les quantités présentes dans les deux tailles de vernis.
     * Connaître le nombre de vernis en 7 ou 15 ml permettra d'appliquer les prix dégressifs. 
     * 
     */
    public function parseVspSize()
    {
        $cart = $this->get('cart');
        $quantity_7ml = 0;
        $quantity_15ml = 0;

        foreach ($cart as $id => $quantity) {

            $product = $this->productRepository->findOneById($id);

            $category = $product->getCategory()->getName();

            if ($category == 'vernis semi-permanents') {
                $size = $product->getVspSize()->getSize();


                if ($size == "7ml") {
                    $quantity_7ml = $quantity_7ml + $cart[$id];
                }
                if ($size == "15ml") {
                    $quantity_15ml = $quantity_15ml + $cart[$id];
                }
            }
        }
        $quantity = [
            'quantity_7ml' => $quantity_7ml,
            'quantity_15ml' => $quantity_15ml
        ];

        return $quantity;
    }
}
