<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        ProductRepository $productRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->productRepository = $productRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/kookboek/{slug}", name="product")
     * @Template("product/product.html.twig")
     */
    public function product(string $slug)
    {
        $product = $this->productRepository->findBySlug($slug);

        if (!($product instanceof Product)) {
            return $this->redirect('/404', 404);
        }

        $product->setViews($product->getViews() + 1);
        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return ['product' => $product];
    }

    /**
     * This is the 301 redirect for old routes.
     * @Route("/productpage.php", name="old_prod")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function old(Request $request)
    {
        $id = (int)$request->query->get('id');
        $product = $this->productRepository->findByKbsId($id);

        if (!($product instanceof Product)) {
            return $this->redirect('/404');
        }
        $url = $this->generateUrl('product', ['slug' => $product->getSlug()]);

        return $this->redirect($url, 301);
    }

    /**
     * @Route("/search", name="search_products")
//     * @Template("product/search.html.twig")
     * @param Request $request
     * @return array
     */
    public function search(Request $request)
    {
        $q = $request->get('q');
        $products = $this->productRepository->findByQuery($q);

        return [
            'products' => $products,
            'query' => $q
        ];
    }
}
