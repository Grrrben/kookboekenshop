<?php

namespace App\Controller;

use App\Entity\Combination\Ingredient;
use App\Repository\Combination\IngredientRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CombinationsController extends AbstractController
{
    /**
     * @var IngredientRepository
     */
    private $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * This is the 301 redirect for old routes.
     * @Route("/combinaties/index.php", name="old_combination")
     * @param Request $request
     * @return RedirectResponse
     */
    public function old(Request $request)
    {
        $kbsId = (int) $request->query->get('id');
        $ingredient = $this->ingredientRepository->findByKbsId($kbsId);

        if (!($ingredient instanceof Ingredient)) {
            return $this->redirect('/404');
        }
        $url = $this->generateUrl('combination', ['slug' => $ingredient->getSlug()]);

        return $this->redirect($url, 301);
    }

    /**
     * @Route("/combinaties/{slug}", name="combination")
     * @Template("ingredient/combination.html.twig")
     */
    public function combination(string $slug)
    {
        $ingredient = $this->ingredientRepository->findBySlug($slug);

        if (!($ingredient instanceof Ingredient)) {
            return $this->redirect('/404');
        }

        return [
            'ingredient' => $ingredient,
        ];
    }

    /**
     * @Route("/combinaties", name="combination_list")
     * @Template("ingredient/list.html.twig")
     */
    public function list()
    {
        $ingredients = $this->ingredientRepository->findAll();

        return ['ingredients' => $ingredients];
    }
}
