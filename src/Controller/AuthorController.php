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
     * @Route("/author/{id}", name="author")
     * @Template("author/author.html.twig")
     */
    public function index(int $id, AuthorRepository $authorRepository)
    {
        $author = $authorRepository->find($id);

        return [
            'author' => $author
        ];
    }
}
