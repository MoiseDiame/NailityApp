<?php

namespace App\Controller;

use App\Form\VspColorFilterType;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\SearchClasses\VspColorFilter;
use App\Form\SearchProductType;


class ShopController extends AbstractController
{
    /**
     * @Route("/shop", name="shop")
     */
    public function index(ProductCategoryRepository $productCategoryRepository): Response
    {
        $categories = $productCategoryRepository->findAll();
        return $this->render('shop/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/shop/{category}", name="category_shop")
     */

    public function showShop(ProductCategoryRepository $productCategoryRepository, ProductRepository $productRepository, Request $request, $category): Response
    {
        $category = $productCategoryRepository->findOneBySlug($category);
        $filter = new VspColorFilter;
        $colorFilterForm = $this->createForm(VspColorFilterType::class, $filter);
        $products = $productRepository->findProductsByCategory($category);

        $colorFilterForm->handleRequest($request);

        if (($colorFilterForm->isSubmitted()) && ($colorFilterForm->isValid())) {
            $products = $productRepository->filterVspColor($filter);
        }
        return $this->render('shop/showProducts.html.twig', [
            'category' => $category,
            'products' => $products,
            'filter_form' => $colorFilterForm->createView()
        ]);
    }
    /**
     * @Route("/shop_search", name="search_products")
     */

    public function SearchProducts(Request $request, ProductRepository $productRepository)
    {
        $searchedProducts = [];

        $search = $request->get('product_search');

        if ($search !== '') {

            $searchedProducts = $productRepository->findProductsWithSearch($search);
        }



        return $this->render('shop/searchProducts.html.twig', [
            'searchedProducts' => $searchedProducts,
        ]);
    }

    /**
     * @Route("/shop/{category}/{product}", name="product_details")
     */

    public function showProductDetails(ProductRepository $productRepository, $product): Response
    {
        $product = $productRepository->findOneBySlug($product);
        return $this->render('shop/showProductDetails.html.twig', [
            'product' => $product
        ]);
    }
}
