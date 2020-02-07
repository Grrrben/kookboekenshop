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
     * @Route("/woordenboek/{slug}", name="translation_by_slug")
     * @Template("translation/word.html.twig")
     */
    public function word(string $slug)
    {
        $word = $this->wordRepository->findBySlug($slug);

        if (!($word instanceof Word)) {
            return $this->redirect('/404');
        }

        return ['word' => $word];
    }


}
