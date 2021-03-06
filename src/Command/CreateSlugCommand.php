<?php

namespace App\Command;

use App\Entity\Product;
use App\Mapper\Helper\Slugger;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSlugCommand extends Command
{
    protected static $defaultName = 'app:create-slug';

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var Slugger
     */
    private $slugger;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(
        ProductRepository $productRepository,
        Slugger $slugger,
        EntityManagerInterface $entityManager,
        string $name = null
    ) {
        parent::__construct($name);
        $this->productRepository = $productRepository;
        $this->slugger = $slugger;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a slug for a product. If no ID (int) is given, creates slugs for all products that have no slug.')
            ->setHelp("This command creates a slug for a product. Use the optional ID as a first param to target a single book.");

        $this->addArgument('id', InputArgument::OPTIONAL, 'id. Matches the ID of a Product entity.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $id = (int)$input->getArgument('id');
        if ($id !== 0) {

            $product = $this->productRepository->find($id);
            if (!($product instanceof Product)) {
                $output->writeln(sprintf('<comment>No products found with ID %d</comment>', $id));
                return 1;
            }

            $product = $this->updateProduct($product);
            $this->entityManager->flush();

            $output->writeln(sprintf('Added slug to book with id %d', $product->getId()));
            return 0;
        }

        $products = $this->productRepository->findWithoutSlug();
        $this->updateProducts($products);

        $output->writeln(sprintf('Added slugs to %d books', count($products)));

        return 0;
    }

    /**
     * @param Product[] $products
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function updateProducts(array $products) {
        foreach ($products as $product) {
            if ($product instanceof Product) {
                $this->updateProduct($product);
            }
        }
        $this->entityManager->flush();
    }

    /**
     * @param Product $product
     * @return Product
     * @throws \Doctrine\ORM\ORMException
     */
    public function updateProduct(Product $product)
    {
        $product = $this->setSlug($product);
        $this->entityManager->persist($product);
        return $product;
    }

    private function setSlug(Product $product): Product
    {
        $slug = $this->slugger->transform($product->getTitle());
        $product->setSlug($slug);
        return $product;
    }
}
