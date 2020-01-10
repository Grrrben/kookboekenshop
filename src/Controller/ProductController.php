<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Repository\ProductRepository;

class ProductController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/product/{slug}", name="product")
     * @Template("product/product.html.twig")
     */
    public function product(string $slug)
    {
        $product = $this->productRepository->findBySlug($slug);

        return [
            'product' => $product
        ];
    }

    /**
     * This is the 301 redirect for old routes.
     * @Route("/productpage.php", name="old_prod")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function old(Request $request)
    {
        $id = (int) $request->query->get('id');
        $product = $this->productRepository->find($id);

        if (!($product instanceof Product)) {
            return $this->redirect('/404');
        }
        $url = $this->generateUrl('product', ['slug' => $product->getSlug()]);

        return $this->redirect($url, 301);
    }
}
