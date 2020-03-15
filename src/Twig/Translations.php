<?php

namespace App\Twig;

use App\Repository\Translation\WordRepository;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Translations extends AbstractExtension
{
    /**
     * @var WordRepository
     */
    private $wordRepository;

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(WordRepository $wordRepository, Environment $twig)
    {
        $this->wordRepository = $wordRepository;
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
        $words = $this->wordRepository->findBy([], ['id' => 'desc'], $num);

        return $this->twig->render('translation/footer.html.twig', ['translations' => $words]);
    }
}
