<?php

namespace App\Entity\Combination;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Combination\IngredientRepository")
 */
class Ingredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $kbsId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alsoKnownAs;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $views;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Combination\Ingredient", inversedBy="ingredients")
     */
    private $combinations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Combination\Ingredient", mappedBy="combinations")
     */
    private $ingredients;

    public function __construct()
    {
        $this->combinations = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKbsId(): ?int
    {
        return $this->kbsId;
    }

    public function setKbsId(?int $kbsId): self
    {
        $this->kbsId = $kbsId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getAlsoKnownAs(): ?string
    {
        return $this->alsoKnownAs;
    }

    public function setAlsoKnownAs(?string $alsoKnownAs): self
    {
        $this->alsoKnownAs = $alsoKnownAs;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCombinations(): Collection
    {
        return $this->combinations;
    }

    public function addCombination(self $combination): self
    {
        if (!$this->combinations->contains($combination)) {
            $this->combinations[] = $combination;
        }

        return $this;
    }

    public function removeCombination(self $combination): self
    {
        if ($this->combinations->contains($combination)) {
            $this->combinations->removeElement($combination);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(self $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->addCombination($this);
        }

        return $this;
    }

    public function removeIngredient(self $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
            $ingredient->removeCombination($this);
        }

        return $this;
    }
}
