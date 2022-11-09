<?php

namespace App\CartManagement;

use App\CartManagement\CartManager;

class ShippingCost
{

    private $cartManager;

    public function __construct(CartManager $cartManager)
    {
        $this->cartManager = $cartManager;
    }
    public function getShippingOptions()
    {

        $cartWeight = $this->cartManager->getCartWeight();
        if ($cartWeight < 250) {
            $ShippingOptions = ['Lettre Bulle', 'Colissimo', 'Mondial Relay'];
        } else {
            $ShippingOptions = ['Colissimo', 'Mondial Relay'];
        }

        return $ShippingOptions;
    }
}
