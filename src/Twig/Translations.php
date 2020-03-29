<?php

namespace App\Twig;

use App\Repository\Translation\CategoryRepository;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Translations extends AbstractExtension
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(CategoryRepository $categoryRepository, Environment $twig)
    {
        $this->categoryRepository = $categoryRepository;
        $this->twig = $twig;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('translations', [$this, 'top']),
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
        $cats = $this->categoryRepository->findBy([], ['id' => 'desc'], $num);

        return $this->twig->render('translation/footer.html.twig', ['categories' => $cats]);
    }
}
