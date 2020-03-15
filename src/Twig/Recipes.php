<?php

namespace App\Twig;

use App\Repository\RecipeRepository;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Recipes extends AbstractExtension
{
    /**
     * @var RecipeRepository
     */
    private $recipeRepository;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(RecipeRepository $recipeRepository, Environment $twig)
    {
        $this->recipeRepository = $recipeRepository;
        $this->twig = $twig;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('recipes', [$this, 'top']),
        ];
    }

    /**
     * @param int $num
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function top(int $num)
    {
        $recipes = $this->recipeRepository->findBy([], ['views' => 'desc'], $num);

        return $this->twig->render('recipe/footer.html.twig', ['recipes' => $recipes]);
    }
}
