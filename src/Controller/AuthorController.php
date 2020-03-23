<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Repository\ProductRepository;

class AuthorController extends AbstractController
{
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(
        AuthorRepository $authorRepository,
        ProductRepository $productRepository
    ) {
        $this->authorRepository = $authorRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/author/{id}", name="author")
     * @Template("author/author.html.twig")
     */
    public function index(int $id)
    {
        $author = $this->authorRepository->find($id);
        $products = $this->productRepository->findByAuthor($author);

        return [
            'author' => $author,
            'products' => $products,
        ];
    }
}
