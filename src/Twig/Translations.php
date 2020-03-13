<?php

namespace App\Twig;

use App\Repository\Translation\WordRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Translations extends AbstractExtension
{
    /**
     * @var WordRepository
     */
    private $wordRepository;

    public function __construct(WordRepository $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('translations', [$this, 'top']),
        ];
    }

    public function top(int $num)
    {
        $words = $this->wordRepository->findBy([], ['id' => 'desc'], $num);
        $html = '';

        if (count($words)) {
            $html .= '<ul class="footer-list">';
            foreach ($words as $word) {
                $html .= sprintf(
                    '<li><a href="/woordenboek/%s">%s</a></li>',
                    $word->getSlug(),
                    $word->getDutch()
                );
            }
            $html .= '</ul>';
        }

        return $html;
    }
}
