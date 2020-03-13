<?php

namespace App\Twig;

use App\Repository\Combination\IngredientRepository;
use App\Repository\RecipeRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Combinations extends AbstractExtension
{
    /**
     * @var IngredientRepository
     */
    private $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('combinations', [$this, 'top']),
        ];
    }

    public function top(int $num)
    {
        $ingredients = $this->ingredientRepository->findBy([], ['views' => 'desc'], $num);
        $html = '';

        if (count($ingredients)) {
            $html .= '<ul class="footer-list">';
            foreach ($ingredients as $ingredient) {
                $html .= sprintf(
                    '<li><a href="/combinaties/%s">%s</a></li>',
                    $ingredient->getSlug(),
                    $ingredient->getName()
                );
            }
            $html .= '</ul>';
        }

        return $html;
    }
}
