<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @var RecipeRepository
     */
    private $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * This is the 301 redirect for old routes.
     * @Route("/recept.php", name="old_recipe")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function old(Request $request)
    {
        $id = (int) $request->query->get('recept');
        $product = $this->recipeRepository->findByKbsId($id);

        if (!($product instanceof Recipe)) {
            return $this->redirect('/404', 404);
        }
        $url = $this->generateUrl('recipe', ['slug' => $product->getSlug()]);

        return $this->redirect($url, 301);
    }

    /**
     * @Route("/recept/{slug}", name="recipe")
     * @Template("recipe/recipe.html.twig")
     */
    public function recept(string $slug)
    {
        $recipe = $this->recipeRepository->findBySlug($slug);

        if ($recipe === null) {
            $this->redirect('/404', 404);
        }

        return [
            'recipe' => $recipe
        ];
    }

    /**
     * @Route("/recepten", name="recipes_list")
     * @Template("recipe/list.html.twig")
     */
    public function listOfRecipies()
    {
        $recipes = $this->recipeRepository->findAll();

        return [
            'recipes' => $recipes,
        ];
    }
}
