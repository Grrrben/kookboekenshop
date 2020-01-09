<?php

namespace App\Tests\Command;

use App\Command\CreateSlugCommand;
use App\Entity\Product;
use App\Mapper\Helper\Slugger;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSlugCommandTest extends KernelTestCase
{
    const ID = 123;

    public function testExecuteWrongID()
    {
        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository->expects($this->once())->method('find')->with(self::ID)->willReturn(null);

        $slugger = $this->createMock(Slugger::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $input = $this->createMock(InputInterface::class);
        $input->expects($this->once())->method('getArgument')->with('id')->willReturn(self::ID);

        $output = $this->createMock(OutputInterface::class);

        $cmd = new CreateSlugCommand($productRepository, $slugger, $entityManager);
        $cmd->execute($input, $output);
    }

    public function testExecuteSingle()
    {
        $product = $this->createMock(Product::class);
        $product->expects($this->once())->method('getTitle')->willReturn('title');
        $product->expects($this->once())->method('setSlug')->with('slug');

        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository->expects($this->once())->method('find')->with(self::ID)->willReturn($product);

        $slugger = $this->createMock(Slugger::class);
        $slugger->expects($this->once())->method('transform')->with('title')->willReturn('slug');

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush');

        $input = $this->createMock(InputInterface::class);
        $input->expects($this->once())->method('getArgument')->with('id')->willReturn(self::ID);

        $output = $this->createMock(OutputInterface::class);

        $cmd = new CreateSlugCommand($productRepository, $slugger, $entityManager);
        $cmd->execute($input, $output);
    }

    public function testExecuteMultiple()
    {
        $product = $this->createMock(Product::class);
        $product->expects($this->exactly(3))->method('getTitle')->willReturn('title');
        $product->expects($this->exactly(3))->method('setSlug')->with('slug');

        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository
            ->expects($this->once())
            ->method('findWithoutSlug')
            ->willReturn([$product, $product, $product]);

        $slugger = $this->createMock(Slugger::class);
        $slugger->expects($this->exactly(3))->method('transform')->with('title')->willReturn('slug');

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->exactly(3))->method('persist');
        $entityManager->expects($this->once())->method('flush');

        $input = $this->createMock(InputInterface::class);
        $input->expects($this->once())->method('getArgument')->with('id')->willReturn(0);

        $output = $this->createMock(OutputInterface::class);

        $cmd = new CreateSlugCommand($productRepository, $slugger, $entityManager);
        $cmd->execute($input, $output);
    }
}
