<?php

namespace App\Entity\Translation;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Translation\WordRepository")
 * @ORM\Table(name="translation_word")
 */
class Word
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Translation\Category", inversedBy="words")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $dutch;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $german;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $english;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $french;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $spanish;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $italian;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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

    public function getDutch(): ?string
    {
        return $this->dutch;
    }

    public function setDutch(string $dutch): self
    {
        $this->dutch = $dutch;

        return $this;
    }

    public function getGerman(): ?string
    {
        return $this->german;
    }

    public function setGerman(string $german): self
    {
        $this->german = $german;

        return $this;
    }

    public function getEnglish(): ?string
    {
        return $this->english;
    }

    public function setEnglish(string $english): self
    {
        $this->english = $english;

        return $this;
    }

    public function getFrench(): ?string
    {
        return $this->french;
    }

    public function setFrench(string $french): self
    {
        $this->french = $french;

        return $this;
    }

    public function getSpanish(): ?string
    {
        return $this->spanish;
    }

    public function setSpanish(string $spanish): self
    {
        $this->spanish = $spanish;

        return $this;
    }

    public function getItalian(): ?string
    {
        return $this->italian;
    }

    public function setItalian(string $italian): self
    {
        $this->italian = $italian;

        return $this;
    }
}
