<?php

namespace App\Twig;

use App\Repository\RecipeRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Recipes extends AbstractExtension
{
    /**
     * @var RecipeRepository
     */
    private $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('recipes', [$this, 'top']),
        ];
    }

    public function top(int $num)
    {
        $recipes = $this->recipeRepository->findBy([], ['views' => 'desc'], $num);
        $html = '';

        if (count($recipes)) {
            $html .= '<ul class="footer-list">';
            foreach ($recipes as $recipe) {
                $html .= sprintf(
                    '<li><a href="/recept/%s">%s</a></li>',
                    $recipe->getSlug(),
                    $recipe->getTitle()
                );
            }
            $html .= '</ul>';
        }

        return $html;
    }
}
