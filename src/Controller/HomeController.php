<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Repository\ProductRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Home")
     * @Template
     */
    public function index(ProductRepository $productRepository)
    {
        $products = $productRepository->getWithCoverImg();

        return [
            'products' => $products
        ];
    }
}
