<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Tag;
use App\Repository\ProductRepository;
use App\Repository\TagRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var TagRepository
     */
    private $tagRepository;

    public function __construct(
        ProductRepository $productRepository,
        TagRepository $tagRepository
    ) {
        $this->productRepository = $productRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * @Route("/tag/{slug}", name="tag")
     * @Template("tag/index.html.twig")
     */
    public function tag(string $slug)
    {

        $tag = $this->tagRepository->findOneBySlug($slug);

        if (!($tag instanceof Tag)) {
            return $this->redirect('/404');
        }

        return [
            'tag' => $tag,
            'products' => $tag->getProducts(),
        ];
    }
}