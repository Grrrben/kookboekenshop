<?php

namespace App\Twig;

use App\Repository\Combination\IngredientRepository;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Combinations extends AbstractExtension
{
    /**
     * @var IngredientRepository
     */
    private $ingredientRepository;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(IngredientRepository $ingredientRepository, Environment $twig)
    {
        $this->ingredientRepository = $ingredientRepository;
        $this->twig = $twig;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('combinations', [$this, 'top']),
        ];
    }

    /**
     * @param int $num
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function top(int $num)
    {
        $ingredients = $this->ingredientRepository->findBy([], ['views' => 'desc'], $num);

        return $this->twig->render('ingredient/footer.html.twig', ['ingredients' => $ingredients]);
    }
}
