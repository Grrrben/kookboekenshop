<?php

namespace App\DataFixtures;

use App\Mapper\Helper\Slugger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    /**
     * @param string
     */
    private $slugger;

    public function __construct(Slugger $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $title = 'Title of product  ' . $i;

            $product = new Product();
            $product->setTitle($title)
                ->setSlug($this->slugger->transform($title))
                ->setSubTitle(str_repeat('Content ', rand(5, 20)))
                ->setQuote('Quote')
                ->setYear(2001)
                ->setPages(1234)
                ->setPrice(3995)
                ->setListPrice(4995)
                ->setIsbn13(1234567890123)
                ->setDescShort('Lorem ipsum doler set amit. ' . $i)
                ->setDescLong(str_repeat('Lorem ipsum doler set amit. ', rand(5, 20)));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
