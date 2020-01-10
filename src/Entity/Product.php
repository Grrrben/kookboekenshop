<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * This is the previous id. Needed for 301 routing etc.
     * @ORM\Column(type="integer")
     */
    private $kbsId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $quote;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $appearance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $binding;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pages;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $listPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $isbn13;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descShort;

    /**
     * @ORM\Column(type="text")
     */
    private $descLong;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $availability;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgCover;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgBook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgAuthor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgThumbnail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $coAuthor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $translator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $illustrator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $editor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $photographer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag")
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSubTitle()
    {
        return $this->subTitle;
    }

    public function setSubTitle($subTitle): self
    {
        $this->subTitle = $subTitle;

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

    public function getQuote()
    {
        return $this->quote;
    }

    public function setQuote($quote): self
    {
        $this->quote = $quote;
        return $this;
    }

    public function getKbsId()
    {
        return $this->kbsId;
    }

    public function setKbsId($kbsId): self
    {
        $this->kbsId = $kbsId;
        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year): self
    {
        $this->year = $year;
        return $this;
    }

    public function getPages()
    {
        return $this->pages;
    }

    public function setPages($pages): self
    {
        $this->pages = $pages;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getListPrice()
    {
        return $this->listPrice;
    }

    public function setListPrice($listPrice): self
    {
        $this->listPrice = $listPrice;
        return $this;
    }

    public function getIsbn13()
    {
        return $this->isbn13;
    }

    public function setIsbn13($isbn13): self
    {
        $this->isbn13 = $isbn13;
        return $this;
    }

    public function getDescShort()
    {
        return $this->descShort;
    }

    public function setDescShort($descShort): self
    {
        $this->descShort = $descShort;
        return $this;
    }

    public function getDescLong()
    {
        return $this->descLong;
    }

    public function setDescLong($descLong): self
    {
        $this->descLong = $descLong;
        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }
}
