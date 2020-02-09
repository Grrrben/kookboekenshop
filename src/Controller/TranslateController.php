<?php

namespace App\Controller;

use App\Entity\Translation\Word;
use App\Repository\Translation\CategoryRepository;
use App\Repository\Translation\WordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TranslateController extends AbstractController
{
    /**
     * @var WordRepository
     */
    private $wordRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(WordRepository $wordRepository, CategoryRepository $categoryRepository)
    {
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * This is the 301 redirect for old routes.
     * Like "woordenboek/vertaal.php?id=1437"
     * @Route("/woordenboek/vertaal.php", name="old_translation")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function old(Request $request)
    {
        $id = (int)$request->query->get('id');
        $word = $this->wordRepository->find($id);

        if (!($word instanceof Word)) {
            return $this->redirect('/404');
        }
        $url = $this->generateUrl('translation_by_slug', ['slug' => $word->getSlug()]);

        return $this->redirect($url, 301);
    }

    /**
     * @Route("/woordenboek/{slug}/{language}", name="translation_by_slug_in_specific_language")
     * @Template("translation/word_per_language.html.twig")
     */
    public function wordInLanguage(string $slug, string $language)
    {
        $word = $this->wordRepository->findBySlug($slug);
        $categoryWords = $word->getCategory()->getWords();

        if (!($word instanceof Word)) {
            return $this->redirect('/404');
        }

        switch ($language) {
            case 'engels':
                $translation = $word->getEnglish();
                break;
            case 'spaans':
                $translation = $word->getSpanish();
                break;
            case 'italiaans':
                $translation = $word->getItalian();
                break;
            case 'duits':
                $translation = $word->getGerman();
                break;
            case 'frans':
                $translation = $word->getFrench();
                break;
            default:
                return $this->redirect('/404');
        }

        return [
            'word' => $word,
            'categoryWords' => $categoryWords,
            'language' => $language,
            'translation' => $translation
        ];
    }

    /**
     * @Route("/woordenboek", name="translation_list")
     * @Template("translation/list.html.twig")
     */
    public function list()
    {
        $words = $this->wordRepository->findAll();
        $categories = $this->categoryRepository->findAll();

        return [
            'words' => $words,
            'categories' => $categories,
        ];
    }

    /**
     * @Route("/woordenboek/{slug}", name="translation_by_slug")
     * @Template("translation/word.html.twig")
     */
    public function word(string $slug)
    {
        $word = $this->wordRepository->findBySlug($slug);
        $categoryWords = $word->getCategory()->getWords();

        if (!($word instanceof Word)) {
            return $this->redirect('/404');
        }

        return [
            'word' => $word,
            'categoryWords' => $categoryWords
        ];
    }
}
